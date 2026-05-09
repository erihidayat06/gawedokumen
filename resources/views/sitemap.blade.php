{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- 1. Halaman Utama --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2026-04-18T00:00:00+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- 2. Halaman Index Loker --}}
    <url>
        <loc>{{ url('/loker') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- 3. URL CANTIK WILAYAH (Baru ditambahkan agar terindeks Google) --}}
    @foreach (['kabupaten-tegal', 'kota-tegal', 'brebes', 'pemalang', 'slawi'] as $w)
        <url>
            <loc>{{ url('/loker/wilayah/' . $w) }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- 4. Looping Semua Loker Aktif --}}
    @foreach ($lokers as $loker)
        <url>
            <loc>{{ url('/loker/' . $loker->slug) }}</loc>
            <lastmod>{{ $loker->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- 5. Tools Generator & Pekerja --}}
    <url>
        <loc>{{ url('/pekerja/surat-lamaran') }}</loc>
        <lastmod>2026-04-18T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ url('/tool/kompres-pdf') }}</loc>
        <lastmod>2026-04-23T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ url('/tool/kompres-gambar') }}</loc>
        <lastmod>2026-04-29T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ url('/tool/tanda-tangan-digital') }}</loc>
        <lastmod>2026-04-23T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- 6. Halaman Index Blog --}}
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- 7. Looping Semua Artikel Blog --}}
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/blog/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

</urlset>
