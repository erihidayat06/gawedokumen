<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $folder = 'temp'; // Fokus hanya ke folder temp hasil kompresi

    // Pastikan folder ada sebelum diproses
    if (Storage::disk('public')->exists($folder)) {
        $files = Storage::disk('public')->files($folder);

        foreach ($files as $file) {
            // Abaikan .gitignore
            if (str_contains($file, '.gitignore')) continue;

            // Cek umur file: hapus jika lebih dari 60 menit
            $lastModified = Storage::disk('public')->lastModified($file);
            $expiredTime = now()->subMinutes(60)->getTimestamp();

            if ($lastModified < $expiredTime) {
                Storage::disk('public')->delete($file);
            }
        }
    }
})->everyMinute(); // Jalankan pengecekan setiap jam
