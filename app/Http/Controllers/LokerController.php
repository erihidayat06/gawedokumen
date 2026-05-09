<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LokerController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi query dengan relasi blog (Eager Loading)
        $query = \App\Models\Loker::with('blogs')->where('status', 'Aktif');

        // 2. Logic Pencarian (Posisi)
        if ($request->has('search') && $request->search != '') {
            $query->where('posisi', 'like', '%' . $request->search . '%');
        }

        // 3. Logic Filter Wilayah (Kota/Kabupaten)
        if ($request->has('wilayah') && $request->wilayah != '') {
            $query->where('kota', $request->wilayah);
        }

        // 4. Ambil data dengan Paginate (9 data per halaman cocok untuk grid 3 kolom)
        // withQueryString() penting agar saat pindah halaman, filter search tidak hilang
        $lokers = $query->latest()->paginate(9)->withQueryString();

        // 5. Setting bahasa & waktu
        app()->setLocale('id');
        $bulanSekarang = \Carbon\Carbon::now()->translatedFormat('F Y');

        return view('loker.index', compact('lokers', 'bulanSekarang'));
    }

    public function show($slug)
    {
        // 1. Cari loker berdasarkan slug dan pastikan statusnya Aktif
        // Gunakan with('blogs') agar relasi artikel tips karir ikut terbawa
        $loker = \App\Models\Loker::with('blogs')
            ->where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail(); // Jika tidak ada, otomatis muncul halaman 404

        // 2. Set locale ke Indonesia agar diffForHumans (Tayang 2 jam yang lalu)
        // dan format tanggal menggunakan bahasa Indonesia
        app()->setLocale('id');

        // Ambil 3 loker lain secara acak (selain loker yang sedang dibuka)
        $rekomendasi = \App\Models\Loker::where('id', '!=', $loker->id)
            ->where('status', 'Aktif')
            ->inRandomOrder()
            ->limit(3)
            ->get();
        // 3. SEO Metadata (Opsional tapi sangat disarankan)
        // Kamu bisa melempar data title khusus ke view
        $title = $loker->posisi . " di " . $loker->perusahaan . " - GaweDokumen";

        return view('loker.show', compact('loker', 'title', 'rekomendasi'));
    }
}
