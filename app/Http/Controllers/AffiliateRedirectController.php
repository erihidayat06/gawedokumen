<?php

namespace App\Http\Controllers;

use App\Models\AffiliateAd;
use App\Models\AffiliateStat; // Pastikan model ini sudah di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk DB::raw

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
        $userAgent = request()->userAgent();
        $isBot = preg_match('/bot|crawler|spider|crawling|slurp|facebookexternalhit|python-requests|curl|wget|applebot|bingbot|googlebot/i', $userAgent);
        // Simpan ke log audit
        \App\Models\AffiliateLog::create([
            'affiliate_ad_id' => $ad->id,
            'ip_address' => request()->ip(),
            'user_agent' => $userAgent,
            'is_bot' => $isBot
        ]);

        // Hanya tambahkan increment jika BUKAN bot
        if (!$isBot) {
            // Update total view di tabel utama
            $ad->increment('total_views');

            // Update statistik harian di tabel affiliate_stats
            AffiliateStat::updateOrCreate(
                [
                    'affiliate_ad_id' => $ad->id,
                    'date' => date('Y-m-d') // Mengambil tanggal hari ini
                ],
                [
                    'clicks' => DB::raw('clicks + 1') // Menambah 1 ke data yang ada
                ]
            );
        }

        if (config('app.env') === 'local') {
            return redirect()->away(env('REDIRECT_TEST_URL', 'https://example.com/'));
        }

        // 3. Alihkan secara aman ke URL eksternal
        return redirect()->away($urlTujuan);
    }
}
