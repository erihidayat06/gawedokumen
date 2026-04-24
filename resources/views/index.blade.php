@extends('layouts.app')

@section('content')
    {{-- HERO SECTION --}}
    <section class="relative bg-white dark:bg-slate-950 pt-32 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span
                    class="px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full uppercase tracking-[0.2em] mb-6 inline-block">
                    Solusi Dokumen Digital
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white mb-6 leading-tight">
                    Bikin Dokumen Profesional <span class="text-blue-600">Tanpa Ribet.</span>
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                    Pilih kategori Anda dan buat surat, label, atau dokumen administrasi lainnya secara otomatis dalam
                    hitungan menit.
                </p>
            </div>

            {{-- CATEGORY GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- KATEGORI: PELAJAR --}}
                {{-- <a href="/kategori/pelajar"
                    class="group relative p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-blue-500 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black dark:text-white mb-2">Pelajar</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Label buku, sampul tugas, dan surat izin sekolah
                        otomatis.</p>
                </a> --}}

                {{-- KATEGORI: PEKERJA --}}
                <a href="/kategori/pekerja"
                    class="group relative p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-blue-500 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
                    <div
                        class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black dark:text-white mb-2">Pekerja</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Surat lamaran kerja (CV), surat resign, dan
                        paklaring.</p>
                </a>

                {{-- KATEGORI: MASYARAKAT --}}
                {{-- <a href="/kategori/masyarakat"
                    class="group relative p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-blue-500 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
                    <div
                        class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black dark:text-white mb-2">Masyarakat</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Surat keterangan domisili, surat izin usaha, dan
                        undangan.</p>
                </a> --}}

                {{-- KATEGORI: UMKM --}}
                {{-- <a href="/kategori/umkm"
                    class="group relative p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-blue-500 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
                    <div
                        class="w-16 h-16 bg-orange-100 dark:bg-orange-900/50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black dark:text-white mb-2">UMKM</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Label harga, struk penjualan, dan laporan keuangan
                        simpel.</p>
                </a> --}}

            </div>
        </div>

        {{-- BACKGROUND DECORATION --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-500/5 rounded-full blur-[120px]">
            </div>
        </div>
    </section>

    {{-- LATEST BLOG SECTION --}}

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black dark:text-white mb-2">Panduan Terbaru</h2>
                <p class="text-slate-500 dark:text-slate-400">Tips dan trik mengelola dokumen Anda.</p>
            </div>
            <a href="{{ route('blog.index') }}" class="text-blue-600 font-bold hover:underline">Lihat Semua Artikel
                →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($latestBlogs as $blog)
                {{-- Ubah article jadi <a> agar seluruh kotak bisa diklik --}}
                <a href="{{ route('blog.show', [$blog->slug]) }}"
                    class="group bg-white dark:bg-slate-900 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">

                    <div class="aspect-video overflow-hidden">
                        {{-- Tambah efek zoom saat hover pakai group-hover --}}
                        <img src="{{ asset('storage/uploads/blog/' . $blog->gambar) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <div class="p-6">
                        <span class="text-blue-600 text-[10px] font-bold uppercase tracking-widest">
                            {{ $blog->kategori }}
                        </span>
                        <h4
                            class="text-lg font-bold mt-2 dark:text-white line-clamp-2 group-hover:text-blue-600 transition-colors">
                            {{ $blog->judul }}
                        </h4>

                        <div
                            class="mt-4 flex items-center text-sm font-bold text-slate-900 dark:text-slate-300 group-hover:text-blue-600 transition-colors">
                            Baca Artikel
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 ml-1 transition-transform group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- FAQ SECTION --}}
        <section class="py-24 bg-white dark:bg-slate-950">
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-4">
                        Pertanyaan yang <span class="text-blue-600">Sering Diajukan</span>
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400">Punya pertanyaan seputar GaweDokumen? Temukan
                        jawabannya di sini.</p>
                </div>

                {{-- Accordion Container --}}
                <div class="space-y-4" x-data="{ active: null }">

                    {{-- Item 1 --}}
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-[2rem] overflow-hidden bg-slate-50/50 dark:bg-slate-900/50">
                        <button @click="active !== 1 ? active = 1 : active = null"
                            class="flex items-center justify-between w-full p-6 md:p-8 text-left transition-all"
                            :class="active === 1 ? 'bg-blue-600 text-white' : 'text-slate-900 dark:text-white'">
                            <span class="font-bold md:text-lg text-sm">Apakah layanan GaweDokumen benar-benar
                                gratis?</span>
                            <svg class="w-5 h-5 transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 1" x-collapse
                            class="p-6 md:p-8 text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-100 dark:border-slate-800">
                            Ya! Sebagian besar template dokumen dasar kami bisa digunakan secara gratis. Kami
                            berkomitmen membantu masyarakat, UMKM, dan pelajar untuk mendapatkan dokumen profesional
                            dengan mudah.
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-[2rem] overflow-hidden bg-slate-50/50 dark:bg-slate-900/50">
                        <button @click="active !== 2 ? active = 2 : active = null"
                            class="flex items-center justify-between w-full p-6 md:p-8 text-left transition-all"
                            :class="active === 2 ? 'bg-blue-600 text-white' : 'text-slate-900 dark:text-white'">
                            <span class="font-bold md:text-lg text-sm">Berapa lama waktu yang dibutuhkan untuk membuat
                                dokumen?</span>
                            <svg class="w-5 h-5 transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 2" x-collapse
                            class="p-6 md:p-8 text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-100 dark:border-slate-800">
                            Hanya butuh waktu kurang dari 2 menit. Anda cukup mengisi formulir yang disediakan, dan
                            sistem kami akan otomatis meng-generate dokumen dalam format yang siap cetak.
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-[2rem] overflow-hidden bg-slate-50/50 dark:bg-slate-900/50">
                        <button @click="active !== 3 ? active = 3 : active = null"
                            class="flex items-center justify-between w-full p-6 md:p-8 text-left transition-all"
                            :class="active === 3 ? 'bg-blue-600 text-white' : 'text-slate-900 dark:text-white'">
                            <span class="font-bold md:text-lg text-sm">Apakah data saya aman di GaweDokumen?</span>
                            <svg class="w-5 h-5 transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 3" x-collapse
                            class="p-6 md:p-8 text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-100 dark:border-slate-800">
                            Kami sangat menjaga privasi Anda. Data yang Anda masukkan ke dalam form hanya digunakan
                            untuk membuat dokumen pada sesi tersebut dan tidak akan kami sebarluaskan atau
                            disalahgunakan.
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endsection
