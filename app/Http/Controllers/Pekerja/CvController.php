<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Services\LogService;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function index()
    {
        $dbTemplates = Cv::all()->map(function ($item) {
            return [
                'id'     => 'db-' . $item->id,
                'nama'   => $item->nama_template . ' (Kustom)',
                'gambar' => $item->cv_image ? asset('storage/' . $item->cv_image) : asset('img/cv/default.jpg'),
                'config' => [
                    'primary'     => $item->color_primary_text,
                    'textMain'    => $item->color_body_text,
                    'sidebarText' => $item->color_sidebar_text,
                    'bgText'      => $item->color_sidebar_bg,
                ]
            ];
        });

        // Tetap kirim sebagai string JSON
        $templates = json_encode($dbTemplates);



        return view('pekerja.cv.index', compact('templates'));
    }

    public function generatePdf(Request $request)
    {
        app()->setLocale('id');

        // 1. Cari template berdasarkan ID
        $template = Cv::find($request->template_id);

        // 2. Ambil nilai kolom 'cv_image'
        // Gunakan operator null coalescing (??) untuk memberikan default jika data kosong
        $gambar_template = 'storage/' . $template->cv_image ?? 'img/cv/cv1.jpg';
        // Di Controller (generatePdf)
        $status = $request->status_pengalaman;
        $judul = 'Pengalaman'; // Default

        if ($status === 'punya_kerja') {
            $judul = 'Pengalaman Kerja';
        } elseif ($status === 'punya_organisasi') {
            $judul = 'Pengalaman Organisasi';
        }


        $cvData = [
            'nama'            => $request->nama,
            'posisi'          => $request->profesi,
            'tempat_lahir'    => $request->tempat_lahir,

            'tanggal_lahir'   => $request->tanggal_lahir
                ? Carbon::parse($request->tanggal_lahir)->translatedFormat('d F Y')
                : '',

            'jk'              => $request->jk,
            'kewarganegaraan' => $request->kewarganegaraan,
            'email'           => $request->email,
            'no_tlp'          => $request->telepon,
            'alamat_diri'     => $request->alamat,
            'profil'          => $request->profil_singkat,
            'status_pengalaman' => $request->status_pengalaman,
            'judul' => $judul,
            'experience'      => json_decode($request->pengalaman, true) ?? [],
            'pendidikan'      => json_decode($request->pendidikan, true) ?? [],
            'keahlian'        => json_decode($request->keahlian, true) ?? [],


            'color_primary_text' => $template->color_primary_text,
            'color_body_text' => $template->color_body_text,
            'color_sidebar_text' => $template->color_sidebar_text,
            'color_sidebar_bg' => $template->color_sidebar_bg,

            'avatar'          => $request->foto_base64,
            'gambar_template'    => $gambar_template
        ];

        $fontMap = [
            'font-serif'   => '"Times New Roman", Times, serif',
            'font-sans'    => 'Arial, Helvetica, sans-serif',
            'font-mono'    => '"Courier New", Courier, monospace',
            'font-georgia' => 'Georgia, serif',
        ];

        $cvData['selected_font'] =
            $fontMap[$request->font_style] ?? 'Arial, sans-serif';

        // 5. Catat log
        LogService::logDownload('cv');

        // 6. Simpan array tersebut ke session
        session(['cv_data' => $cvData]);

        // redirect ke GET
        return redirect()->route('cv.pdf.preview');
    }

    public function previewPdf()
    {
        $data = session('cv_data');

        if (!$data) {
            return redirect()->back()->with('error', 'Data CV tidak ditemukan');
        }

        $pdf = Pdf::loadView('pekerja.cv.pdf.template_cv', $data);



        $filename = 'CV_' . str_replace(' ', '_', $data['nama'] ?? 'Dokumen') . '.pdf';

        return $pdf->stream($filename);
    }
}
