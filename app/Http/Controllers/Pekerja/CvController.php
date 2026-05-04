<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // Mengambil semua data dari request dan menyusunnya untuk View PDF
        $data = [
            // Data Diri Dasar
            'nama'            => $request->nama,
            'posisi'         => $request->profesi,

            // Data Personal Tambahan
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'jk'              => $request->jk,
            'kewarganegaraan' => $request->kewarganegaraan,

            // Kontak & Alamat
            'email'           => $request->email,
            'no_tlp'         => $request->telepon,
            'alamat_diri'          => $request->alamat,

            // Profil Singkat
            'profil'  => $request->profil_singkat,

            // Data Dinamis (Dekode dari JSON String menjadi Array PHP)
            'experience'      => json_decode($request->pengalaman, true) ?? [],
            'pendidikan'      => json_decode($request->pendidikan, true) ?? [],
            'keahlian'        => json_decode($request->keahlian, true) ?? [],

            // Pengaturan Tampilan
            'warna_tema'      => $request->warna_tema ?? '#000000',
            'template_id'     => $request->template_id ?? '1',
            'avatar'          => $request->foto_base64, // Mapping dari JS foto_base64 ke variabel avatar di Blade
        ];

        // Opsional: Log data untuk memastikan semua masuk saat proses testing
        // \Log::info($data);

        $pdf = PDF::loadView('pekerja.cv.pdf.template_cv', $data);

        // Stream PDF ke browser dengan nama file yang rapi
        $filename = 'CV_' . str_replace(' ', '_', $request->nama ?? 'Dokumen') . '.pdf';
        return $pdf->stream($filename);
    }
}
