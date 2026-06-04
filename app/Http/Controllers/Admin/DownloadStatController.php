<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DownloadStat;

class DownloadStatController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-d', strtotime('-30 days')));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // Statistik Ringkasan: Gunakan SUM()
        $statsCard = [
            'today' => DownloadStat::where('date', date('Y-m-d'))->sum('total_downloads'),
            'month' => DownloadStat::where('date', 'like', date('Y-m') . '%')->sum('total_downloads'),
            'year'  => DownloadStat::where('date', 'like', date('Y') . '%')->sum('total_downloads'),
        ];

        // Grafik Unduhan Harian: Gunakan SUM()
        $stats = DownloadStat::select('date', DB::raw('SUM(total_downloads) as total_downloads'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Dokumen Paling Banyak Diunduh: Gunakan SUM()
        $topDocuments = DownloadStat::select('document_name', DB::raw('SUM(total_downloads) as total'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('document_name')
            ->orderByDesc('total')
            ->limit(20)
            ->get();

        return view('admin.downloads.analytic', compact('stats', 'statsCard', 'topDocuments'));
    }
}
