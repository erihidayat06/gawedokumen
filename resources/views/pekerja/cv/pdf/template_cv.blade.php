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
            width: 210mm;
            height: 297mm;
            border-collapse: collapse;
            table-layout: fixed;
            /* Penting agar kolom tidak melar */
            /* Menggunakan public_path agar dompdf bisa membaca file lokal */
            background: url('{{ public_path('img/cv/cv1.jpg') }}') no-repeat;
            background-size: cover;
        }

        /* Sidebar (Kolom Kiri) */
        .sidebar {
            width: 80mm;

        }

        /* Konten Utama (Kolom Kanan) */
        .main-content {
            width: 130mm;
            vertical-align: top;
            padding: 15mm 15mm 10mm 10mm;
        }

        /* Perbaikan Gambar Avatar agar Bulat Sempurna */
        .avatar-container {
            text-align: center;
            margin-right: 56px;
            margin-top: 58px;
        }

        .avatar {
            width: 210px;
            height: 210px;
            border-radius: 100%;
            /* Dompdf butuh angka spesifik (setengah lebar) */
            border: 4px solid #f8fafc;
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
            width: 67mm;
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
            border-bottom: 4px solid #1d8bbe;
            padding-bottom: 15px;
        }

        .header-name h1 {
            font-size: 30pt;
            font-weight: 900;
            margin: 0;
            color: #1e293b;
        }

        .header-name h2 {
            font-size: 16pt;
            color: #1d8bbe;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin: 5px 0 0 0;
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

        /* List Items */
        .list-item {
            margin-top: 15px;
        }

        .list-item-title {
            font-weight: bold;
            font-size: 12pt;
            color: #1e293b;
        }

        .list-item-sub {
            color: #1d8bbe;
            font-size: 10pt;
        }

        .list-item-desc {
            font-size: 10pt;
            color: #64748b;
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
            font-size: 13pt;
            color: #f1f5f9;
            /* Ganti kode HEX ini untuk ubah warna ikon */
            padding-top: 2px;
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
            width: 20px;
            font-family: 'DejaVu Sans', sans-serif;
            color: #ffffff;
            /* Warna hijau, silakan ganti sesuai tema */
            font-size: 10pt;
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
                    <img src="{{ $avatar }}" class="avatar">
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
                <div class="header-name">
                    <h3>{{ $nama }}</h1>
                        <h2>{{ $posisi }}</h2>
                </div>

                <div class="section-title">Profil</div>
                <p class="profile-text">{{ $profil }}</p>

                <div class="section-title">Pengalaman Kerja</div>
                @foreach ($experience as $exp)
                    <div class="list-item">
                        <div class="list-item-title">{{ $exp['jabatan'] }}</div>
                        <div class="list-item-sub">{{ $exp['tahun'] }}</div>
                        <div class="list-item-desc">{{ $exp['deskripsi'] }}</div>
                    </div>
                @endforeach

                <div class="section-title">Pendidikan</div>
                @foreach ($pendidikan as $edu)
                    <div class="list-item">
                        <div class="list-item-title">{{ $edu['instansi'] }}</div>
                        <div class="list-item-sub">{{ $edu['tahun'] }} | {{ $edu['gelar'] }}</div>
                    </div>
                @endforeach
            </td>
        </tr>
    </table>

</body>

</html>
