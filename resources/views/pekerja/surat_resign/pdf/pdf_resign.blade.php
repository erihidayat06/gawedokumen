<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengunduran Diri</title>
    <style>
        /* 1. Serahkan margin langsung ke halaman kertas (Paling Aman untuk DomPDF) */
        @page {
            size: A4;
            margin: 15mm 15mm 15mm 15mm;
            /* Atur batas dinding kertas rata 20mm */
        }

        body {
            font-family: {!! $selected_font !!};
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #1e293b;
            /* text-slate-800 */
            -webkit-print-color-adjust: exact;
        }

        /* 2. Gunakan width 100% agar otomatis patuh pada ruang aman @page */
        .page-container {
            width: 100%;
            font-size: 12pt;
            line-height: 1.6;
            box-sizing: border-box;
        }

        .text-left {
            text-align: left;
        }

        .text-justify {
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }

        /* Margin Utilitas Jarak Paragraf */
        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-4 {
            margin-bottom: 10px;
        }

        .mb-6 {
            margin-bottom: 24px;
        }

        .mb-10 {
            margin-bottom: 40px;
        }

        .mt-10 {
            margin-top: 40px;
        }


        /* Sesuaikan tabel profil */
        .profile-table {
            margin-bottom: 10px;
            /* Tetap pakai fixed untuk kontrol lebar kolom */
        }

        /* Kunci tinggi baris agar tidak terlalu renggang */
        .profile-table tr {
            height: 22px;
            /* Diturunkan dari 28px agar lebih rapat vertikal */
        }

        .profile-table td {

            padding: 2px 0;

            /* Menjaga jarak padding tetap tipis */
        }

        /* 4. Kunci tabel TTD dengan table-layout fixed agar persentase kolom stabil */
        .ttd-wrapper {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            table-layout: fixed;
        }

        /* Box Frame Tempat Gambar Tanda Tangan Base64 */
        .ttd-box {
            width: 128px;
            /* Setara w-32 */
            height: 96px;
            /* Setara h-24 */
            margin: 0 auto;
        }

        .ttd-image {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="page-container">

        <div class="text-left mb-4">
            {{ $kota }}, {{ $tanggal }}
        </div>

        <div class="text-left mb-1">Perihal: Permohonan Pengunduran Diri (Resign)</div>


        <div class="text-left mb-4">
            Kepada Yth,<br>
            <strong>Bapak/Ibu HRD <span>{{ $pt }}</span></strong><br>
            <span>{{ $alamat_perusahaan }}</span><br>
            <span>{{ $kota_perusahaan }}</span>
        </div>

        <div class="text-left mb-4">Dengan Hormat,</div>

        <div class="text-justify mb-4">
            Melalui surat ini, saya yang bertanda tangan di bawah ini mengajukan permohonan untuk mengundurkan diri
            dari jabatan dan posisi saya di <span>{{ $pt }}</span>. Adapun data diri saya adalah
            sebagai berikut:
        </div>

        <table class="profile-table">
            <tr>
                <td style="width: 130px;">Nama Lengkap</td>
                <td style="width: 15px;">:</td>
                <td><strong><span>{{ $nama }}</span></strong></td>
            </tr>
            <tr>
                <td>NIK Karyawan</td>
                <td>:</td>
                <td><span>{{ $nik }}</span></td>
            </tr>
            <tr>
                <td>Jabatan / Posisi</td>
                <td>:</td>
                <td><span>{{ $jabatan }}</span></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td>:</td>
                <td><span>{{ $departemen }}</span></td>
            </tr>
        </table>

        <div class="text-justify mb-4">
            Ketetapan pengunduran diri ini terhitung efektif mulai tanggal
            <strong><span>{{ $tanggal_efektif }}</span></strong>. Langkah berat ini saya ambil
            dikarenakan <span>{{ $alasan }}</span>.
        </div>

        <div class="text-justify mb-4">
            Saya mengucapkan banyak terima kasih yang sebesar-besarnya atas kesempatan, ilmu, dan bimbingan berharga
            yang telah saya dapatkan selama bekerja sebagai <span>{{ $jabatan }}</span> di
            perusahaan ini. Saya juga memohon maaf yang sedalam-dalamnya kepada seluruh jajaran manajemen serta
            rekan kerja jika terdapat kesalahan baik sikap maupun tutur kata selama saya bertugas.
        </div>

        <div class="text-justify mb-4">
            Sembari berharap tali silaturahmi di antara kita tetap terjaga baik, saya mendoakan agar perusahaan
            senantiasa berkembang dan mendapatkan kesuksesan yang lebih besar di masa yang akan datang.
        </div>

        <table class="ttd-wrapper">
            <tr>
                @if ($ttd_align === 'items-start')
                    <td style="width: 40%; text-align: left;">
                    @elseif($ttd_align === 'items-center')
                    <td style="width: 30%;"></td>
                    <td style="width: 40%; text-align: center;">
                    @else
                    <td style="width: 60%;"></td>
                    <td style="width: 40%; text-align: center;">
                @endif

                <div class="text-center">
                    <span style="display: block; margin-bottom: 8px;">Hormat saya,</span>

                    <div class="ttd-box">
                        @if ($ttd_base64)
                            <img src="{{ $ttd_base64 }}" class="ttd-image" alt="Tanda Tangan">
                        @else
                            <div style="height: 75px;"></div>
                        @endif
                    </div>

                    <div style="margin-top: 8px; font-weight: bold; text-decoration: underline;">
                        <span>{{ $nama }}</span>
                    </div>
                </div>

                </td>
                @if ($ttd_align === 'items-start')
                    <td style="width: 60%;"></td>
                @elseif($ttd_align === 'items-center')
                    <td style="width: 30%;"></td>
                @endif
            </tr>
        </table>

    </div>

</body>

</html>
