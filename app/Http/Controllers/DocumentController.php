<?php

namespace App\Http\Controllers;

use App\Services\LogService;
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
        $data['tanggal_indo'] = $request->tanggal
            ? Carbon::parse($request->tanggal)->translatedFormat('d F Y')
            : '-';

        // Format tanggal lahir
        $data['tanggal_lahir_indo'] = $request->tanggal_lahir
            ? Carbon::parse($request->tanggal_lahir)->translatedFormat('d F Y')
            : '-';

        // Mapping font untuk DomPDF
        $fontMap = [
            'font-serif'   => '"Times New Roman", Times, serif',
            'font-sans'    => 'Arial, Helvetica, sans-serif',
            'font-mono'    => '"Courier New", Courier, monospace',
            'font-georgia' => 'Georgia, serif',
        ];

        $data['selected_font'] = $fontMap[$request->font_style] ?? 'Arial, sans-serif';

        // Decode lampiran
        $data['lampiran'] = is_string($request->lampiran)
            ? json_decode($request->lampiran, true)
            : ($request->lampiran ?? []);

        // LOGIKA PARAGRAF KUALIFIKASI & KEAHLIAN
        // Cek jika mode manual diisi dan bukan nilai default 'Keahlian'
        if (!empty($data['kaulif_keahlian']) && $data['kaulif_keahlian'] !== 'Keahlian') {
            $data['paragraf_kualifikasi'] = $data['kaulif_keahlian'];
        } else {
            // Mode Template
            $kual = ($data['kualifikasi'] && $data['kualifikasi'] !== 'Kualifikasi') ? $data['kualifikasi'] : '...';
            $keahl = ($data['keahlian'] && $data['keahlian'] !== 'Keahlian') ? $data['keahlian'] : '...';

            $data['paragraf_kualifikasi'] = $kual .
                ". Selain itu, saya juga membekali diri dengan keahlian kompeten di antaranya yaitu " .
                $keahl .
                " yang dapat menunjang produktivitas di perusahaan Bapak/Ibu.";
        }

        LogService::logDownload('surat_lamaran');

        // Simpan ke session
        session(['surat_lamaran_data' => $data]);

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

        return $pdf->stream('Surat_Lamaran_' . $data['nama'] . '.pdf');
    }
}
