@extends('layouts.app')

@section('title', $blog->judul . ' - Gawe Dokumen')
@section('meta_description', Str::limit(strip_tags($blog->konten), 160))
@section('og_image', asset('storage/uploads/blog/' . $blog->gambar))

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex mb-8 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a href="/" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600">Panduan</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900 dark:text-white truncate">{{ $blog->judul }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- ARTIKEL CONTENT --}}
                <article class="lg:col-span-8">
                    <header class="mb-10 px-4 sm:px-0">
                        <!-- Kategori: Badge tetap kecil & rapi -->
                        <span
                            class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] sm:text-xs font-bold rounded-full uppercase tracking-widest">
                            {{ $blog->kategori }}
                        </span>

                        <!-- Judul: Responsif (Mobile: text-3xl, Desktop: text-5xl) -->
                        <h1
                            class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white mt-4 mb-6 leading-[1.15] tracking-tight">
                            {{ $blog->judul }}
                        </h1>

                        <!-- Meta Info: Flex-wrap agar tidak terpotong di HP kecil -->
                        <div
                            class="flex flex-wrap items-center gap-y-3 gap-x-4 text-slate-500 dark:text-slate-400 text-xs sm:text-sm border-t border-slate-100 dark:border-slate-800 pt-6">

                            <!-- Author -->
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold ring-2 ring-white dark:ring-slate-900 shadow-sm">
                                    {{ substr($blog->author ?? 'EH', 0, 2) }}
                                </div>
                                <span class="font-semibold text-slate-700 dark:text-slate-200">
                                    {{ $blog->author ?? 'Admin GaweDokumen' }}
                                </span>
                            </div>

                            <!-- Divider & Date (Hidden di layar sangat kecil jika perlu, atau tetap ada dengan flex-wrap) -->
                            <div class="flex items-center gap-3">
                                <span class="hidden sm:inline text-slate-300 dark:text-slate-700">•</span>
                                <time datetime="{{ $blog->created_at->format('Y-m-d') }}">
                                    {{ $blog->created_at->translatedFormat('d F Y') }}
                                </time>
                            </div>

                            <!-- Divider & Reading Time -->
                            <div class="flex items-center gap-3">
                                <span class="text-slate-300 dark:text-slate-700">•</span>
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 opacity-60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $readingTime ?? '5' }} Menit Baca
                                </span>
                            </div>
                        </div>
                    </header>

                    {{-- FEATURED IMAGE --}}
                    @if ($blog->gambar)
                        <div class="rounded-[2.5rem] overflow-hidden mb-12 shadow-2xl shadow-blue-500/10">
                            <img src="{{ asset('storage/uploads/blog/' . $blog->gambar) }}" alt="{{ $blog->judul }}"
                                class="w-full object-cover">
                        </div>
                    @endif

                    <style>
                        /* Tambahkan ini di file CSS kamu */
                        .konten-blog ul {
                            list-style-type: disc;
                            margin-left: 1.5rem;
                            margin-bottom: 1rem;
                        }

                        .konten-blog ol {
                            list-style-type: decimal;
                            margin-left: 1.5rem;
                            margin-bottom: 1rem;
                        }

                        .konten-blog li {
                            margin-bottom: 0.5rem;
                        }
                    </style>

                    @php
                        // 1. Ambil konten blog
                        $htmlContent = $blog->konten;
                        $daftarIsi = [];

                        if (!empty($htmlContent)) {
                            libxml_use_internal_errors(true);

                            $dom = new \DOMDocument();
                            $dom->loadHTML(
                                mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'),
                                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
                            );

                            // KOREKSI: Query diubah hanya mencari '//h2' saja, tag h3 dibuang
                            $xpath = new \DOMXPath($dom);
                            $headingNodes = $xpath->query('//h2');

                            foreach ($headingNodes as $index => $node) {
                                $text = $node->nodeValue;
                                $slug = Str::slug($text) . '-' . $index;

                                $node->setAttribute('id', $slug);

                                $daftarIsi[] = [
                                    'text' => $text,
                                    'slug' => $slug,
                                ];
                            }

                            $htmlContent = $dom->saveHTML();
                            libxml_clear_errors();
                        }
                    @endphp

                    {{-- RENDER DAFTAR ISI (Hanya H2 - Lebih Clean) --}}
                    @if (!empty($daftarIsi))
                        <div class="mb-8 max-w-md">
                            <details
                                class="group bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 [&_summary::-webkit-details-marker]:hidden"
                                open>

                                <summary
                                    class="flex items-center justify-between font-bold text-slate-900 dark:text-white cursor-pointer select-none list-none">
                                    <span class="text-base flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-0.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        Daftar Isi
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor"
                                        class="w-4 h-4 text-slate-500 transition-transform duration-200 group-open:rotate-180">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </summary>

                                <ul class="mt-4 space-y-2 text-sm border-t border-slate-200 dark:border-slate-800 pt-3">
                                    @foreach ($daftarIsi as $item)
                                        {{-- Kelas li disederhanakan karena tipenya seragam (font-medium list-none) --}}
                                        <li class="font-medium list-none">
                                            <a href="#{{ $item['slug'] }}"
                                                class="toc-link text-blue-600 dark:text-blue-400 hover:underline transition-colors duration-150 block py-0.5"
                                                data-target="{{ $item['slug'] }}">
                                                {{ $item['text'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </details>
                        </div>
                    @endif

                    {{-- BODY CONTENT --}}
                    <div
                        class="konten-blog prose prose-lg prose-slate dark:prose-invert max-w-none
    prose-headings:font-black prose-headings:tracking-tight
    prose-a:text-blue-600 prose-img:rounded-[2rem]
    prose-strong:text-slate-900 dark:text-slate-300
    [&_p]:mb-4 [&_ul]:mb-4 [&_ol]:mb-4
    [&_a]:text-blue-500 [&_a]:underline
    [&_ul]:list-disc [&_ol]:list-decimal
    [&_ul]:ml-6 [&_ol]:ml-6
    [&_li]:mb-2
    [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:mt-6 [&_h2]:mb-4
    [&_h3]:text-xl [&_h3]:font-bold [&_h3]:mt-4 [&_h3]:mb-2
    [&_table]:w-full
    [&_table]:border [&_table]:border-slate-300
    [&_th]:border [&_td]:border
    [&_th]:px-4 [&_td]:px-4
    [&_th]:py-2 [&_td]:py-2
    [&_th]:bg-slate-100

    [&_blockquote]:border-l-4 [&_blockquote]:border-blue-500
    [&_blockquote]:bg-blue-50/50 dark:[&_blockquote]:bg-blue-950/20
    [&_blockquote]:px-6 [&_blockquote]:py-4
    [&_blockquote]:rounded-r-xl [&_blockquote]:my-6
    [&_blockquote_p]:italic [&_blockquote_p]:text-slate-700 dark:[&_blockquote_p]:text-slate-300
    [&_blockquote_p]:font-medium [&_blockquote_p]:leading-relaxed
">

                        {{-- Menggunakan {!! !!} karena konten berasal dari CKEditor (HTML) --}}
                        {!! $htmlContent !!}
                    </div>

                    {{-- TAGS (Opsional jika ada kolom tags) --}}
                    <div class="mt-16 pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-wrap gap-3">
                        <span
                            class="px-4 py-2 bg-slate-100 dark:bg-slate-900 rounded-xl text-xs font-bold dark:text-white">#{{ str_replace(' ', '', $blog->kategori) }}</span>
                        <span
                            class="px-4 py-2 bg-slate-100 dark:bg-slate-900 rounded-xl text-xs font-bold dark:text-white">#GaweDokumen</span>
                    </div>
                </article>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4 space-y-10">
                    <div class="sticky top-24 max-h-[calc(100vh-120px)] overflow-y-auto pr-2 custom-scrollbar">

                        {{-- Input Search --}}
                        <form action="{{ route('blog.index') }}" method="GET" class="relative w-full mb-8">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari artikel..."
                                class="w-full px-4 py-2.5 text-sm bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-slate-700 dark:text-slate-200 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all pr-10">

                            @if (request('search'))
                                <a href="{{ route('blog.index') }}"
                                    class="absolute right-10 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            @endif

                            <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        {{-- ARTIKEL TERKAIT --}}
                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 rounded-[2.5rem] p-6 border border-slate-100 dark:border-slate-800 mb-8">
                            <h3 class="text-lg font-black dark:text-white mb-4">Artikel <span
                                    class="text-blue-600">Terkait</span></h3>
                            <div class="space-y-4">
                                @forelse ($relatedBlogs as $related)
                                    <a href="{{ route('blog.show', [$related->slug]) }}" class="flex gap-3 group">
                                        <div
                                            class="w-12 h-12 bg-slate-200 dark:bg-slate-800 rounded-xl flex-shrink-0 overflow-hidden">
                                            <img src="{{ asset('storage/uploads/blog/' . $related->gambar) }}"
                                                alt="{{ $related->judul }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h5
                                                class="text-xs font-bold dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug">
                                                {{ $related->judul }}
                                            </h5>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-xs text-slate-400 italic">Tidak ada artikel terkait.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- CALL TO ACTION --}}
                        <div
                            class="relative overflow-hidden p-6 rounded-[2.5rem] bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-xl shadow-blue-500/20">
                            <div class="relative z-10">
                                <h4 class="text-xl font-black mb-2">Siap Lamar Kerja?</h4>
                                <p class="text-blue-100 text-xs mb-4 leading-relaxed">
                                    Buat surat lamaran kerja profesional Anda dalam 2 menit.
                                </p>
                                <a href="/pekerja/surat-lamaran"
                                    class="block w-full text-center bg-white text-blue-600 py-3 rounded-xl text-xs font-black hover:bg-blue-50 transition-colors">
                                    Mulai Buat Sekarang
                                </a>
                            </div>
                            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        </div>

                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.konten-blog table').forEach(function(table) {
                if (!table.parentElement.classList.contains('table-wrapper')) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('overflow-x-auto', 'table-wrapper');
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
            });

            const kontenBlog = document.querySelector('.konten-blog');

            if (kontenBlog) {
                // Cari semua tag paragraf di dalamnya
                const paragraphs = kontenBlog.querySelectorAll('p');

                paragraphs.forEach(p => {
                    // Hapus paragraf jika:
                    // 1. Benar-benar kosong (p.innerHTML === "")
                    // 2. Hanya berisi spasi HTML (p.innerHTML === "&nbsp;")
                    // 3. Hanya berisi spasi biasa setelah di-trim
                    if (p.innerHTML.trim() === '' || p.innerHTML === '&nbsp;') {
                        p.remove();
                    }
                });
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cari semua link daftar isi yang memiliki class .toc-link
            const tocLinks = document.querySelectorAll('.toc-link');

            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // 1. Matikan fungsi default bawaan HTML agar URL tidak berubah
                    e.preventDefault();

                    // 2. Ambil ID target dari attribute data-target
                    const targetId = this.getAttribute('data-target');
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        // 3. Lakukan scroll halus secara programmatic menuju elemen target
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start' // Posisi elemen berada di bagian atas layar setelah scroll
                        });
                    }
                });
            });
        });
    </script>
@endpush
