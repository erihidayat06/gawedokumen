<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Portofolio Karya & Projek</title>
    <style>
        /* --- PENGATURAN HALAMAN A4 NATIVE DOMPDF --- */
        @page {
            margin: 1.0cm;
            size: A4;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #334155;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .font-sans {
            font-family: 'Helvetica', 'Arial', sans-serif;
        }

        .font-serif {
            font-family: 'Georgia', 'Times New Roman', serif;
        }

        .font-mono {
            font-family: 'Courier New', Courier, monospace;
        }

        .page-container {
            width: 100%;
        }

        /* FORCE PAGE BREAK: Dipindahkan langsung ke iterasi page */
        .page-break {
            page-break-before: always;
        }

        /* HEADER */
        .portfolio-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1e293b;
            padding-bottom: 8px;
            margin-bottom: 15px;

        }

        /* PROJEK ITEM BLOCK */
        .project-item {
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            page-break-inside: avoid;
            /* Kembalikan ke avoid agar satu blok projek utuh tidak terbelah */
        }

        .project-item:last-child {
            border-bottom: 0;
        }

        /* METADATA BAR (Peran & Alat) */
        .project-title-table {
            width: 100%;
            margin-bottom: 4px;
        }

        .project-title {
            font-size: 15px;
            font-weight: bold;
            color: #1e293b;
            margin: 0;
        }

        .project-date {
            font-size: 11px;
            color: #94a3b8;
            text-align: right;
            white-space: nowrap;
        }

        .metadata-bar {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .metadata-role {
            font-weight: bold;
            color: #475569;
        }

        .separator {
            color: #cbd5e1;
            margin: 0 5px;
        }

        /* LINK URL */
        .project-link {
            font-size: 11px;
            color: #3b82f6;
            text-decoration: underline;
            margin-bottom: 6px;
            word-wrap: break-word;
        }

        /* DYNAMIC IMAGES */
        .img-container {
            text-align: center;
            width: 100%;
            margin: 6px 0;
        }

        .project-img {
            width: 500px;
            max-height: 16rem;
            /* Diturunkan sedikit dari 180px agar ruang kertas bernapas legong */
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .project-description {
            font-size: 12px;
            color: #475569;
            white-space: pre-line;
            text-align: left;
        }
    </style>
</head>

<body class="{{ $selected_font }}">

    @foreach ($pages as $pageIndex => $page)
        <div class="page-container {{ $pageIndex > 0 ? 'page-break' : '' }}">

            @if ($page['nomor_halaman'] == 1)
                <div class="portfolio-header">
                    Portofolio Karya & Projek
                </div>
            @endif

            @foreach ($page['items'] as $projek)
                <div class="project-item">

                    <table class="project-title-table">
                        <tr>
                            <td>
                                <span class="project-title">{{ $projek['nama'] }}</span>
                            </td>
                            @if (!empty($projek['tanggal']))
                                <td class="project-date">
                                    <span>{{ $projek['tanggal'] }}</span>
                                </td>
                            @endif
                        </tr>
                    </table>

                    @if (!empty($projek['peran']) || !empty($projek['tech']))
                        <div class="metadata-bar">
                            @if (!empty($projek['peran']))
                                <span class="metadata-role">{{ $projek['peran'] }}</span>
                            @endif
                            @if (!empty($projek['peran']) && !empty($projek['tech']))
                                <span class="separator">•</span>
                            @endif
                            @if (!empty($projek['tech']))
                                <span>{{ $projek['tech'] }}</span>
                            @endif
                        </div>
                    @endif

                    @if (!empty($projek['link']) && $projek['link'] !== '#')
                        <div class="project-link font-mono">
                            <a href="{{ $projek['link'] }}" target="_blank"
                                style="color: #3b82f6; text-decoration: underline;">{{ $projek['link'] }}</a>
                        </div>
                    @endif

                    @if (!empty($projek['gambar']))
                        <div class="img-container">
                            <img src="{{ $projek['gambar'] }}" class="project-img" alt="Mockup Karya">
                        </div>
                    @endif

                    <div class="project-description">
                        {!! nl2br(e($projek['deskripsi'])) !!}
                    </div>

                </div>
            @endforeach

        </div>
    @endforeach

</body>

</html>
