<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliateLogController extends Controller
{
    public function handle()
    {
        // Hapus data yang lebih tua dari 7 hari
        \App\Models\AffiliateLog::where('created_at', '<', now()->subDays(7))->delete();
        $this->info('Log affiliate mingguan berhasil dibersihkan.');
    }
}
