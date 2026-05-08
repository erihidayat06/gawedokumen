<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Loker;
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
        $query = Loker::query();

        // Logika filter tetap sama seperti sebelumnya...

        $lokers = $query->latest()->paginate(20);
        $bulanSekarang = \Carbon\Carbon::now()->translatedFormat('F Y');

        return view('admin.loker.index', compact('lokers', 'bulanSekarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Loker $loker)
    {
        return view('admin.loker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Pecah teks persyaratan per baris menjadi array
        if ($request->persyaratan) {
            $data['persyaratan'] = array_filter(explode("\n", str_replace("\r", "", $request->persyaratan)));
        }

        // Generate Slug SEO otomatis
        app()->setLocale('id');
        $bulan = \Carbon\Carbon::now()->translatedFormat('F Y');
        $data['slug'] = \Illuminate\Support\Str::slug($request->posisi . ' ' . $request->kecamatan . ' ' . $request->kota . ' ' . $bulan);

        // Simpan ke Database
        \App\Models\Loker::create($data);

        return redirect()->route('loker.index')->with('success', 'Loker berhasil ditayangkan!');
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
