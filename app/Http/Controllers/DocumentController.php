<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class DocumentController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->all();

        // Pastikan locale diatur ke Indonesia
        Carbon::setLocale('id');

        // Ubah format tanggal jika ada
        if ($request->tanggal) {
            $data['tanggal_indo'] = Carbon::parse($request->tanggal)->translatedFormat('d F Y');
        } else {
            $data['tanggal_indo'] = '-';
        }

        // Lakukan hal yang sama untuk tanggal lahir jika perlu
        if ($request->tanggal_lahir) {
            $data['tanggal_lahir_indo'] = Carbon::parse($request->tanggal_lahir)->translatedFormat('d F Y');
        }

        // Map class Tailwind ke Font Family asli untuk DomPDF
        $fontMap = [
            'font-serif'  => '"Times New Roman", Times, serif',
            'font-sans'   => 'Arial, Helvetica, sans-serif',
            'font-mono'   => '"Courier New", Courier, monospace',
            'font-georgia' => 'Georgia, serif',
        ];

        // Ambil font yang dipilih, default ke sans-serif jika tidak ada
        $data['selected_font'] = $fontMap[$request->font_style] ?? 'Arial, sans-serif';

        // Decode lampiran seperti sebelumnya
        $data['lampiran'] = is_string($request->lampiran) ? json_decode($request->lampiran, true) : ($request->lampiran ?? []);

        $pdf = Pdf::loadView('pekerja.surat_lamaran.pdf.template_lamaran', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Surat_Lamaran.pdf');
    }
}
