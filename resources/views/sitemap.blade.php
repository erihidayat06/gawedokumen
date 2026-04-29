{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- 1. Halaman Utama --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2026-04-18T00:00:00+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- 2. Tool Generator Surat Lamaran (PENTING!) --}}
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

    {{-- 3. Halaman Daftar Blog (Index Blog) --}}
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- 4. Looping Kabeh Artikel Blog --}}
    {{-- 4. Looping Semua Artikel Blog dengan URL Baru --}}
    @foreach ($posts as $post)
        <url>
            {{-- Sesuaikan dengan rute baru: domain.com/blog/slug-artikel --}}
            <loc>{{ url('/blog/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

</urlset>
