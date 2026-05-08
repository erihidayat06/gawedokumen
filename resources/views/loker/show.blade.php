@extends('layouts.app')

@section('content')
    <div class="bg-slate-50 dark:bg-slate-950 min-h-screen pt-24 pb-20">
        <div class="max-w-5xl mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex mb-8 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a href="/loker" class="hover:text-blue-600">Lowongan Kerja</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900 dark:text-white line-clamp-1">{{ $loker->posisi }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- KONTEN UTAMA (KIRI) --}}
                <div class="lg:col-span-8 space-y-6">
                    {{-- CARD HEADER --}}
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                            <div class="flex gap-6">
                                <div
                                    class="w-20 h-20 bg-blue-600 rounded-[1.5rem] flex items-center justify-center text-white text-2xl font-black uppercase">
                                    {{ substr($loker->perusahaan, 0, 2) }}
                                </div>
                                <div>
                                    <h1 class="text-2xl md:text-3xl font-black dark:text-white leading-tight mb-2">
                                        {{ $loker->posisi }}
                                    </h1>
                                    <p class="text-lg font-bold text-blue-600 mb-4">{{ $loker->perusahaan }}</p>
                                    <div class="flex flex-wrap gap-3">
                                        <span
                                            class="flex items-center gap-1.5 text-xs font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-xl">
                                            📍 {{ $loker->kecamatan }}, {{ $loker->kota }}
                                        </span>
                                        <span
                                            class="flex items-center gap-1.5 text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-3 py-1.5 rounded-xl">
                                            💰 {{ $loker->gaji }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI & SYARAT --}}
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h3 class="text-xl font-black dark:text-white mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Deskripsi Pekerjaan
                        </h3>
                        <div
                            class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-400 leading-relaxed text-justify">
                            {!! $loker->deskripsi !!}
                        </div>

                        <h3 class="text-xl font-black dark:text-white mt-10 mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Persyaratan
                        </h3>
                        <ul class="space-y-4">
                            @foreach (json_decode($loker->syarat) as $s)
                                <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="mt-1.5 w-2 h-2 bg-blue-600 rounded-full shrink-0"></span>
                                    {{ $s }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- LOKASI DETAIL (KELEBIHAN ANDA) --}}
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h3 class="text-xl font-black dark:text-white mb-4">Lokasi Penempatan</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">
                            {{ $loker->alamat_lengkap }}
                        </p>
                        {{-- Iframe Google Maps --}}
                        <div
                            class="w-full h-64 bg-slate-100 dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700">
                            <iframe width="100%" height="100%" frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={{ urlencode($loker->alamat_lengkap) }}"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR ACTION (KANAN) --}}
                <div class="lg:col-span-4 space-y-6">
                    {{-- BOX LAMAR --}}
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 shadow-sm sticky top-24">
                        <div class="mb-6">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Batas
                                Pendaftaran</span>
                            <p class="text-xl font-black text-red-500 mt-1">
                                {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <div class="space-y-4">
                            <a href="{{ $loker->link_lamar }}" target="_blank"
                                class="block w-full py-4 bg-blue-600 text-white text-center rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all active:scale-95">
                                Lamar Sekarang
                            </a>

                            <div class="relative py-4 flex items-center">
                                <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
                                <span class="flex-shrink mx-4 text-slate-400 text-xs font-bold uppercase">Atau</span>
                                <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
                            </div>

                            {{-- FITUR UNGGULAN --}}
                            <div
                                class="p-5 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100 dark:border-blue-800/50">
                                <p class="text-xs font-bold text-blue-700 dark:text-blue-400 mb-3 text-center">Belum punya
                                    berkas lamaran?</p>
                                <a href="/tools/lamaran?posisi={{ urlencode($loker->posisi) }}&perusahaan={{ urlencode($loker->perusahaan) }}"
                                    class="block w-full py-3 bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 text-center rounded-xl text-sm font-bold border border-blue-200 dark:border-blue-800 hover:bg-blue-50 transition-all">
                                    Buat Surat Lamaran Otomatis
                                </a>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800">
                            <p class="text-[10px] text-slate-400 leading-relaxed text-center">
                                Hati-hati terhadap penipuan! Proses rekrutmen ini tidak dipungut biaya apapun. Jangan pernah
                                memberikan uang kepada siapapun.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
