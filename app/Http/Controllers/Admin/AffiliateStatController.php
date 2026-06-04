<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateAd;
use App\Models\AffiliateStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AffiliateStatController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap input filter atau gunakan default 30 hari terakhir
        $startDate = $request->input('start_date', date('Y-m-d', strtotime('-30 days')));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // 2. Statistik Card (Tetap menampilkan akumulasi global/tetap)
        $statsCard = [
            'today' => AffiliateStat::where('date', date('Y-m-d'))->sum('clicks'),
            'month' => AffiliateStat::where('date', 'like', date('Y-m') . '%')->sum('clicks'),
            'year'  => AffiliateStat::where('date', 'like', date('Y') . '%')->sum('clicks'),
        ];

        // 3. Data Grafik (Filter berdasarkan rentang tanggal)
        $stats = AffiliateStat::select('date', DB::raw('SUM(clicks) as total_clicks'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc') // Urutkan asc agar grafik benar dari kiri ke kanan
            ->get();

        // 4. Top 20 Produk (Filter berdasarkan rentang tanggal menggunakan closure)
        // Ganti bagian $top20Products dengan kode ini:

        $top20Products = AffiliateAd::withSum(['stats' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }], 'clicks') // <--- Argumen kedua adalah nama kolom yang akan dijumlahkan
            ->where('status', 'active')
            ->orderByDesc('stats_sum_clicks') // <--- Perhatikan: Laravel otomatis membuat alias 'stats_sum_clicks'
            ->limit(20)
            ->get();
        $latestLogs = \App\Models\AffiliateLog::with('affiliateAd')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('admin.affiliate.analytic', compact('stats', 'statsCard', 'top20Products', 'latestLogs'));
    }
}
