<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    // Ambil semua file di disk 'public'
    $files = Storage::disk('public')->files();

    foreach ($files as $file) {
        // Abaikan file .gitignore agar folder storage tidak hilang strukturnya
        if ($file === '.gitignore') continue;

        // Cek umur file: jika lebih dari 60 menit, hapus!
        if (Storage::disk('public')->lastModified($file) < now()->subMinutes(60)->getTimestamp()) {
            Storage::disk('public')->delete($file);
        }
    }
})->hourly(); // Jalankan pengecekan setiap jam
