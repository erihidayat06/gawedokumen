<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: {!! $selected_font == 'font-serif'
                ? 'Times New Roman, Times, serif'
                : ($selected_font == 'font-sans'
                    ? 'Arial, Helvetica, sans-serif'
                    : 'Courier New, Courier, monospace') !!};
            line-height: 1.6;
            font-size: 12pt;
            color: #000;
            margin: 0;
            padding: 10mm 13mm 10mm 13mm;

            /* Tambahan agar semua teks otomatis rata kanan-kiri */
            text-align: justify;
            text-justify: inter-word;
        }

        .page {
            width: 100%;
        }

        /* Styling Kop Surat Resmi */
        .header-kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header-kop h1 {
            font-size: 20pt;
            text-transform: uppercase;
            margin: 0;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .header-kop p {
            font-size: 10pt;
            color: #333;
            margin: 5px 0 0 0;
        }

        /* Judul Dokumen Paklaring */
        .title-dokumen {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-dokumen h2 {
            font-size: 14pt;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 0;
            font-weight: bold;
        }

        .title-dokumen p {
            font-size: 11pt;
            margin: 5px 0 0 0;
        }

        .text-justify {
            text-align: justify;
        }

        .mb-4 {
            margin-bottom: 15px;
        }

        .mb-6 {
            margin-bottom: 25px;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Styling Tabel Data Karyawan */
        table.data-karyawan {
            width: 100%;
            border-collapse: collapse;
            margin-left: 20px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        table.data-karyawan td {
            vertical-align: top;
            padding: 4px 0;
        }

        /* Area Konfigurasi Posisi TTD */
        .ttd-wrapper {
            margin-top: 40px;
            width: 100%;
        }

        .ttd-box {
            width: 250px;
            text-align: center;
            font-size: 11pt;
        }

        .title-atasan {
            font-size: 10pt;
            color: #333;
            margin-top: 2px;
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- 1. KOP SURAT PERUSAHAAN -->
        <div class="header-kop">
            <h1>{{ $pt }}</h1>
            <p>{{ $alamat_perusahaan }}</p>
        </div>

        <!-- 2. JUDUL DOKUMEN & NOMOR -->
        <div class="title-dokumen">
            <h2>Surat Keterangan
                Pengalaman Kerja</h2>
            <p>No: {{ $no_surat }}</p>
        </div>

        <!-- 3. PARAGRAF PEMBUKA -->
        <div class="text-justify mb-4">
            Yang bertanda tangan di bawah ini mewakili manajemen <strong>{{ $pt }}</strong>, menerangkan
            dengan sebenarnya bahwa karyawan kami:
        </div>

        <!-- 4. TABEL IDENTITAS KARYAWAN -->
        <table class="data-karyawan mb-4">
            <tr>
                <td width="30%">Nama Lengkap</td>
                <td width="3%">:</td>
                <td class="font-bold">{{ $nama_karyawan }}</td>
            </tr>
            <tr>
                <td>NIK / No. KTP</td>
                <td>:</td>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <td>Jabatan Terakhir</td>
                <td>:</td>
                <td>{{ $posisi }}</td>
            </tr>
        </table>

        <div class="text-justify mb-4">
            Adalah benar telah bekerja pada perusahaan kami dalam kurun waktu terhitung sejak tanggal
            <strong class="font-bold">{{ $tanggal_mulai }}</strong> sampai dengan tanggal
            <strong class="font-bold">{{ $tanggal_selesai }}</strong>. Saudara/i yang
            bersangkutan berhenti bekerja dikarenakan <span>{{ $alasan_keluar }}</span>.
        </div>

        <div class="text-justify mb-6">
            Selama menjadi bagian dari perusahaan kami, Saudara/i <strong
                class="font-bold">{{ $nama_karyawan }}</strong>
            telah menunjukkan dedikasi, loyalitas, serta kontribusi yang baik untuk operasional dan perkembangan
            perusahaan.
            Seluruh tanggung jawab pekerjaan yang diberikan telah diselesaikan dengan integritas yang tinggi.
        </div>

        <div class="text-justify mb-10">
            Kami mengucapkan terima kasih yang sebesar-besarnya atas pengabdian yang telah diberikan. Semoga
            pengalaman kerja yang didapatkan di sini dapat bermanfaat untuk mendukung kesuksesan karier di masa yang
            akan datang.
        </div>

        <!-- 7. BAGIAN TANDA TANGAN ATASAN (Dinamis Berdasarkan Controller) -->
        <div class="ttd-wrapper">
            @php
                // Pemetaan posisi float CSS berdasarkan class alignment Tailwind
                $float = 'right';
                if ($ttd_align == 'items-start') {
                    $float = 'left';
                }
                if ($ttd_align == 'items-center') {
                    $float = 'none';
                }

                $margin = $float == 'none' ? '0 auto' : '0';
            @endphp

            <div class="ttd-box" style="float: {{ $float }}; margin: {{ $margin }};">
                <!-- Tempat & Tanggal Penerbitan Surat Paklaring -->
                <span>{{ $kota_perusahaan }}, {{ $tanggal_surat }}</span>
                <span class="font-bold" style="display: block; margin-top: 2px;">{{ $pt }}</span>

                <!-- Ruang Cetak Gambar TTD / Stempel Base64 -->
                <div style="height: 80px; margin: 10px 0;">
                    @if ($ttd_base64)
                        <img src="{{ $ttd_base64 }}" style="max-height: 80px; max-width: 160px;">
                    @endif
                </div>

                <!-- Nama & Jabatan Atasan Penandatangan -->
                <strong style="text-decoration: underline; display: block;">{{ $nama_atasan }}</strong>
                <span class="title-atasan">{{ $jabatan_atasan }}</span>
            </div>
            <div style="clear: both;"></div>
        </div>

    </div>
</body>

</html>
