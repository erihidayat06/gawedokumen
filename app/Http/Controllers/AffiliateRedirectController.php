<?php

namespace App\Http\Controllers;

use App\Models\AffiliateAd;
use Illuminate\Http\Request;

class AffiliateRedirectController extends Controller
{
    public function redirect($slug)
    {
        // 1. Cari produk berdasarkan custom_slug yang aktif
        $ad = AffiliateAd::where('custom_slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // 2. SESUAIKAN: Ganti 'link_afiliasi' dengan nama kolom asli di tabel affiliate_ads kamu
        // Kita cek apakah kolom tersebut ada isinya dan tidak null
        $urlTujuan = $ad->affiliate_url;

        if (empty($urlTujuan)) {
            // Jika kolom di database ternyata kosong/null, kembalikan ke halaman sebelumnya atau beranda
            return redirect()->to('/')->with('error', 'Link produk tidak tersedia.');
        }

        // --- FITUR HITUNG KLIK / VIEWS ---
        // Baris ini akan otomatis menambahkan +1 pada kolom total_views di database
        // SESUAIKAN: Ganti 'total_views' dengan nama kolom asli di tabel database kamu (misal: 'clicks', 'view_count')
        $ad->increment('total_views');

        // 3. Alihkan secara aman ke URL eksternal
        return redirect()->away($urlTujuan);
    }
}
