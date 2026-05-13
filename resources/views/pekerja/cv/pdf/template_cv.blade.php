<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Curriculum Vitae</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif !important;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            /* Ukuran A4 Fix */
            width: 210mm;
            height: 297mm;
        }


        .wrapper {
            width: 205mm;
            height: 297mm;
            border-collapse: collapse;
            table-layout: fixed;
            background: url('{{ public_path('img/cv/cv1.jpg') }}') no-repeat;
            background-size: cover;
        }

        /* Sidebar (Kolom Kiri) */

        .sidebar {
            width: 48%;
        }


        /* Konten Utama (Kolom Kanan) */
        .main-content {
            vertical-align: top;
            padding: 15mm 15mm 10mm 0;

            position: relative;
            left: -15mm;
            /* Tarik paksa ke kiri */
        }

        .avatar-container {
            width: 210px;
            height: auto;
            margin-top: 15.5mm;
            margin-left: 16mm;
        }

        .avatar {
            width: 210px;
            height: 210px;

            /* Pengganti object-fit: cover */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            /* Agar jadi lingkaran sempurna */
            border-radius: 105px;
            /* Setengah dari width/height */
            border: 4px solid #f8fafc;
        }

        img,
        .avatar {
            image-rendering: optimizeQuality;
            -ms-interpolation-mode: bicubic;
        }

        /* Sisanya biarkan seperti kode Anda sebelumnya */
        .sidebar-header {
            background-color: #f1f5f9;
            width: 65mm;
            margin-top: 10mm;
            padding: 9px 20px;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .sidebar-header span {
            font-size: 16pt;
            font-weight: bold;
            color: #1d8bbe;
            text-transform: uppercase;
        }

        .sidebar-item {
            padding-left: 35px;
            margin-top: 8px;
            color: #f8fafc;
        }

        .sidebar-item h3 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .sidebar-item p,
        .sidebar-item span {
            font-size: 11pt;
        }

        /* Konten Kanan */

        .header-name {
            /* Hapus border-bottom di sini */
            margin: 0;
            padding: 0;
            width: 100%;
            border-bottom: 4px solid #1d8bbe;
        }

        .header-name .nama {
            font-size: 32px;
            margin: 0px;
            font-weight: bold;
        }

        .header-name .posisi {
            font-size: 16pt;
            color: #1d8bbe;
            letter-spacing: 3px;
            text-transform: uppercase;

            /* Pindahkan ke sini */

            margin: 0;
            /* Hilangkan margin bawaan agar tidak ada jarak */
            padding-bottom: 10px;
            /* Gunakan padding untuk mengatur jarak garis ke teks secara presisi */
            display: inline-block;
            /* Agar garis hanya sepanjang teks, bukan selebar halaman */
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #1e293b;
            border-left: 4px solid #1d8bbe;
            padding-left: 10px;
            text-transform: uppercase;
            margin-top: 30px;
        }

        .profile-text {
            font-size: 11pt;
            color: #475569;
            margin-top: 10px;
            text-align: justify;
        }

        .list-item {
            margin-bottom: 10px;
            /* Jarak antar riwayat pendidikan */
        }

        .list-item-title {
            text-align: left;
            font-weight: bold;
            font-size: 12pt;
            width: 100%;
        }

        .list-item-year {
            text-align: right;
            color: #666;
            font-size: 10pt;
            width: 5%;
            vertical-align: top;
        }

        .list-item-sub {
            font-size: 11pt;
            color: #333;
            margin-top: 2px;
        }

        .list-item-desc {
            font-size: 10pt;
            text-align: justify;
            margin-top: 5px;
            line-height: 1.4;
        }

        /* Container utama per item */
        .list-item {
            margin-bottom: 12px;
            margin-top: 1rem;
            width: 100%;
        }

        /* Tabel untuk Header (Judul & Tahun) */
        .item-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        /* Judul (Jabatan / Instansi) */
        .item-title {
            text-align: left;
            font-weight: bold;
            font-size: 12pt;
            vertical-align: top;
            width: 70%;
        }

        /* Tahun di sebelah kanan */
        .item-year {
            text-align: right;
            color: #666666;
            font-size: 10pt;
            vertical-align: top;
            width: 30%;
        }

        /* Deskripsi pengalaman */
        .list-item-desc {
            font-size: 10.5pt;
            color: #333333;
            text-align: justify;
            line-height: 1.4;
        }

        /* Sub-judul (Gelar atau Nama Perusahaan) */
        .list-item-sub {
            font-size: 11pt;
            font-style: italic;
            color: #444444;
            margin-bottom: 3px;
        }
    </style>

    <style>
        .contact-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .contact-table td {
            vertical-align: top;
            padding-bottom: 12px;
        }

        /* Di sini kamu bisa ganti warna ikon sesukamu */
        .icon-box {
            width: 25px;
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 16pt;
            color: #f1f5f9;
            /* Ganti kode HEX ini untuk ubah warna ikon */
            padding-top: 2px;
            padding-right: 5px;
        }

        .contact-info h3 {
            margin: 0;
            font-size: 11pt;
            font-weight: bold;
            color: #f8fafc;
            font-family: 'Helvetica', sans-serif;
        }

        .contact-info span {
            font-size: 10pt;
            color: #ffffff;
            font-family: 'Helvetica', sans-serif;
            word-wrap: break-word;
        }
    </style>

    <style>
        .skill-table {
            width: 100%;
            border-collapse: collapse;
        }

        .skill-table td {
            vertical-align: top;
            padding-bottom: 5px;
        }

        .check-icon {
            width: 1rem;
            font-family: 'DejaVu Sans', sans-serif;
            color: #ffffff;
            /* Warna hijau, silakan ganti sesuai tema */
            font-size: 12pt;
        }

        .skill-text {
            font-size: 10pt;
            color: #f8fafc;
            font-family: 'Helvetica', sans-serif;
        }
    </style>
</head>

<body>

    <table class="wrapper">
        <tr>
            <!-- SIDEBAR -->
            <td class="sidebar">
                <div class="avatar-container">
                    <div class="avatar" style="background-image: url('{{ $avatar }}');"></div>
                </div>

                <div class="sidebar-header">
                    <span>Data Diri</span>
                </div>
                <div class="sidebar-item" style="margin-top: 10px;">
                    <h3>Tempat/Tgl Lahir</h3>
                    <span>{{ $tempat_lahir }}, {{ $tanggal_lahir }}</span>
                </div>
                <div class="sidebar-item">
                    <h3>Jenis Kelamin</h3>
                    <span>{{ $jk }}</span>
                </div>
                <div class="sidebar-item">
                    <h3>Kewarganegaraan</h3>
                    <span>{{ $kewarganegaraan }}</span>
                </div>

                <div class="sidebar-header">
                    <span>Kontak</span>
                </div>
                <table class="contact-table sidebar-item">
                    <!-- Telepon -->
                    <tr>
                        <td class="icon-box">&#9743;</td> <!-- Simbol telepon klasik (☏) -->
                        <td class="contact-info">
                            <h3>Telepon</h3>
                            <span>{{ $no_tlp }}</span>
                        </td>
                    </tr>

                    <!-- Email -->
                    <tr>
                        <td class="icon-box">&#9993;</td> <!-- Simbol amplop (✉) -->
                        <td class="contact-info">
                            <h3>Email</h3>
                            <span>{{ $email }}</span>
                        </td>
                    </tr>

                    <!-- Alamat -->
                    <tr>
                        <td class="icon-box">&#10148;</td> <!-- Simbol panah/pointer lokasi (➔) -->
                        <td class="contact-info">
                            <h3>Alamat</h3>
                            <span>{{ $alamat_diri }}</span>
                        </td>
                    </tr>
                </table>
                <div class="sidebar-header">
                    <span>Keahlian</span>
                </div>
                <div class="sidebar-item" style="margin-top: 10px;">
                    <table class="skill-table">
                        @foreach ($keahlian as $skill)
                            <tr>
                                <td class="check-icon">✔</td>
                                <td class="skill-text">{{ $skill }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </td>

            <!-- MAIN CONTENT -->
            <td class="main-content">

                <table class="header-name">
                    <tr>
                        <span class="nama">{{ $nama }}</h1>
                    </tr>
                    <tr>
                        <span class="posisi">{{ $posisi }}</span>
                    </tr>
                </table>




                <div class="section-title">Profil</div>
                <p class="profile-text">{{ $profil }}</p>

                <div class="section-title">Pengalaman Kerja</div>
                @foreach ($experience as $exp)
                    <div class="list-item">
                        <table class="item-header-table">
                            <tr>
                                <td class="item-title">{{ $exp['jabatan'] }}</td>
                                <td class="item-year">{{ $exp['tahun'] }}</td>
                            </tr>
                        </table>
                        <div class="list-item-desc">{{ $exp['deskripsi'] }}</div>
                    </div>
                @endforeach

                <div class="section-title">Pendidikan</div>
                @foreach ($pendidikan as $edu)
                    <div class="list-item">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td class="list-item-title">{{ $edu['instansi'] }}</td>
                                <td class="list-item-year">{{ $edu['tahun'] }} </td>
                            </tr>
                        </table>
                        <div class="list-item-sub">{{ $edu['gelar'] }}</div>
                    </div>
                @endforeach
            </td>
        </tr>
    </table>

</body>

</html>
