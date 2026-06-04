<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Services\LogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SuratResignController extends Controller
{
    public function index()
    {
        return view('pekerja.surat_resign.index');
    }

    public function generatePdf(Request $request)
    {
        // Set locale agar format tanggal otomatis berbahasa Indonesia
        app()->setLocale('id');

        $data = [
            'kota'              => $request->kota ?? 'Kota',

            // Format Tanggal Pembuatan Surat
            'tanggal'           => $request->tanggal
                ? Carbon::parse($request->tanggal)->translatedFormat('d F Y')
                : Carbon::now()->translatedFormat('d F Y'),

            'pt'                => $request->pt ?? 'PT. xxxxxxxx',
            'alamat_perusahaan' => $request->alamat_perusahaan ?? 'Jl. xxxxxxxx',
            'kota_perusahaan'   => $request->kota_perusahaan ?? 'Kota Perusahaan',
            'nama'              => $request->nama ?? 'Nama Lengkap',
            'nik'           => $request->nik ?? 'Nik Karyawan',
            'jabatan'           => $request->jabatan ?? 'Jabatan / Posisi',
            'departemen'        => $request->departemen ?? 'Nama Divisi / Departemen',
            'alasan'            => $request->alasan ?? 'Alasan pengunduran diri...',

            // Format Tanggal Efektif Resign
            'tanggal_efektif'   => $request->tanggal_efektif
                ? Carbon::parse($request->tanggal_efektif)->translatedFormat('d F Y')
                : Carbon::now()->translatedFormat('d F Y'),

            // Opsi Desain Layout
            'ttd_align'         => $request->ttd_align ?? 'items-end',
            'selected_font'        => $request->font_style ?? 'font-sans',

            // Decode data lampiran (karena dikirim dalam bentuk JSON stringify)
            'lampiran'          => json_decode($request->lampiran, true) ?? [],

            // Tanda tangan digital mentah base64
            'ttd_base64'        => $request->ttd_base64
        ];

        LogService::logDownload('surat_resign');
        // Simpan data array ke dalam session kustom
        session(['surat_data' => $data]);

        // Alihkan (Redirect) ke route preview ber-method GET
        return redirect()->route('pekerja.surat.resign.pdf.preview');
    }

    /**
     * Mengambil data dari Session dan merendernya ke DomPDF (GET).
     */
    public function previewPdf()
    {
        // Ambil data yang tersimpan dari session
        $data = session('surat_data');

        // Proteksi jika user langsung tembak URL preview tanpa isi form
        if (!$data) {
            return redirect()->back()->with('error', 'Data dokumen tidak ditemukan atau session kedaluwarsa.');
        }

        // Load view PDF khusus suratmu (Silakan sesuaikan path view blade-mu di sini)
        $pdf = Pdf::loadView('pekerja.surat_resign.pdf.pdf_resign', $data);

        // Buat nama file PDF dinamis agar rapi (Contoh: Surat_Resign_Budi_Santoso.pdf)
        $filename = 'Surat_Resign_' . str_replace(' ', '_', $data['nama']) . '.pdf';

        // Stream langsung ke browser preview
        return $pdf->stream($filename);
    }
}
