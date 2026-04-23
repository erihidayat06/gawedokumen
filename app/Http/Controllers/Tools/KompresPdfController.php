<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KompresPdfController extends Controller
{
    public function index()
    {
        return view('tools.kompresPDF.kopresPdf');
    }

    public function compress(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:15360', // Max 15MB
        ]);

        $file = $request->file('pdf_file');
        $inputPath = $file->getRealPath();
        $fileName = 'compressed_' . time() . '.pdf';
        $outputPath = storage_path('app/public/' . $fileName);

        // Cek OS (Windows/Linux)
        $gsPath = (PHP_OS_FAMILY === 'Windows') ? 'gswin64c' : 'gs';

        // Perintah Ghostscript
        $cmd = "{$gsPath} -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen " .
            "-dColorImageResolution=120 " .
            "-dGrayImageResolution=120 " .
            "-dMonoImageResolution=200 " .
            "-dDownsampleColorImages=true -dDownsampleGrayImages=true -dDownsampleMonoImages=true " .
            "-dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"{$outputPath}\" \"{$inputPath}\"";

        shell_exec($cmd);

        if (file_exists($outputPath)) {
            // Ambil ukuran file dalam bytes untuk perhitungan persentase di JS
            $newSizeInBytes = filesize($outputPath);

            return response()->json([
                'success' => true,
                'download_url' => asset('storage/' . $fileName),
                'new_size' => number_format($newSizeInBytes / 1024 / 1024, 2) . ' MB',
                'new_size_bytes' => $newSizeInBytes // <--- Tambahkan ini agar JS bisa hitung %
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengompres.'], 500);
    }
}
