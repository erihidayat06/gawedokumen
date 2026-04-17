@extends('layouts.app')

@section('content')
    {{-- Bar Penanda Preview --}}
    <div
        class="fixed top-0 left-0 right-0 z-[100] bg-amber-500 text-white py-2 px-6 shadow-lg flex justify-between items-center">
        <div class="flex items-center gap-2 text-sm font-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            MODE PREVIEW: Tampilan ini adalah draf artikel Anda.
        </div>
        <div class="flex gap-3">
            <a href="{{ url()->previous() }}"
                class="bg-white/20 hover:bg-white/30 px-4 py-1 rounded-lg text-xs font-black transition-colors backdrop-blur-md border border-white/20">
                KEMBALI KE EDITOR
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 min-h-screen pt-32 pb-20"> {{-- pt ditambah agar tidak tertutup bar --}}
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                {{-- Breadcrumb Dinamis --}}
                <nav class="flex text-sm font-medium text-slate-500 dark:text-slate-400">
                    <a href="#" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <a href="#" class="hover:text-blue-600">Panduan</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-900 dark:text-white truncate">{{ $blog->judul }}</span>
                </nav>

                {{-- Tombol Kembali Tambahan --}}
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Bagian Article Tetap Sama --}}
                <article class="lg:col-span-8">
                    <header class="mb-10">
                        <span
                            class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full uppercase tracking-widest">
                            {{ $blog->kategori }}
                        </span>
                        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white mt-6 mb-6 leading-tight">
                            {{ $blog->judul }}
                        </h1>
                        {{-- Meta info (Eri Hidayat, dsb) --}}
                        <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400 text-sm">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-[10px] font-bold text-white shadow-lg shadow-blue-500/30">
                                    GD
                                </div>
                                <span>Tim GaweDokumen</span>
                            </div>
                            <span>•</span>
                            <span>{{ $blog->created_at ? $blog->created_at->translatedFormat('d F Y') : date('d F Y') }}</span>
                            <span>•</span>
                            <span>{{ ceil(str_word_count(strip_tags($blog->konten)) / 200) }} Menit Baca</span>
                        </div>
                    </header>

                    {{-- Image Banner --}}
                    <div
                        class="rounded-[2.5rem] overflow-hidden mb-12 shadow-2xl shadow-blue-500/10 border border-slate-100 dark:border-slate-800 relative">
                        <div
                            class="absolute top-4 right-4 bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full text-xs font-bold z-10">
                            Preview Image
                        </div>
                        @if ($blog->gambar)
                            <img src="{{ asset('uploads/blog/' . $blog->gambar) }}" alt="{{ $blog->judul }}"
                                class="w-full object-cover aspect-video">
                        @else
                            <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?q=80&w=2070"
                                alt="Default Header" class="w-full object-cover aspect-video">
                        @endif
                    </div>

                    {{-- Konten Utama --}}
                    <div
                        class="prose prose-lg prose-slate dark:prose-invert max-w-none
                        prose-headings:font-black prose-headings:tracking-tight
                        prose-a:text-blue-600 prose-img:rounded-[2rem] prose-strong:text-slate-900 dark:text-white">
                        {!! $blog->konten !!}
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-10">
                    <div class="sticky top-24 space-y-10">
                        {{-- Search --}}
                        <form action="#" method="GET" class="relative group">
                            <input type="text" name="search" placeholder="Cari panduan..."
                                class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-600 transition-all dark:text-white">
                            <button type="submit"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        {{-- Artikel Terkait --}}
                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800">
                            <h3 class="text-xl font-black dark:text-white mb-6">Artikel <span
                                    class="text-blue-600">Lainnya</span></h3>
                            <div class="space-y-6">
                                @foreach ($related as $item)
                                    <a href="#" class="flex gap-4 group">
                                        <div
                                            class="w-16 h-16 bg-slate-200 dark:bg-slate-800 rounded-2xl flex-shrink-0 overflow-hidden">
                                            <img src="{{ asset('uploads/blog/' . $item->gambar) }}"
                                                class="w-full h-full object-cover" alt="thumb">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h5
                                                class="text-sm font-bold dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2">
                                                {{ $item->judul }}
                                            </h5>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div
                            class="relative overflow-hidden p-8 rounded-[2.5rem] bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-xl shadow-blue-500/20">
                            <div class="relative z-10">
                                <h4 class="text-2xl font-black mb-4">Siap Lamar Kerja?</h4>
                                <p class="text-blue-100 text-sm mb-6 leading-relaxed">
                                    Buat surat lamaran kerja profesional Anda dalam 2 menit. Gratis & Aman.
                                </p>
                                <a href="/pekerja/surat-lamaran"
                                    class="block w-full text-center bg-white text-blue-600 py-4 rounded-2xl font-black hover:bg-blue-50 transition-colors">
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
