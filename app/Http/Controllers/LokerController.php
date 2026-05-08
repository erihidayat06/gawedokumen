<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LokerController extends Controller
{
    public function index()
    {
        // Set locale ke Indonesia agar nama bulan otomatis bahasa Indonesia
        app()->setLocale('id');
        $bulanSekarang = Carbon::now()->translatedFormat('F Y');

        // Data Dummy yang lebih bervariasi untuk mengisi layout
        $lokers = collect([
            (object)[
                'posisi' => 'Admin Gudang',
                'perusahaan' => 'PT. Logistik Maju Jaya',
                'kecamatan' => 'Adiwerna',
                'kota' => 'Tegal',
                'slug' => Str::slug("Admin Gudang Adiwerna Tegal $bulanSekarang"),
                'gaji' => 'Rp 2.100.000 - 2.500.000',
                'tipe_pekerjaan' => 'Full Time',
                'deadline' => '2026-06-20',
                'created_at' => Carbon::now()->subDays(2),
                'status' => 'Aktif'
            ],
            (object)[
                'posisi' => 'Staff Operasional MBG',
                'perusahaan' => 'Yayasan Gizi Bangsa',
                'kecamatan' => 'Margadana',
                'kota' => 'Tegal',
                'slug' => Str::slug("Staff Operasional MBG Margadana Tegal $bulanSekarang"),
                'gaji' => 'Sesuai Kontrak',
                'tipe_pekerjaan' => 'Kontrak',
                'deadline' => '2026-06-15',
                'created_at' => Carbon::now()->subHours(5),
                'status' => 'Aktif'
            ],
            (object)[
                'posisi' => 'Crew Store (Kasir)',
                'perusahaan' => 'Rita Supermall',
                'kecamatan' => 'Tegal Timur',
                'kota' => 'Tegal',
                'slug' => Str::slug("Crew Store Kasir Tegal Timur $bulanSekarang"),
                'gaji' => 'UMK Tegal',
                'tipe_pekerjaan' => 'Full Time',
                'deadline' => '2026-06-10',
                'created_at' => Carbon::now()->subDays(1),
                'status' => 'Aktif'
            ],
            (object)[
                'posisi' => 'IT Support & Networking',
                'perusahaan' => 'CV. Tekno Utama',
                'kecamatan' => 'Slawi',
                'kota' => 'Kab. Tegal',
                'slug' => Str::slug("IT Support Slawi Kab Tegal $bulanSekarang"),
                'gaji' => 'Kompetitif',
                'tipe_pekerjaan' => 'Full Time',
                'deadline' => '2026-06-25',
                'created_at' => Carbon::now()->subDays(3),
                'status' => 'Aktif'
            ],
            (object)[
                'posisi' => 'Sales Marketing Executive',
                'perusahaan' => 'Dealer Motor Jaya',
                'kecamatan' => 'Talang',
                'kota' => 'Kab. Tegal',
                'slug' => Str::slug("Sales Marketing Talang Kab Tegal $bulanSekarang"),
                'gaji' => 'Gaji Pokok + Insentif',
                'tipe_pekerjaan' => 'Full Time',
                'deadline' => '2026-06-18',
                'created_at' => Carbon::now()->subHours(12),
                'status' => 'Aktif'
            ],
            (object)[
                'posisi' => 'Operator Produksi',
                'perusahaan' => 'PT. Manufaktur Garmen',
                'kecamatan' => 'Kramat',
                'kota' => 'Kab. Tegal',
                'slug' => Str::slug("Operator Produksi Kramat Kab Tegal $bulanSekarang"),
                'gaji' => 'Rp 2.100.000',
                'tipe_pekerjaan' => 'Full Time',
                'deadline' => '2026-05-30',
                'created_at' => Carbon::now()->subDays(5),
                'status' => 'Aktif'
            ],
        ]);

        return view('loker.index', compact('lokers', 'bulanSekarang'));
    }

    public function show($slug)
    {
        // Simulasi pencarian data berdasarkan slug agar halaman show tidak kosong
        // Kita pecah slug kembali untuk mendapatkan data tampilan dummy
        $cleanTitle = str_replace('-', ' ', $slug);

        $loker = (object)[
            'posisi' => ucwords(Str::before($cleanTitle, 'tegal')),
            'perusahaan' => 'PT. Contoh Perusahaan Lokal',
            'kecamatan' => 'Adiwerna',
            'kota' => 'Tegal',
            'gaji' => 'Rp 2.100.000 - 2.500.000',
            'deskripsi' => 'Kami sedang mencari kandidat yang berdedikasi untuk bergabung dengan tim kami. Pekerjaan ini melibatkan tanggung jawab operasional harian dan koordinasi tim.',
            'syarat' => json_encode([
                'Pria/Wanita, Usia maksimal 28 tahun',
                'Pendidikan minimal SMA/K sederajat',
                'Jujur, teliti, dan bertanggung jawab',
                'Mampu bekerja dalam tim maupun individu',
                'Berdomisili di Tegal dan sekitarnya'
            ]),
            'alamat_lengkap' => 'Jl. Raya Adiwerna No. 123, Kec. Adiwerna, Kab. Tegal, Jawa Tengah',
            'deadline' => '2026-06-20',
            'link_lamar' => 'https://wa.me/628123456789'
        ];

        return view('loker.show', compact('loker'));
    }
}
