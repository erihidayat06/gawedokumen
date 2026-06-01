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

        .text-left {
            text-align: left;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-semibold {
            font-weight: bold;
        }

        .jarak-paragraf {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 2px 0;
        }

        /* --- TANDA TANGAN SYSTEM (FLOATED FOR DOMPDF) --- */
        .ttd-wrapper {
            margin-top: 30px;
            width: 100%;
            padding-left: 0;
            padding-right: 10mm;
        }

        .ttd-box {
            width: 200px;
            text-align: center;
        }

        .ttd-space {
            height: 80px;
            margin: 10px 0;
        }

        .ttd-space img {
            max-height: 80px;
            max-width: 150px;
        }
    </style>
</head>

<body>
    <div class="page">

        <div class="jarak-paragraf text-left">
            {{ $kota }}, {{ $tanggal_indo }}
        </div>

        <div class="jarak-paragraf text-left">Perihal: Lamaran Pekerjaan</div>

        <div class="jarak-paragraf text-left">
            Kepada Yth,<br>
            HRD {{ $pt }}<br>
            {{ $alamat_perusahaan }}, {{ $kota_perusahaan }}
        </div>

        <div class="jarak-paragraf text-left">Dengan Hormat,</div>

        <div class="jarak-paragraf text-justify">
            Sehubungan dengan informasi lowongan kerja di {{ $media }} untuk posisi <span
                class="font-semibold">{{ $posisi }}</span>, saya yang bertanda tangan di bawah ini:
        </div>

        <div class="jarak-paragraf">
            <table>
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
                    <td>Tempat/Tanggal Lahir</td>
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
        </div>

        {{-- PENAMBAHAN PARAGRAF KUALIFIKASI DAN KEAHLIAN --}}
        <div class="jarak-paragraf text-justify">
            {{ $kualifikasi }}. Selain itu, saya juga membekali diri dengan keahlian kompeten di antaranya yaitu
            {{ $keahlian }} yang dapat menunjang produktivitas di perusahaan Bapak/Ibu.
        </div>

        <div class="jarak-paragraf text-justify" style="margin-bottom: 5px;">
            Sebagai bahan pertimbangan, bersama surat ini saya lampirkan beberapa dokumen pendukung:
        </div>

        <div style="margin-bottom: 20px;">
            <ol style="margin: 0; padding-left: 25px;">
                @foreach ($lampiran as $item)
                    <li style="margin-bottom: 2px;">{{ $item }}</li>
                @endforeach
            </ol>
        </div>

        <div class="jarak-paragraf text-justify">
            Demikian surat lamaran ini saya sampaikan. Besar harapan saya untuk diberikan kesempatan wawancara agar
            dapat mendiskusikan kontribusi saya lebih mendalam. Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.
        </div>

        <div class="ttd-wrapper">
            @php
                // Logika penentuan posisi tanda tangan
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
                <span style="font-size: 11pt; display: block;">Hormat saya,</span>
                <div class="ttd-space">
                    @if ($ttd_base64)
                        <img src="{{ $ttd_base64 }}" alt="Tanda Tangan">
                    @endif
                </div>
                <div class="font-bold" style="text-decoration: underline;">
                    {{ $nama }}
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</body>

</html>
