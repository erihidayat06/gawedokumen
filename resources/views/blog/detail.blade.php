@extends('layouts.app')

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
                    <header class="mb-10">
                        <span
                            class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full uppercase tracking-widest">
                            {{ $blog->kategori }}
                        </span>
                        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white mt-6 mb-6 leading-tight">
                            {{ $blog->judul }}
                        </h1>

                        <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400 text-sm">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold">
                                    {{ substr($blog->author ?? 'EH', 0, 2) }}
                                </div>
                                <span>{{ $blog->author ?? 'Admin GaweDokumen' }}</span>
                            </div>
                            <span>•</span>
                            <span>{{ $blog->created_at->translatedFormat('d F Y') }}</span>
                            <span>•</span>
                            <span>{{ $blog->reading_time ?? '5' }} Menit Baca</span>
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

                    {{-- BODY CONTENT --}}
                    <div
                        class="konten-blog prose prose-lg prose-slate dark:prose-invert max-w-none
                        prose-headings:font-black prose-headings:tracking-tight
                        prose-a:text-blue-600 prose-img:rounded-[2rem]
                        prose-strong:text-slate-900 dark:text-slate-300 [&_p]:mb-4
                        [&_ul]:mb-4 [&_ol]:mb-4 [&_a]:text-blue-500 [&_a]:underline
                        [&_ul]:list-disc [&_ol]:list-decimal
                        [&_ul]:ml-6 [&_ol]:ml-6
                        [&_li]:mb-2
                        [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:mt-6 [&_h2]:mb-4
                        [&_h3]:text-xl [&_h3]:font-bold [&_h3]:mt-4 [&_h3]:mb-2">

                        {{-- Menggunakan {!! !!} karena konten berasal dari CKEditor (HTML) --}}
                        {!! $blog->konten !!}
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
                    <div class="sticky top-24 space-y-10">

                        {{-- SEARCH --}}
                        <form action="{{ route('blog.index') }}" method="GET" class="relative group">
                            <input type="text" name="search" placeholder="Cari panduan..."
                                class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-600 transition-all dark:text-white text-sm">
                            <button type="submit"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        {{-- ARTIKEL TERKAIT --}}
                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800">
                            <h3 class="text-xl font-black dark:text-white mb-6">Artikel <span
                                    class="text-blue-600">Terkait</span></h3>
                            <div class="space-y-6">
                                @forelse ($relatedBlogs as $related)
                                    <a href="{{ route('blog.show', [$related->kategori, $related->id, $related->slug]) }}"
                                        class="flex gap-4 group">
                                        <div
                                            class="w-16 h-16 bg-slate-200 dark:bg-slate-800 rounded-2xl flex-shrink-0 overflow-hidden">
                                            <img src="{{ asset('storage/uploads/blog/' . $related->gambar) }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h5
                                                class="text-sm font-bold dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">
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
