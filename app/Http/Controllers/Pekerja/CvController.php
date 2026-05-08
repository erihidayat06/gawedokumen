<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
        // Mengeset locale ke Indonesia agar nama bulan otomatis bahasa Indonesia
        app()->setLocale('id');

        $data = [
            'nama'            => $request->nama,
            'posisi'          => $request->profesi,
            'tempat_lahir'    => $request->tempat_lahir,

            // Memproses Tanggal Lahir langsung di sini menggunakan Carbon
            'tanggal_lahir'   => $request->tanggal_lahir ?
                Carbon::parse($request->tanggal_lahir)->translatedFormat('d F Y') :
                '',

            'jk'              => $request->jk,
            'kewarganegaraan' => $request->kewarganegaraan,
            'email'           => $request->email,
            'no_tlp'          => $request->telepon,
            'alamat_diri'     => $request->alamat,
            'profil'          => $request->profil_singkat,

            'experience'      => json_decode($request->pengalaman, true) ?? [],
            'pendidikan'      => json_decode($request->pendidikan, true) ?? [],
            'keahlian'        => json_decode($request->keahlian, true) ?? [],

            'warna_tema'      => $request->warna_tema ?? '#000000',
            'template_id'     => $request->template_id ?? '1',
            'avatar'          => $request->foto_base64,
        ];



        $pdf = PDF::loadView('pekerja.cv.pdf.template_cv', $data);

        $filename = 'CV_' . str_replace(' ', '_', $request->nama ?? 'Dokumen') . '.pdf';
        return $pdf->stream($filename);
    }
}
