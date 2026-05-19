<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class GabungPdfController extends Controller
{
    public function index()
    {
        return view('tools.gabungPdf.index');
    }

    public function merge(Request $request)
    {
        // 1. Validasi Input Array File
        $request->validate([
            'pdf_files' => 'required|array|min:2',
            'pdf_files.*' => 'required|mimes:pdf|max:20480',
        ]);

        // 2. Inisialisasi FPDI (FPDI otomatis meng-extend FPDF)
        $pdf = new Fpdi();
        $files = $request->file('pdf_files');
        $temporaryFiles = [];

        try {
            // 3. Looping Setiap File PDF yang Diupload
            foreach ($files as $file) {
                $path = $file->store('temp_pdf');
                $fullPath = storage_path('app/private/' . $path);
                $temporaryFiles[] = $fullPath;

                // Hitung total halaman di file PDF saat ini
                $pageCount = $pdf->setSourceFile($fullPath);

                // Ambil halaman per halaman lalu masukkan ke template baru
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    // Import halaman
                    $templateId = $pdf->importPage($pageNo);

                    // Ambil ukuran asli halaman (A4, Letter, Portrait/Landscape otomatis)
                    $size = $pdf->getTemplateSize($templateId);

                    // Tambah halaman baru dengan orientasi & ukuran yang sama dengan aslinya
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

                    // Tempelkan halaman asli ke halaman baru
                    $pdf->useTemplate($templateId);
                }
            }

            // 4. Tentukan Lokasi Output File Gabungan
            $outputName = 'gawedokumen-' . time() . '.pdf';
            $outputPath = storage_path('app/private/temp_pdf/' . $outputName);

            // Simpan file hasil gabungan ke local storage server
            $pdf->Output('F', $outputPath);

            // 5. Bersihkan File Mentah (Temporary)
            foreach ($temporaryFiles as $tempFile) {
                if (file_exists($tempFile)) {
                    unlink($tempFile);
                }
            }

            // 6. Download ke User dan Hapus File Gabungan dari Server setelah terkirim
            return response()->download($outputPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            // Jika ada error, bersihkan sisa file di server biar gak nyampah
            foreach ($temporaryFiles as $tempFile) {
                if (file_exists($tempFile)) {
                    unlink($tempFile);
                }
            }
            return back()->with('error', 'Gagal menggabungkan PDF. Pastikan file PDF tidak ter-password / rusak. Detail: ' . $e->getMessage());
        }
    }
}
