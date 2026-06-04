<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadStatController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-d', strtotime('-30 days')));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // Statistik Ringkasan
        $statsCard = [
            'today' => \App\Models\DownloadStat::where('date', date('Y-m-d'))->count(),
            'month' => \App\Models\DownloadStat::where('date', 'like', date('Y-m') . '%')->count(),
            'year'  => \App\Models\DownloadStat::where('date', 'like', date('Y') . '%')->count(),
        ];

        // Grafik Unduhan Harian
        $stats = \App\Models\DownloadStat::select('date', DB::raw('COUNT(*) as total_downloads'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Dokumen Paling Banyak Diunduh
        $topDocuments = \App\Models\DownloadStat::select('document_name', DB::raw('COUNT(*) as total'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('document_name')
            ->orderByDesc('total')
            ->limit(20)
            ->get();

        return view('admin.downloads.analytic', compact('stats', 'statsCard', 'topDocuments'));
    }
}
