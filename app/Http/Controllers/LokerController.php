<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LokerController extends Controller
{
    public function index(Request $request)
    {
        return $this->performFilter($request);
    }

    public function wilayah(Request $request, $wilayah)
    {
        // 1. Ambil nama wilayah dari URL (misal: kota-tegal -> Kota Tegal)
        $formattedWilayah = ucwords(str_replace('-', ' ', $wilayah));

        // 2. Gabungkan data wilayah dari URL ke dalam data Request (pendidikan, search, dll)
        // Ini teknik "merge" agar filter lain tidak hilang
        $request->merge([
            'wilayah' => $formattedWilayah,
            'current_slug' => $wilayah
        ]);

        // 3. Panggil performFilter dengan request yang sudah lengkap
        return $this->performFilter($request);
    }

    private function performFilter(Request $request)
    {
        $lokers = \App\Models\Loker::where('status', 'Aktif')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('posisi', 'like', "%{$search}%")
                        ->orWhere('perusahaan', 'like', "%{$search}%");
                });
            })
            ->when($request->wilayah, function ($query, $wilayah) {
                $query->where('kota', $wilayah);
            })
            ->when($request->pendidikan, function ($query, $pendidikan) {
                $query->where('minimal_pendidikan', $pendidikan);
            })
            ->when($request->tipe, function ($query, $tipe) {
                $query->where('tipe_pekerjaan', $tipe);
            })
            ->latest()
            ->paginate(12);

        // Kirim balik label wilayah untuk SEO
        $currentWilayah = $request->wilayah;
        $currentSlug = $request->current_slug;

        return view('loker.index', compact('lokers', 'currentWilayah', 'currentSlug'));
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
