<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: {!! $selected_font !!};
            line-height: 1.6;
            font-size: 12pt;
            color: #333;
            margin: 0;
        }

        .page {
            width: 100%;
        }

        .text-justify {
            text-align: justify;
        }

        .text-right {
            text-align: right;
        }

        .mt-10 {
            margin-top: 40px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .font-bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 2px 0;
        }

        .signature-area {
            width: 200px;
            float: right;
            text-align: center;
        }

        .signature-space {
            height: 80px;
        }

        .ttd-wrapper {
            margin-top: 30px;
            width: 100%;
            /* Beri padding agar tidak mepet pinggir kertas */
            padding-left: 0;
            padding-right: 10mm;
        }

        .ttd-box {
            width: 200px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="mb-5">
            {{ $kota }}, {{ $tanggal_indo }}
        </div>

        <div class="mb-5">Perihal: Lamaran Pekerjaan</div>

        <div class="mb-5">
            Kepada,<br>
            HRD {{ $pt }}<br>
            {{ $alamat_perusahaan }}<br>
            {{ $kota_perusahaan }}
        </div>

        <div class="mb-5">Dengan Hormat,</div>

        <div class="text-justify mb-5">
            Sehubungan dengan informasi lowongan kerja yang saya dapatkan di {{ $media }},
            saya mengetahui bahwa perusahaan {{ $pt }} sedang mencari posisi {{ $posisi }}.
            Untuk itu, saya yang bertanda tangan di bawah ini:
        </div>

        <table class="mb-5">
            <tr>
                <td width="30%">Nama</td>
                <td width="2%">:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $jk }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl Lahir</td>
                <td>:</td>
                <td>{{ $tempat_lahir }}, {{ $tanggal_lahir_indo }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat_diri }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>:</td>
                <td>{{ $no_tlp }}</td>
            </tr>
        </table>

        <div class="text-justify">
            Dengan ini bermaksud untuk melamar posisi {{ $posisi }} di {{ $pt }}.
            Sebagai bahan pertimbangan, saya sertakan beberapa dokumen berikut:
        </div>

        <div class="mb-5">
            <ol>
                @foreach ($lampiran as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>

        <div class="text-justify mb-5">
            Demikian surat lamaran kerja ini, saya ucapkan terima kasih atas perhatian Bapak/Ibu HRD.
        </div>

        <div class="ttd-wrapper">
            @php
                // Logika penentuan posisi
                $float = 'right';
                if ($ttd_align == 'items-start') {
                    $float = 'left';
                }
                if ($ttd_align == 'items-center') {
                    $float = 'none';
                }

                // Jarak tambahan agar tidak mentok ke garis potong kertas
                $margin = $float == 'none' ? '0 auto' : '0';
            @endphp

            <div class="ttd-box" style="float: {{ $float }}; margin: {{ $margin }};">
                <span>Hormat saya,</span>
                <div style="height: 80px; margin: 10px 0;">
                    @if ($ttd_base64)
                        <img src="{{ $ttd_base64 }}" style="max-height: 80px; max-width: 150px;">
                    @endif
                </div>
                <strong style="text-decoration: underline;">{{ $nama }}</strong>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</body>

</html>
