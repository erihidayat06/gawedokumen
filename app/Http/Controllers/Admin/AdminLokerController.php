<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Loker;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminLokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Di LokerController untuk admin
    public function index(Request $request)
    {
        // Gunakan Eager Loading 'blogs' agar query lebih ringan
        $query = \App\Models\Loker::with('blogs');

        // 1. Filter Pencarian (Biar kamu gampang cari loker lama)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%")
                    ->orWhere('kota', 'like', "%{$search}%");
            });
        }

        // 2. Filter Status (Aktif/Arsip)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // 3. Ambil data dengan pagination
        // Urutkan berdasarkan yang terbaru (latest)
        $lokers = $query->latest()->paginate(20)->withQueryString();

        // Set locale untuk kebutuhan display bulan di dashboard
        app()->setLocale('id');
        $bulanSekarang = \Carbon\Carbon::now()->translatedFormat('F Y');

        return view('admin.loker.index', compact('lokers', 'bulanSekarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Loker $loker)
    {
        $blogs = \App\Models\Blog::select('id', 'judul')->get();
        return view('admin.loker.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'posisi' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'blog_ids' => 'nullable|array',
            'blog_ids.*' => 'exists:blogs,id',
        ]);

        $data = $request->all();

        // 2. Karena persyaratan, tugas, dan benefit sudah berbentuk array dari form,
        // kita cukup pastikan tidak ada inputan kosong (array_filter)
        if ($request->has('persyaratan')) {
            $data['persyaratan'] = array_filter($request->persyaratan);
        }

        if ($request->has('tugas')) {
            $data['tugas'] = array_filter($request->tugas);
        }

        if ($request->has('benefit')) {
            $data['benefit'] = array_filter($request->benefit);
        }

        // 3. Generate Slug SEO otomatis
        app()->setLocale('id');
        $bulan = \Carbon\Carbon::now()->translatedFormat('F Y');
        $data['slug'] = \Illuminate\Support\Str::slug($request->posisi . ' ' . $request->kecamatan . ' ' . $request->kota . ' ' . $bulan);

        // 4. Simpan ke Database
        $loker = \App\Models\Loker::create($data);

        // 5. Relasi Blog
        if ($request->has('blog_ids')) {
            $loker->blogs()->sync($request->blog_ids);
        }

        return redirect()->route('admin.loker.index')->with('success', 'Loker berhasil ditayangkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loker $loker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $loker)
    {
        //
    }
}
