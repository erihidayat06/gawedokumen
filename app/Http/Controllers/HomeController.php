<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestBlogs = Blog::select('judul', 'slug', 'gambar', 'kategori')
            ->latest()
            ->limit(3)
            ->get();

        return view('index', compact('latestBlogs'));
    }


    public function show($category)
    {
        // Ubah slug (pekerja) jadi Nama Kategori (Pekerja)
        $categoryName = ucfirst(str_replace('-', ' ', $category));

        // Filter tools berdasarkan kategori
        $tools = match ($category) {
            // 'pelajar' => [
            //     (object)[
            //         'nama_tool' => 'Label Buku Sekolah',
            //         'deskripsi' => 'Cetak label nama untuk buku pelajaran dengan berbagai desain keren.',
            //         'route_path' => '/pelajar/label-buku'
            //     ],
            //     (object)[
            //         'nama_tool' => 'Sampul Tugas Makalah',
            //         'deskripsi' => 'Buat cover depan makalah atau tugas sekolah yang rapi dan standar.',
            //         'route_path' => '/pelajar/sampul-tugas'
            //     ],
            // ],
            'pekerja' => [
                (object)[
                    'gambar' => '/img/lamaran_kerja.png',
                    'nama_tool' => 'Surat Lamaran Kerja',
                    'deskripsi' => 'Buat surat lamaran (Cover Letter) profesional standar HRD 2026.',
                    'route_path' => '/pekerja/surat-lamaran'
                ],
                // (object)[
                //     'gambar' => '/img/lamaran_kerja.png',
                //     'nama_tool' => 'CV',
                //     'deskripsi' => 'Buat CV (Curriculum Vitae) profesional dengan format ATS-friendly agar mudah dilirik HRD.',
                //     'route_path' => '/pekerja/generate-cv'
                // ],

            ],
            // 'masyarakat' => [
            //     (object)[
            //         'nama_tool' => 'Surat Izin Domisili',
            //         'deskripsi' => 'Format surat keterangan domisili untuk berbagai keperluan administrasi.',
            //         'route_path' => '/masyarakat/surat-domisili'
            //     ],
            //     (object)[
            //         'nama_tool' => 'Undangan Syukuran',
            //         'deskripsi' => 'Buat undangan tasyakuran atau acara warga dengan simpel.',
            //         'route_path' => '/masyarakat/undangan-syukuran'
            //     ],
            // ],
            // 'umkm' => [
            //     (object)[
            //         'nama_tool' => 'Label Harga Produk',
            //         'deskripsi' => 'Cetak label harga dan nama produk untuk etalase jualan Anda.',
            //         'route_path' => '/umkm/label-harga'
            //     ],
            //     (object)[
            //         'nama_tool' => 'Nota Penjualan Simpel',
            //         'deskripsi' => 'Buat struk atau nota belanja sederhana untuk pelanggan.',
            //         'route_path' => '/umkm/nota-penjualan'
            //     ],
            // ],
            default => abort(404), // Jika kategori tidak ditemukan, munculkan 404
        };

        return view('kategori', compact('categoryName', 'tools'));
    }
}
