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

        $urlTujuan = $ad->affiliate_url;

        if (empty($urlTujuan)) {
            return redirect()->to('/')->with('error', 'Link produk tidak tersedia.');
        }

        // --- FITUR HITUNG KLIK (DENGAN FILTER BOT) ---
        // Mendapatkan User Agent dari pengakses
        $userAgent = request()->userAgent();

        // Pola regex untuk mendeteksi bot/crawler umum
        // Menambahkan: bot, crawler, spider, slurp, facebookexternalhit, curl, wget, dll
        $isBot = preg_match('/bot|crawler|spider|crawling|slurp|facebookexternalhit|python-requests|curl|wget|applebot|bingbot|googlebot/i', $userAgent);

        // Hanya tambahkan increment jika BUKAN bot
        if (!$isBot) {
            $ad->increment('total_views');
        }

        // 3. Alihkan secara aman ke URL eksternal
        return redirect()->away($urlTujuan);
    }
}
