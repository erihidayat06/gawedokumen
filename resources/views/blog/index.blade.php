@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER / FEATURED BLOG --}}
            @if ($featuredBlog)
                <div
                    class="relative mb-16 rounded-[2.5rem] overflow-hidden bg-slate-900 h-[250px] md:h-[500px] group shadow-2xl">
                    <div class="absolute inset-0">
                        <img src="{{ asset('storage/uploads/blog/' . $featuredBlog->gambar) }}"
                            class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700"
                            alt="{{ $featuredBlog->judul }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                    </div>

                    <div class="absolute bottom-0 left-0 p-8 md:p-16 max-w-3xl">
                        <span
                            class="px-3 py-1 bg-blue-600 text-white text-xs font-bold rounded-full uppercase tracking-widest mb-4 inline-block">
                            {{ $featuredBlog->kategori }}
                        </span>
                        <h2 class="text-xl md:text-5xl font-black text-white mb-4 leading-tight">
                            {{ $featuredBlog->judul }}
                        </h2>
                        <div class="text-slate-300 text-sm md:text-lg mb-6 line-clamp-2">
                            {!! Str::limit(strip_tags($featuredBlog->konten), 160) !!}
                        </div>
                        {{-- LINK DENGAN 2 PARAMETER: KATEGORI & SLUG --}}
                        <a href="{{ route('blog.show', [$featuredBlog->slug]) }}"
                            class="inline-flex items-center gap-2 text-white font-bold hover:gap-4 transition-all">
                            Baca Selengkapnya <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- MAIN CONTENT --}}
                <div class="lg:col-span-8 space-y-12">

                    {{-- FORM PENCARIAN & JUDUL --}}
                    <div
                        class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-l-4 border-blue-600 pl-4">
                        <div>
                            <h3 class="text-2xl font-black dark:text-white">
                                {{ request('search') ? 'Hasil Pencarian' : 'Artikel Terbaru' }}
                            </h3>
                            @if (request('search'))
                                <p class="text-xs text-slate-400 mt-1">
                                    Menampilkan hasil untuk: <span
                                        class="text-blue-600 font-bold">"{{ request('search') }}"</span>
                                </p>
                            @endif
                        </div>

                        {{-- Input Search --}}
                        <form action="{{ route('blog.index') }}" method="GET" class="relative w-full md:w-72">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari artikel..."
                                class="w-full px-4 py-2.5 text-sm bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-slate-700 dark:text-slate-200 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all pr-10">

                            @if (request('search'))
                                {{-- Tombol X untuk reset pencarian --}}
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
                    </div>

                    {{-- LIST ARTIKEL --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @forelse ($blogs as $blog)
                            <article class="group">
                                <a href="{{ route('blog.show', [$blog->slug]) }}">
                                    <div
                                        class="aspect-[16/10] bg-slate-100 dark:bg-slate-900 rounded-[2rem] overflow-hidden mb-5 border border-slate-100 dark:border-slate-800">
                                        @if ($blog->gambar)
                                            <img src="{{ asset('storage/uploads/blog/' . $blog->gambar) }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                alt="{{ $blog->judul }}">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-slate-400 italic">
                                                Thumbnail Post</div>
                                        @endif
                                    </div>
                                </a>
                                <span
                                    class="text-blue-600 text-xs font-bold uppercase tracking-widest">{{ $blog->kategori }}</span>
                                <a href="{{ route('blog.show', [$blog->slug]) }}">
                                    <h4
                                        class="text-xl font-bold mt-2 dark:text-white group-hover:text-blue-600 transition-colors">
                                        {{ $blog->judul }}
                                    </h4>
                                </a>
                                <p class="text-slate-500 dark:text-slate-400 text-sm mt-3 line-clamp-2">
                                    {{ Str::limit(strip_tags($blog->konten), 100) }}
                                </p>
                            </article>
                        @empty
                            <div class="col-span-1 md:col-span-2 py-20 text-center">
                                <svg class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-700 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <p class="text-slate-400 italic">Artikel yang Anda cari tidak ditemukan.</p>
                                @if (request('search'))
                                    <a href="{{ route('blog.index') }}"
                                        class="mt-4 inline-block text-sm font-bold text-blue-600 hover:underline">Lihat
                                        Semua Artikel</a>
                                @endif
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINATION --}}
                    @if ($blogs->hasPages())
                        <div class="mt-20 flex flex-col items-center gap-8">
                            <div>
                                {{ $blogs->links() }}
                            </div>
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-[0.2em]">
                                Menampilkan <span class="text-slate-900 dark:text-white">{{ $blogs->firstItem() }} -
                                    {{ $blogs->lastItem() }}</span>
                                dari <span class="text-slate-900 dark:text-white">{{ $blogs->total() }}</span> Panduan
                            </p>
                        </div>
                    @endif
                </div>
                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4 space-y-10">
                    <div
                        class="bg-slate-50 dark:bg-slate-900/50 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 sticky top-24">
                        <h3 class="text-xl font-black dark:text-white mb-6">Rekomendasi <span
                                class="text-blue-600">Untukmu</span></h3>

                        <div class="space-y-6">
                            @foreach ($recommendations as $rec)
                                <a href="{{ route('blog.show', [$rec->slug]) }}" class="flex gap-4 group">
                                    <div
                                        class="w-20 h-20 bg-slate-200 dark:bg-slate-800 rounded-2xl flex-shrink-0 overflow-hidden">
                                        <img src="{{ asset('storage/uploads/blog/' . $rec->gambar) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h5
                                            class="text-sm font-bold dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug">
                                            {{ $rec->judul }}
                                        </h5>
                                        <span class="text-[10px] text-slate-400 mt-1 uppercase font-semibold">
                                            {{ $rec->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-10 p-6 bg-blue-600 rounded-3xl text-white shadow-xl shadow-blue-500/20">
                            <h4 class="font-bold mb-2 text-lg text-white">Butuh Dokumen Cepat?</h4>
                            <p class="text-blue-100 text-xs mb-4">Coba generator surat lamaran kerja otomatis kami.</p>
                            <a href="/kategori/pekerja"
                                class="block text-center bg-white text-blue-600 py-2 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-50 transition-colors">Coba
                                Gratis</a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
@endsection
