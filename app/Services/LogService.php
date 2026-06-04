<?php

namespace App\Services;

use App\Models\DownloadStat;
use Illuminate\Support\Facades\DB;

class LogService
{
    public static function logDownload(string $documentName)
    {
        \App\Models\DownloadStat::updateOrCreate(
            [
                'date'          => date('Y-m-d'), // Kondisi yang dicari
                'document_name' => $documentName  // Kondisi yang dicari
            ],
            [
                'total_downloads' => DB::raw('total_downloads + 1') // Tindakan: tambahkan 1
            ]
        );
    }
}
