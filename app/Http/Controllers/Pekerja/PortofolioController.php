<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PortofolioController extends Controller
{
    public function index()
    {
        return view('pekerja.portofolio.index');
    }

    /**
     * Menerima input data portofolio dari form (POST) dan menyimpannya ke Session.
     */
    public function generatePdf(Request $request)
    {
        $request->validate([
            'font_style'  => 'required|string',
            'ttd_align'   => 'required|string',
            'projek_data' => 'required|string',
        ]);

        $projekValid = json_decode($request->projek_data, true);

        if (!is_array($projekValid)) {
            $projekValid = [];
        }

        $pages = [];
        $currentPageItems = [];
        $halamanKe = 1;

        foreach ($projekValid as $idx => $projek) {
            $currentPageItems[] = $projek;

            // DIUBAH: Set statis 2 projek per halaman dari halaman awal
            $maxItemDiHalamanIni = 2;
            $apakahProjekTerakhir = ($idx + 1 === count($projekValid));

            if (count($currentPageItems) === $maxItemDiHalamanIni || $apakahProjekTerakhir) {
                $pages[] = [
                    'nomor_halaman' => $halamanKe,
                    'items' => $currentPageItems
                ];

                $halamanKe++;
                $currentPageItems = [];
            }
        }

        $portfolioData = [
            'pages'         => $pages,
            'selected_font' => $request->font_style ?? 'font-sans',
        ];

        session(['portofolio_download_data' => $portfolioData]);

        return redirect()->route('pekerja.portofolio.pdf.preview');
    }

    /**
     * Mengambil data Portofolio dari Session dan merendernya ke DomPDF (GET).
     */
    public function previewPdf()
    {
        // Ambil data portofolio yang tersimpan dari session
        $data = session('portofolio_download_data');

        // Proteksi jika user langsung tembak URL preview tanpa isi form
        if (!$data) {
            return redirect()->back()->with('error', 'Data dokumen portofolio tidak ditemukan atau session kedaluwarsa.');
        }

        // Load view PDF khusus Portofolio Karya (Sesuaikan lokasi path blade kamu)
        $pdf = Pdf::loadView('pekerja.portofolio.pdf.pdf_portofolio', $data);

        // Atur ukuran kertas ke A4 (Portrait)
        $pdf->setPaper('a4', 'portrait');

        // Beri nama file PDF default yang rapi
        $filename = 'Portofolio_Karya_dan_Projek.pdf';

        // Stream langsung ke browser preview halaman PDF
        return $pdf->stream($filename);
    }
}
