<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PaklaringController extends Controller
{
    public function index()
    {
        return view('pekerja.paklaring.index');
    }

    public function generatePdf(Request $request)
    {
        // Set locale agar format tanggal otomatis berbahasa Indonesia
        app()->setLocale('id');

        $data = [
            // 1. Bagian Perusahaan (Head)
            'no_surat'          => $request->no_surat ?? '001/HRD/PK/' . date('Y'),
            'pt'                => $request->pt ?? 'PT. Nama Perusahaan',
            'alamat_perusahaan' => $request->alamat_perusahaan ?? 'Jl. Jalur Utama No. X, Kota',
            'kota_perusahaan'   => $request->kota_perusahaan ?? 'Kota Perusahaan',

            // Format Tanggal Penerbitan Surat Paklaring
            'tanggal_surat'     => $request->tanggal_surat
                ? Carbon::parse($request->tanggal_surat)->translatedFormat('d F Y')
                : Carbon::now()->translatedFormat('d F Y'),

            // 2. Bagian Data Karyawan
            'nama_karyawan'     => $request->nama_karyawan ?? 'Nama Karyawan',
            'nik'               => $request->nik ?? '1234567890',
            'posisi'            => $request->posisi ?? 'Staff Administrasi',

            // 3. Bagian Masa Kerja & Keterangan
            // Format Tanggal Mulai Kerja
            'tanggal_mulai'     => $request->tanggal_mulai
                ? Carbon::parse($request->tanggal_mulai)->translatedFormat('d F Y')
                : 'Tanggal Mulai',

            // Format Tanggal Selesai Kerja
            'tanggal_selesai'   => $request->tanggal_selesai
                ? Carbon::parse($request->tanggal_selesai)->translatedFormat('d F Y')
                : 'Tanggal Selesai',

            'alasan_keluar'     => $request->alasan_keluar ?? 'Pengunduran Diri (Resign)',

            // 4. Bagian Penandatangan (Atasan) & Opsi Desain Layout
            'nama_atasan'       => $request->nama_atasan ?? 'Nama Manager / Owner',
            'jabatan_atasan'    => $request->jabatan_atasan ?? 'HRD Manager',
            'ttd_align'         => $request->ttd_align ?? 'items-end',
            'selected_font'     => $request->font_style ?? 'font-serif', // Default font-serif untuk keabsahan hukum formal

            // Tanda tangan digital mentah base64 (Stempel/TTD Atasan)
            'ttd_base64'        => $request->ttd_base64
        ];

        // Simpan data array paklaring ke dalam session kustom
        session(['paklaring_data' => $data]);

        // Alihkan (Redirect) ke route preview ber-method GET
        return redirect()->route('pekerja.surat.paklaring.pdf.preview');
    }

    /**
     * Mengambil data Paklaring dari Session dan merendernya ke DomPDF (GET).
     */
    public function previewPdf()
    {
        // Ambil data paklaring yang tersimpan dari session
        $data = session('paklaring_data');

        // Proteksi jika user langsung tembak URL preview tanpa isi form
        if (!$data) {
            return redirect()->back()->with('error', 'Data dokumen paklaring tidak ditemukan atau session kedaluwarsa.');
        }

        // Load view PDF khusus Surat Paklaring (Sesuaikan nama file blade-mu di sini)
        $pdf = Pdf::loadView('pekerja.paklaring.pdf.pdf_paklaring', $data);

        // Buat nama file PDF dinamis agar rapi (Contoh: Surat_Paklaring_Budi_Santoso.pdf)
        $filename = 'Surat_Paklaring_' . str_replace(' ', '_', $data['nama_karyawan']) . '.pdf';

        // Stream langsung ke browser preview halaman PDF
        return $pdf->stream($filename);
    }
}
