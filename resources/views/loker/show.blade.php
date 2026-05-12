@extends('layouts.app')

@section('title', 'Lowongan Kerja ' . Str::title($loker->posisi) . ' di ' . Str::title($loker->perusahaan) . ' - ' .
    Str::title($loker->kecamatan) . ', ' . Str::title($loker->kota))

@section('meta_description')
    Lowongan kerja {{ $loker->posisi }} di {{ $loker->perusahaan }} ({{ $loker->kecamatan }}, {{ $loker->kota }}).
    Pendidikan min. {{ $loker->minimal_pendidikan }}. Update {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}.
@endsection

@section('content')
    <div class="bg-slate-50 dark:bg-slate-950 min-h-screen pt-24 pb-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex mb-6  font-medium text-slate-500 dark:text-slate-400">
                <a href="{{ route('loker.index') }}" class="hover:text-blue-600 transition-colors">Lowongan Kerja</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-slate-900 dark:text-white line-clamp-1">{{ $loker->posisi }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-8 lg:order-first">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">

                        {{-- Bagian Atas (Header) --}}
                        <div
                            class="p-6 md:p-12 bg-gradient-to-br from-white to-slate-50/50 dark:from-slate-900 dark:to-slate-900/50">
                            <div
                                class="flex flex-col md:flex-row gap-6 md:gap-10 items-start md:items-center mb-8 md:mb-12">
                                {{-- Logo Inisial --}}
                                <div
                                    class="hidden md:flex w-16 h-16 md:w-24 md:h-24 bg-blue-600 rounded-2xl md:rounded-[2rem] items-center justify-center text-white text-xl md:text-4xl font-black uppercase shrink-0 shadow-xl shadow-blue-500/20">
                                    @php
                                        $words = explode(' ', $loker->perusahaan);
                                        $initials = '';
                                        foreach ($words as $w) {
                                            if (in_array(strtoupper(trim($w, '.')), ['PT', 'CV', 'UD', 'FIRMA'])) {
                                                continue;
                                            }
                                            $initials .= substr($w, 0, 1);
                                        }
                                        if (empty($initials)) {
                                            $initials = substr($loker->perusahaan, 0, 2);
                                        }
                                        echo substr(strtoupper($initials), 0, 2);
                                    @endphp
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h1
                                        class="text-xl lg:text-3xl font-black md:text-2xl dark:text-white leading-tight mb-3 break-words">
                                        {{ $loker->posisi }} -
                                        <span class="capitalize">
                                            {{ Str::lower($loker->kecamatan) }}, {{ Str::title($loker->kota) }}
                                        </span>

                                        <span class="text-blue-600 block md:inline-block">
                                            @php
                                                $date = \Carbon\Carbon::parse($loker->deadline)->isFuture()
                                                    ? \Carbon\Carbon::now()
                                                    : \Carbon\Carbon::parse($loker->deadline);
                                            @endphp

                                            {{ $date->locale('id')->translatedFormat('F Y') }}
                                        </span>
                                    </h1>
                                    <p class="text-base md:text-xl font-bold text-blue-600 flex items-center gap-2">
                                        <i class="bi bi-building"></i> {{ $loker->perusahaan }}
                                    </p>
                                </div>
                            </div>

                            {{-- Container Metadata Grid --}}
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 p-5 md:p-8 bg-white dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-sm">

                                {{-- Pendidikan --}}
                                <div class="flex items-center gap-4 p-2">
                                    <div
                                        class="w-10 h-10 md:w-12 md:h-12 shrink-0 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                        <i
                                            class="bi bi-mortarboard-fill text-blue-600 dark:text-blue-400 text-sm md:text-xl"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <span
                                            class="text-[9px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Pendidikan</span>
                                        <p class="text-sm md:text-lg font-black dark:text-white truncate">
                                            {{ $loker->minimal_pendidikan ?? 'Semua Jenjang' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Pengalaman --}}
                                <div class="flex items-center gap-4 p-2">
                                    <div
                                        class="w-10 h-10 md:w-12 md:h-12 shrink-0 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center">
                                        <i
                                            class="bi bi-briefcase-fill text-amber-600 dark:text-amber-400 text-sm md:text-xl"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <span
                                            class="text-[9px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Pengalaman</span>
                                        <p class="text-sm md:text-lg font-black dark:text-white truncate">
                                            {{ $loker->pengalaman ?? 'Fresh Graduate' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-center gap-4 p-2">
                                    <div
                                        class="w-10 h-10 md:w-12 md:h-12 shrink-0 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                                        <i class="bi bi-geo-alt-fill text-red-600 dark:text-red-400 text-sm md:text-xl"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span
                                                class="text-[9px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest">Lokasi</span>
                                            <span
                                                class="text-[8px] md:text-[10px] px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-100 rounded-md font-bold uppercase">
                                                {{ $loker->tipe_pekerjaan }}
                                            </span>
                                        </div>
                                        <p class="text-sm md:text-lg font-black dark:text-white capitalize truncate">
                                            {{ Str::lower($loker->kecamatan) }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Gaji --}}
                                <div class="flex items-center gap-4 p-2">
                                    <div
                                        class="w-10 h-10 md:w-12 md:h-12 shrink-0 bg-green-50 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                        <i class="bi bi-wallet2 text-green-600 dark:text-green-400 text-sm md:text-xl"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <span
                                            class="text-[9px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Estimasi
                                            Gaji</span>
                                        <p
                                            class="text-sm md:text-lg font-black text-green-600 dark:text-green-400 truncate">
                                            {{ $loker->gaji ?? 'Kompetitif' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 md:p-10 space-y-6 border-t border-slate-50 dark:border-slate-800 lg:hidden">

                            {{-- Deadline Horizontal --}}
                            <div
                                class="{{ $loker->deadline ? 'bg-red-50 dark:bg-red-900/10 border-red-100 dark:border-red-900/20' : 'bg-blue-50 dark:bg-blue-900/10 border-blue-100 dark:border-blue-900/20' }} mb-6 p-4 rounded-2xl border flex items-center justify-between">

                                <span
                                    class="{{ $loker->deadline ? 'text-red-400' : 'text-blue-400' }} text-[11px] md:text-xs font-black uppercase tracking-widest ml-1">
                                    Deadline
                                </span>

                                <p
                                    class="{{ $loker->deadline ? 'text-red-600 dark:text-red-500' : 'text-blue-600 dark:text-blue-500' }} text-sm md:text-base font-black mr-1">
                                    @if ($loker->deadline)
                                        {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                    @else
                                        Sampai Kuota Terpenuhi
                                    @endif
                                </p>
                            </div>

                            {{-- Tombol Kontak Sejajar --}}
                            <div class="space-y-3">
                                {{-- Tombol Link Pendaftaran (Utama) --}}
                                @if ($loker->link_pendaftaran)
                                    <a href="{{ $loker->link_pendaftaran }}" target="_blank" rel="nofollow noreferrer"
                                        class="flex items-center justify-center gap-2 w-full py-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-95">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        <span>Daftar Online / Isi Formulir</span>
                                    </a>
                                @endif

                                {{-- Grid Tombol Kontak (WhatsApp & Email) --}}
                                <div class="grid grid-cols-2 gap-3">
                                    @if ($loker->no_wa)
                                        @php
                                            $pesanWA = "Halo HRD {$loker->perusahaan}, saya tertarik melamar posisi {$loker->posisi} via GaweDokumen.";
                                        @endphp
                                        <a href="https://wa.me/{{ $loker->no_wa }}" target="_blank"
                                            class="flex flex-col items-center justify-center gap-1 py-3 bg-green-600 text-white rounded-xl font-bold shadow-lg shadow-green-600/20 hover:bg-green-700 transition-all active:scale-95">
                                            <i class="bi bi-whatsapp text-lg"></i>
                                            <span class="text-[12px]">WhatsApp</span>
                                        </a>
                                    @endif

                                    @if ($loker->email)
                                        <a href="mailto:{{ $loker->email }}"
                                            class="flex flex-col items-center justify-center gap-1 py-3 bg-slate-900 dark:bg-slate-700 text-white rounded-xl font-bold shadow-lg transition-all active:scale-95 text-center">
                                            <i class="bi bi-envelope text-lg"></i>
                                            <span class="text-[12px]">Kirim Email</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Content Detail --}}
                        <div class="p-6 md:p-12 space-y-12 border-t border-slate-50 dark:border-slate-800">

                            {{-- 1. Deskripsi --}}
                            <section>
                                <h3
                                    class="text-lg md:text-2xl font-black dark:text-white mb-5 md:mb-6 flex items-center gap-3">
                                    <span class="w-1.5 h-6 md:h-8 bg-blue-600 rounded-full"></span> Detail Pekerjaan
                                </h3>
                                <div
                                    class="text-sm md:text-lg text-slate-600 dark:text-slate-400 leading-relaxed space-y-4 text-justify md:text-left">
                                    {!! nl2br(e($loker->deskripsi)) !!}
                                </div>
                            </section>

                            {{-- 2. Grid Tugas & Syarat (Tetap Berdampingan) --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16">
                                @if ($loker->tugas && count($loker->tugas) > 0)
                                    <section>
                                        <h3
                                            class="text-lg md:text-2xl font-black dark:text-white mb-5 md:mb-6 flex items-center gap-3">
                                            <span class="w-1.5 h-6 md:h-8 bg-blue-600 rounded-full"></span> Tanggung Jawab
                                        </h3>
                                        <ul class="space-y-4 md:space-y-5">
                                            @foreach ($loker->tugas as $t)
                                                <li
                                                    class="flex items-start gap-3 text-sm md:text-base text-slate-600 dark:text-slate-400 font-medium">
                                                    <i
                                                        class="bi bi-check2-circle text-blue-600 text-lg md:text-xl mt-0.5 shrink-0"></i>
                                                    {{ $t }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                @endif

                                <section>
                                    <h3
                                        class="text-lg md:text-2xl font-black dark:text-white mb-5 md:mb-6 flex items-center gap-3">
                                        <span class="w-1.5 h-6 md:h-8 bg-blue-600 rounded-full"></span> Kualifikasi
                                    </h3>
                                    <ul class="space-y-4 md:space-y-5">
                                        @foreach ($loker->persyaratan as $s)
                                            <li
                                                class="flex items-start gap-3 text-sm md:text-base text-slate-600 dark:text-slate-400 font-medium">
                                                <i class="bi bi-dot text-blue-600 text-2xl md:text-3xl -mt-2 shrink-0"></i>
                                                {{ $s }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </section>
                            </div>

                            {{-- 3. Benefit (Sekarang Full Width / Tidak di-jejerin) --}}
                            @if ($loker->benefit && count($loker->benefit) > 0)
                                <section class="pt-8 border-t border-slate-50 dark:border-slate-800">
                                    <h3
                                        class="text-lg md:text-2xl font-black dark:text-white mb-5 md:mb-6 flex items-center gap-3">
                                        <span class="w-1.5 h-6 md:h-8 bg-blue-600 rounded-full"></span> Benefit & Fasilitas
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach ($loker->benefit as $b)
                                            <div
                                                class="flex items-center gap-3 p-4 rounded-xl dark:border-slate-700 text-sm md:text-base text-slate-600 dark:text-slate-400 font-bold">
                                                <i class="bi bi-gift text-blue-600"></i>
                                                {{ $b }}
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            {{-- 4. Kotak Informasi Kontak (Sekarang Full Width & Bisa Copy) --}}
                            @if ($loker->no_wa || $loker->email || $loker->link_pendaftaran)
                                <section class="pt-8 border-t border-slate-50 dark:border-slate-800">
                                    <h3
                                        class="text-lg md:text-2xl font-black dark:text-white mb-5 md:mb-6 flex items-center gap-3">
                                        <span class="w-1.5 h-6 md:h-8 bg-blue-600 rounded-full"></span> Salin Informasi
                                        Kontak
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                        @if ($loker->no_wa)
                                            <button onclick="copyToClipboard('{{ $loker->no_wa }}', 'Nomor WA')"
                                                class="p-4 bg-green-50 dark:bg-green-900/10 rounded-2xl border border-green-100 dark:border-green-900/20 flex flex-col gap-1 text-left hover:scale-[1.02] transition-transform">
                                                <div class="flex items-center justify-between">
                                                    <span
                                                        class="text-[10px] font-black text-green-700/60 uppercase tracking-widest">WhatsApp
                                                        (Klik Copy)</span>
                                                    <i class="bi bi-whatsapp text-green-600"></i>
                                                </div>
                                                <span
                                                    class="text-sm font-black text-green-700 dark:text-green-400">{{ $loker->no_wa }}</span>
                                            </button>
                                        @endif

                                        @if ($loker->email)
                                            <button onclick="copyToClipboard('{{ $loker->email }}', 'Email')"
                                                class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700 flex flex-col gap-1 text-left hover:scale-[1.02] transition-transform">
                                                <div class="flex items-center justify-between">
                                                    <span
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email
                                                        HRD (Klik Copy)</span>
                                                    <i class="bi bi-envelope-fill text-slate-400"></i>
                                                </div>
                                                <span
                                                    class="text-sm font-black text-slate-700 dark:text-slate-200 truncate">{{ $loker->email }}</span>
                                            </button>
                                        @endif

                                        @if ($loker->link_pendaftaran)
                                            <button
                                                onclick="copyToClipboard('{{ $loker->link_pendaftaran }}', 'Link Pendaftaran')"
                                                class="p-4 bg-blue-50 dark:bg-blue-900/10 rounded-2xl border border-blue-100 dark:border-blue-900/20 flex flex-col gap-1 text-left hover:scale-[1.02] transition-transform">
                                                <div class="flex items-center justify-between">
                                                    <span
                                                        class="text-[10px] font-black text-blue-700/60 uppercase tracking-widest">Link
                                                        (Klik Copy)</span>
                                                    <i class="bi bi-link-45deg text-blue-600"></i>
                                                </div>
                                                <span
                                                    class="text-sm font-black text-blue-700 dark:text-blue-400 truncate">{{ $loker->link_pendaftaran }}</span>
                                            </button>
                                        @endif
                                    </div>
                                </section>
                            @endif
                            {{-- Alamat & Map --}}
                            <section class="pt-8 border-t border-slate-50 dark:border-slate-800">
                                <h3 class="text-lg md:text-2xl font-black dark:text-white mb-4">Lokasi & Alamat</h3>
                                <p class="text-sm md:text-lg text-slate-500 mb-6 flex items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-blue-600"></i> {{ $loker->alamat }},
                                    {{ $loker->kecamatan }}
                                </p>
                                <div
                                    class="w-full h-64 md:h-[400px] bg-slate-100 rounded-[2rem] overflow-hidden border border-slate-100 shadow-inner">
                                    <iframe width="100%" height="100%" frameborder="0" style="border:0"
                                        src="https://maps.google.com/maps?q={{ urlencode($loker->alamat . ' ' . $loker->kecamatan . ' ' . $loker->kota) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 order-1 lg:order-last space-y-6">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-[2rem] p-6 md:p-8 border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none sticky top-24">

                        {{-- Deadline Horizontal - Teks diperbesar di Desktop --}}
                        <div
                            class="{{ $loker->deadline ? 'bg-red-50 dark:bg-red-900/10 border-red-100 dark:border-red-900/20' : 'bg-blue-50 dark:bg-blue-900/10 border-blue-100 dark:border-blue-900/20' }} mb-6 p-3 rounded-2xl border flex items-center justify-between">

                            <span
                                class="{{ $loker->deadline ? 'text-red-400' : 'text-blue-400' }} text-[10px] font-black uppercase tracking-widest ml-1">
                                Deadline
                            </span>

                            <p
                                class="{{ $loker->deadline ? 'text-red-600 dark:text-red-500' : 'text-blue-600 dark:text-blue-500' }} text-[12px] font-black mr-1">
                                @if ($loker->deadline)
                                    {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                @else
                                    Sampai Kuota Terpenuhi
                                @endif
                            </p>
                        </div>

                        <div class="space-y-5">
                            {{-- Tombol Kontak - Teks diperbesar di Desktop --}}
                            <div class="flex flex-col gap-3">
                                {{-- Tombol Link Pendaftaran (Utama - Lebar Penuh) --}}
                                @if ($loker->link_pendaftaran)
                                    <a href="{{ $loker->link_pendaftaran }}" target="_blank" rel="nofollow noreferrer"
                                        class="flex items-center justify-center gap-3 py-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-95 group">
                                        <i
                                            class="bi bi-box-arrow-up-right text-xl group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                        <span class="text-sm md:text-base">Daftar Online / Isi Formulir</span>
                                    </a>
                                @endif

                                {{-- Grid Tombol Kontak (WhatsApp & Email) --}}
                                <div class="grid grid-cols-2 gap-3">
                                    @if ($loker->no_wa)
                                        @php
                                            $pesanWA =
                                                'Halo HRD ' .
                                                $loker->perusahaan .
                                                ', saya tertarik melamar posisi ' .
                                                $loker->posisi .
                                                ' via GaweDokumen.';
                                        @endphp
                                        <a href="https://wa.me/{{ $loker->no_wa }}" target="_blank"
                                            class="flex flex-col items-center justify-center gap-2 py-4 bg-green-600 text-white rounded-xl font-bold shadow-lg shadow-green-600/20 hover:bg-green-700 transition-all active:scale-95">
                                            <i class="bi bi-whatsapp text-xl md:text-2xl"></i>
                                            <span class="text-[11px] md:text-sm">WhatsApp</span>
                                        </a>
                                    @endif

                                    @if ($loker->email)
                                        <a href="mailto:{{ $loker->email }}"
                                            class="flex flex-col items-center justify-center gap-2 py-4 bg-slate-900 dark:bg-slate-700 text-white rounded-xl font-bold shadow-lg transition-all active:scale-95 text-center">
                                            <i class="bi bi-envelope text-xl md:text-2xl"></i>
                                            <span class="text-[11px] md:text-sm">Kirim Email</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            {{-- Pembatas dengan Teks --}}
                            <div class="relative my-8">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-slate-200 dark:border-slate-800"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span
                                        class="bg-white dark:bg-slate-900 px-3 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                        Bantuan Tools
                                    </span>
                                </div>
                            </div>
                            {{-- Banner Tools - Padding & Teks lebih besar --}}
                            <div class="p-5 bg-blue-600 rounded-2xl text-white relative overflow-hidden group">
                                <p class="text-[11px] md:text-xs font-bold text-blue-100 mb-3 relative z-10 text-center">
                                    Butuh berkas lamaran profesional?</p>
                                <a href="/tools/lamaran?posisi={{ urlencode($loker->posisi) }}&perusahaan={{ urlencode($loker->perusahaan) }}"
                                    class="block w-full py-3 bg-white text-blue-600 text-center rounded-lg text-[11px] md:text-xs font-black uppercase tracking-wider hover:bg-blue-50 transition-all relative z-10">
                                    Bikin Lamaran Otomatis
                                </a>
                            </div>
                        </div>

                        {{-- Tips Terkait - Teks list lebih besar --}}
                        @if ($loker->blogs->count() > 0)
                            <div class="mt-8 pt-6 border-t border-slate-50 dark:border-slate-800">
                                <h4
                                    class="text-[11px] md:text-xs font-black dark:text-white mb-4 uppercase tracking-tighter text-slate-400">
                                    Tips Karir Terkait
                                </h4>
                                <div class="space-y-3">
                                    @foreach ($loker->blogs as $blog)
                                        <a href="{{ url('blog/' . $blog->slug) }}"
                                            class="flex items-center gap-4 p-3 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl transition-colors group">
                                            <div
                                                class="w-10 h-10 md:w-11 md:h-11 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center shrink-0 border border-amber-100">
                                                <i class="bi bi-lightbulb-fill md:text-lg"></i>
                                            </div>
                                            <span
                                                class="text-xs md:text-sm font-bold text-slate-600 dark:text-slate-400 group-hover:text-blue-600 line-clamp-2 leading-snug">
                                                {{ $blog->judul }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>



            {{-- REKOMENDASI --}}
            <div class="mt-16">
                <h3 class="text-xl font-black dark:text-white mb-6 border-l-4 border-blue-600 pl-4">Lowongan Lainnya
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($rekomendasi as $rek)
                        <a href="{{ route('loker.show', $rek->slug) }}"
                            class="group bg-white dark:bg-slate-900 p-5 rounded-[2rem] border border-slate-100 dark:border-slate-800 hover:border-blue-500 transition-all shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center font-black text-blue-600 uppercase ">
                                    {{ substr($rek->perusahaan, 0, 2) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold  dark:text-white group-hover:text-blue-600 truncate">
                                        {{ $rek->posisi }}</h4>
                                    <p class="text-[12px] text-slate-400 font-bold uppercase truncate">
                                        {{ $rek->perusahaan }}</p>
                                </div>
                            </div>
                            <div
                                class="flex justify-between items-center mt-4 pt-4 border-t border-slate-50 dark:border-slate-800">
                                <span class="text-[12px] font-bold text-slate-500">📍 {{ $rek->kecamatan }}</span>
                                <span class="text-blue-600 text-[10px] font-black">Detail →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- SCRIPT COPY TO CLIPBOARD --}}
    <script>
        function copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(() => {
                alert(label + ' berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin: ', err);
            });
        }
    </script>
@endpush
