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

        Carbon::setLocale('id');

        // Format tanggal surat
        if ($request->tanggal) {
            $data['tanggal_indo'] = Carbon::parse($request->tanggal)
                ->translatedFormat('d F Y');
        } else {
            $data['tanggal_indo'] = '-';
        }

        // Format tanggal lahir
        if ($request->tanggal_lahir) {
            $data['tanggal_lahir_indo'] = Carbon::parse($request->tanggal_lahir)
                ->translatedFormat('d F Y');
        }

        // Mapping font untuk DomPDF
        $fontMap = [
            'font-serif'   => '"Times New Roman", Times, serif',
            'font-sans'    => 'Arial, Helvetica, sans-serif',
            'font-mono'    => '"Courier New", Courier, monospace',
            'font-georgia' => 'Georgia, serif',
        ];

        $data['selected_font'] =
            $fontMap[$request->font_style] ?? 'Arial, sans-serif';

        // Decode lampiran
        $data['lampiran'] = is_string($request->lampiran)
            ? json_decode($request->lampiran, true)
            : ($request->lampiran ?? []);

        // Simpan ke session
        session([
            'surat_lamaran_data' => $data
        ]);

        // Redirect ke GET
        return redirect()->route('pdf.preview');
    }

    public function preview()
    {
        $data = session('surat_lamaran_data');

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data surat tidak ditemukan');
        }

        $pdf = Pdf::loadView(
            'pekerja.surat_lamaran.pdf.template_lamaran',
            $data
        );

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Surat_Lamaran.pdf');
    }
}
