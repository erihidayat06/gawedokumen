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
        // Kita langsung eager load relasi 'affiliateAds' dan 'platform'-nya agar hemat query
        $loker = \App\Models\Loker::with(['blogs', 'affiliateAds' => function ($query) {
            $query->where('status', 'active')->with('platform');
        }])
            ->where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail();

        // 2. Set locale ke Indonesia agar format tanggal pas
        app()->setLocale('id');

        // Ambil 3 loker lain secara acak untuk rekomendasi bawah
        $rekomendasi = \App\Models\Loker::where('id', '!=', $loker->id)
            ->where('status', 'Aktif')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // --- LOGIKA PENGAMBILAN PRODUK AFFILIATE VIA TABEL PIVOT ---

        // Ambil semua produk aktif yang nempel di loker ini lewat pivot
        $adsCollection = $loker->affiliateAds;
        $totalAds = $adsCollection->count();

        if ($totalAds > 0) {
            // Biar gak error pas data di pivot kurang dari 3, kita batasi jumlah randomnya
            $limitRandom = min(3, $totalAds);
            $affiliateAds = $adsCollection->random($limitRandom);
        } else {
            // Fallback: Kalau di tabel loker_affiliate_ad kosong (misal AI belum petakan),
            // kita ambil 3 produk acak dari semua produk aktif di database biar slot gak kosong.
            $affiliateAds = \App\Models\AffiliateAd::with('platform')
                ->where('status', 'active')
                ->inRandomOrder()
                ->limit(3)
                ->get();
        }

        // 3. SEO Metadata
        $title = $loker->posisi . " di " . $loker->perusahaan . " - GaweDokumen";

        // Lempar variabel ke view loker.show
        return view('loker.show', compact('loker', 'title', 'rekomendasi', 'affiliateAds'));
    }
}
