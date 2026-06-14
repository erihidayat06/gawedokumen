@extends('layouts.app')

@section('title', 'Lowongan Kerja ' . Str::title($loker->posisi) . ' di ' . Str::title($loker->perusahaan) . ' - ' .
    Str::title($loker->kecamatan) . ', ' . Str::title($loker->kota))

@section('meta_description')
    Lowongan kerja {{ $loker->posisi }} di {{ $loker->perusahaan }} ({{ $loker->kecamatan }}, {{ $loker->kota }}).
    Pendidikan min. {{ $loker->minimal_pendidikan }}. Update {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}.
@endsection

@section('content')
    <div class=" min-h-screen pt-24 pb-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex text-xs md:text-xl mb-6  font-medium text-slate-500 dark:text-slate-400">
                <a href="{{ route('loker.index') }}" class="hover:text-blue-600 transition-colors">Lowongan Kerja</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-slate-900 dark:text-white line-clamp-1">{{ Str::title($loker->posisi) }}</span>
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
                                        // Filter kata yang tidak diinginkan
                                        $exclude = ['PT', 'CV', 'UD', 'FIRMA'];
                                        $words = explode(' ', $loker->perusahaan);

                                        // Ambil huruf pertama dari setiap kata yang bukan kata exclude
                                        $initials = collect($words)
                                            ->map(fn($w) => strtoupper(trim($w, '., ')))
                                            ->filter(fn($w) => !in_array($w, $exclude))
                                            ->map(fn($w) => substr($w, 0, 1))
                                            ->join('');

                                        // Fallback jika kosong
                                        if (empty($initials)) {
                                            $initials = substr(strtoupper($loker->perusahaan), 0, 2);
                                        }

                                        echo substr($initials, 0, 2);
                                    @endphp
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h1
                                        class="text-2xl lg:text-4xl font-black text-slate-800 dark:text-white leading-tight mb-2 break-words">
                                        {{ Str::title($loker->posisi) }}
                                    </h1>

                                    <p
                                        class=" text-xs md:text-xl font-semibold text-slate-600 dark:text-slate-300 flex items-center gap-2 mb-2">
                                        <i class="bi bi-building text-blue-600"></i> {{ Str::title($loker->perusahaan) }}
                                    </p>

                                    <div
                                        class="flex flex-wrap items-center gap-x-3 gap-y-1 text-sm md:text-base text-slate-500 dark:text-slate-400 font-medium">
                                        <p class="flex items-center gap-1 text-xs md:text-lg">
                                            <i class="bi bi-geo-alt"></i>
                                            <span class="capitalize">
                                                {{ Str::lower($loker->kecamatan) }}, {{ Str::title($loker->kota) }}
                                            </span>
                                        </p>

                                        <span class="hidden md:block text-slate-300">•</span>

                                        <p class="flex items-center gap-1 text-blue-600 font-bold text-xs md:text-lg">
                                            <i class="bi bi-calendar3"></i>
                                            @php
                                                // 1. Tentukan tanggal dasar
                                                $lastUpdate = \Carbon\Carbon::parse(
                                                    $loker->updated_at ?? $loker->created_at,
                                                );
                                                $expiredDate = $lastUpdate->copy()->addMonth();

                                                if ($loker->deadline) {
                                                    // Jika ada deadline, pakai deadline
                                                    $displayDate = \Carbon\Carbon::parse($loker->deadline);
                                                } else {
                                                    // Jika tidak ada deadline:
                                                    // Jika masa aktif (1 bulan setelah update) belum tercapai (masih di masa depan),
                                                    // maka tampilkan bulan sekarang.
                                                    // Jika sudah tercapai/lewat, tampilkan tanggal kedaluwarsanya.
                                                    $displayDate = $expiredDate->isFuture()
                                                        ? \Carbon\Carbon::now()
                                                        : $expiredDate;
                                                }
                                            @endphp

                                            {{ $displayDate->locale('id')->translatedFormat('F Y') }}


                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <button id="save-btn" data-id="{{ $loker->id }}"
                                            data-saved="{{ auth()->check() && auth()->user()->savedLokers->contains($loker->id) ? 'true' : 'false' }}"
                                            {{-- Hapus hover:bg-slate-100 dan dark:hover:bg-slate-800 --}}
                                            class="group flex  items-center gap-2 px-0 py-0 transition-all duration-300 hover:opacity-70 active:scale-95 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">

                                            <i id="save-icon"
                                                class="bi {{ auth()->check() && auth()->user()->savedLokers->contains($loker->id) ? 'bi-bookmark-fill text-blue-600' : 'bi-bookmark' }} text-sm md:text-xl transition-all duration-300"></i>

                                            <span id="save-text" class="font-semibold text-xs md:text-sm">
                                                {{ auth()->check() && auth()->user()->savedLokers->contains($loker->id) ? 'Tersimpan' : 'Simpan Loker' }}
                                            </span>
                                        </button>
                                    </div>
                                    <div id="auth-modal"
                                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/50 backdrop-blur-sm px-4">
                                        <div
                                            class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-md w-full shadow-2xl relative">
                                            <button onclick="closeModal()"
                                                class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">✕</button>

                                            <div class="flex gap-4 mb-6 border-b border-slate-100 dark:border-slate-700">
                                                <button onclick="showTab('login')" id="tab-login-btn"
                                                    class="pb-2 font-black border-b-2 border-blue-600 text-blue-600">Masuk</button>
                                                <button onclick="showTab('register')" id="tab-reg-btn"
                                                    class="pb-2 font-black border-b-2 border-transparent text-slate-400">Daftar</button>
                                            </div>

                                            <div id="form-login">
                                                @include('auth.login-form-minimal')
                                            </div>

                                            <div id="form-register" class="hidden">
                                                @include('auth.register-form-minimal')
                                            </div>
                                        </div>
                                    </div>
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

                        <div
                            class="p-6 space-y-5 border-t border-slate-100 dark:border-slate-800 lg:hidden bg-slate-50/50 dark:bg-slate-900/20">

                            @php
                                $isExpired = false;

                                if ($loker->deadline) {
                                    $isExpired = \Carbon\Carbon::now()->greaterThan(
                                        \Carbon\Carbon::parse($loker->deadline)->addDay()->startOfDay(),
                                    );
                                } else {
                                    $isExpired = \Carbon\Carbon::parse($loker->updated_at)->addMonth()->isPast();
                                }
                            @endphp

                            {{-- 1. Status Deadline: Dibuat lebih ringkas --}}
                            <div
                                class="{{ $isExpired ? 'bg-red-50/70 dark:bg-red-950/20 border-red-100 dark:border-red-900/30' : 'bg-blue-50/70 dark:bg-blue-950/20 border-blue-100 dark:border-blue-900/30' }} p-3 rounded-xl border flex items-center justify-between text-xs">
                                <span
                                    class="{{ $isExpired ? 'text-red-500' : 'text-blue-500' }} font-bold uppercase tracking-wider">
                                    {{ $isExpired ? 'Lowongan Tutup' : 'Deadline' }}
                                </span>
                                <p
                                    class="{{ $isExpired ? 'text-red-700 dark:text-red-400' : 'text-blue-700 dark:text-blue-400' }} font-bold">
                                    @if ($loker->deadline)
                                        {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                    @else
                                        {{ $isExpired ? 'Selesai (> 1 Bulan)' : 'Sampai Kuota Penuh' }}
                                    @endif
                                </p>
                            </div>

                            {{-- Kumpulan Aksi / Tombol --}}
                            <div class="space-y-3">
                                {{-- 2. Tombol Utama: Daftar Online (Jika Lowongan Masih Buka) --}}
                                @if ($loker->link_pendaftaran && !$isExpired)
                                    <a href="{{ $loker->link_pendaftaran }}" target="_blank" rel="nofollow noreferrer"
                                        class="flex items-center justify-center gap-2 w-full py-3 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-md shadow-blue-600/10 hover:bg-blue-700 transition-all active:scale-98">
                                        <i class="bi bi-box-arrow-up-right text-xs"></i>
                                        <span>Daftar Online / Formulir</span>
                                    </a>
                                @endif

                                {{-- 3. Grid Kontak: Dibuat semi-flat agar tidak balapan mencolok dengan tombol utama --}}
                                <div class="grid grid-cols-2 gap-2.5">
                                    @if ($loker->no_wa)
                                        @php
                                            $pesanWA = "Halo HRD {$loker->perusahaan}, saya tertarik melamar posisi {$loker->posisi} via GaweDokumen.";
                                        @endphp
                                        <a href="https://wa.me/{{ $loker->no_wa }}?text={{ urlencode($pesanWA) }}"
                                            target="_blank"
                                            class="flex items-center justify-center gap-2 py-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl font-semibold text-xs transition-all active:scale-98">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>WhatsApp</span>
                                        </a>
                                    @endif

                                    @if ($loker->email)
                                        <a href="mailto:{{ $loker->email }}"
                                            class="flex items-center justify-center gap-2 py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-semibold text-xs transition-all active:scale-98">
                                            <i class="bi bi-envelope"></i>
                                            <span>Kirim Email</span>
                                        </a>
                                    @endif
                                </div>

                                {{-- 4. Fitur Unggulan Kita: Bikin Lamaran Otomatis (Gaya Soft Outline Menarik) --}}
                                <a href="/pekerja/surat-lamaran?posisi={{ urlencode(ucwords(strtolower($loker->posisi))) }}&perusahaan={{ urlencode(ucwords(strtolower($loker->perusahaan))) }}"
                                    class="flex items-center justify-center gap-2 w-full py-3 bg-white dark:bg-slate-900 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/60 text-center rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-blue-50 transition-all shadow-sm">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Bikin Lamaran Otomatis</span>
                                </a>
                            </div>

                        </div>

                        {{-- Content Detail --}}
                        <div class="p-6 md:p-12 space-y-8 border-t border-slate-50 dark:border-slate-800">

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

                                {{-- Shortcut Navigasi ke Bagian Bawah --}}
                                <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                                    <p
                                        class="text-xs font-semibold text-slate-400 dark:text-slate-500 mb-3 uppercase tracking-wider">
                                        Lompat ke Informasi Detail:
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        {{-- Tombol Tanggung Jawab / Tugas --}}
                                        <a href="#tugas-section"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-blue-50 dark:bg-slate-900 dark:hover:bg-blue-950/40 text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 text-xs md:text-sm font-medium rounded-lg border border-slate-200/60 dark:border-slate-800 transition-colors duration-200 text-decoration-none">
                                            <i class="bi bi-clipboard-check text-sm"></i>
                                            Tanggung Jawab
                                        </a>

                                        {{-- Tombol Kualifikasi / Persyaratan --}}
                                        <a href="#persyaratan-section"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-blue-50 dark:bg-slate-900 dark:hover:bg-blue-950/40 text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 text-xs md:text-sm font-medium rounded-lg border border-slate-200/60 dark:border-slate-800 transition-colors duration-200 text-decoration-none">
                                            <i class="bi bi-shield-check text-sm"></i>
                                            Kualifikasi
                                        </a>

                                        {{-- Tombol Benefit (Hanya muncul jika array benefit ada isinya) --}}
                                        @if (!empty($loker->benefit))
                                            <a href="#benefit-section"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-blue-50 dark:bg-slate-900 dark:hover:bg-blue-950/40 text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 text-xs md:text-sm font-medium rounded-lg border border-slate-200/60 dark:border-slate-800 transition-colors duration-200 text-decoration-none">
                                                <i class="bi bi-gift text-sm"></i>
                                                Benefit
                                            </a>
                                        @endif

                                        {{-- TAMBAHAN: Tombol Kontak (Hanya muncul jika ada data no_wa atau email) --}}
                                        @if ($loker->no_wa || $loker->email || $loker->link_pendaftaran)
                                            <a href="#kontak-section"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-blue-50 dark:bg-slate-900 dark:hover:bg-blue-950/40 text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 text-xs md:text-sm font-medium rounded-lg border border-slate-200/60 dark:border-slate-800 transition-colors duration-200 text-decoration-none">
                                                <i class="bi bi-whatsapp text-sm"></i>
                                                Kontak HRD
                                            </a>
                                        @endif

                                        {{-- Tombol Alamat --}}
                                        <a href="#alamat-section"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-blue-50 dark:bg-slate-900 dark:hover:bg-blue-950/40 text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 text-xs md:text-sm font-medium rounded-lg border border-slate-200/60 dark:border-slate-800 transition-colors duration-200 text-decoration-none">
                                            <i class="bi bi-geo-alt text-sm"></i>
                                            Alamat
                                        </a>
                                    </div>
                                </div>
                            </section>



                            @if (isset($affiliateAds) && $affiliateAds->count() > 0)
                                <div class="my-6 md:my-10">
                                    {{-- Label Penanda Iklan --}}
                                    <div class="flex items-center gap-2 mb-3">
                                        <span
                                            class="text-[10px] font-extrabold tracking-wider text-slate-400 dark:text-slate-500 uppercase">
                                            Rekomendasi Produk
                                        </span>
                                        <div class="h-px bg-slate-100 dark:bg-slate-800 flex-1"></div>
                                    </div>

                                    {{-- Wrapper Utama --}}
                                    <div class="flex flex-nowrap overflow-x-auto md:overflow-x-visible md:grid md:grid-cols-3 gap-3 pb-2 md:pb-0 snap-x snap-mandatory scrollbar-none"
                                        style="-webkit-overflow-scrolling: touch;">
                                        @foreach ($affiliateAds as $ad)
                                            <form action="/r/{{ $ad->custom_slug }}" method="POST" target="_blank"
                                                class="contents">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full text-left flex-none w-[30%] sm:w-[45%] md:w-full snap-start flex flex-col md:flex-row md:items-center gap-2 md:gap-3 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/40 rounded-xl p-2 shadow-2xs hover:shadow-xs hover:border-blue-500/20 dark:hover:border-blue-500/20 transition-all duration-200 group">

                                                    {{-- Isi konten (Gambar, Teks, dll) tetap sama --}}
                                                    <div
                                                        class="relative w-full h-20 md:w-20 md:h-20 aspect-square rounded-lg overflow-hidden bg-slate-50 dark:bg-slate-950 shrink-0">
                                                        @if ($ad->gambar_produk)
                                                            <img src="{{ asset('storage/' . $ad->gambar_produk) }}"
                                                                alt="{{ $ad->nama_produk }}"
                                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                        @else
                                                            <div
                                                                class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-700">
                                                                <i class="bi bi-image text-xs"></i>
                                                            </div>
                                                        @endif
                                                        <span
                                                            class="absolute top-0.5 right-0.5 text-[7px] font-extrabold px-1 py-0.5 rounded-md bg-white/90 dark:bg-slate-900/90 text-slate-700 dark:text-slate-300 backdrop-blur-xs shadow-3xs border border-slate-100/5 max-w-[58px] truncate">
                                                            {{ $ad->platform->nama_platform }}
                                                        </span>
                                                    </div>

                                                    <div class="flex flex-col flex-1 min-w-0 justify-center">
                                                        <h4
                                                            class="font-bold text-slate-800 dark:text-slate-200 text-[11px] sm:text-xs line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 leading-tight">
                                                            {{ $ad->nama_produk }}
                                                        </h4>
                                                        {{-- Info Harga --}}
                                                        <div
                                                            class="flex flex-wrap items-center gap-x-1.5 mt-1 leading-none">
                                                            @if ($ad->harga_diskon)
                                                                <span
                                                                    class="text-[11px] sm:text-xs font-black text-rose-600 dark:text-rose-400">
                                                                    Rp{{ number_format($ad->harga_diskon, 0, ',', '.') }}
                                                                </span>
                                                            @endif

                                                            @if ($ad->harga_asli && $ad->harga_asli > $ad->harga_diskon)
                                                                <span
                                                                    class="text-[9px] text-slate-400 dark:text-slate-500 line-through">
                                                                    Rp{{ number_format($ad->harga_asli, 0, ',', '.') }}
                                                                </span>
                                                            @endif
                                                        </div>

                                                        {{-- Deskripsi Pendek --}}
                                                        @if ($ad->deskripsi_pendek)
                                                            <p
                                                                class="text-[9px] text-slate-400 dark:text-slate-500 line-clamp-1 leading-none mt-1.5">
                                                                {{ $ad->deskripsi_pendek }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            {{-- 2. Grid Tugas & Syarat (Tetap Berdampingan) --}}
                            <div id="tugas-section" class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16">
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

                                <section id="persyaratan-section">
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
                            @if (!empty($loker->benefit))
                                <section id="benefit-section" class="pt-8 border-t border-slate-50 dark:border-slate-800">
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
                                <section id="alamat-section" class="pt-8 border-t border-slate-50 dark:border-slate-800">
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
                                        src="https://maps.google.com/maps?q={{ urlencode($loker->alamat . ' ' . $loker->kecamatan . ' ' . $loker->kota) }}&t=&z=13&ie=UTF8&iwloc=&output=embed&hl=id"
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

                        @php
                            $isExpired = false;

                            if ($loker->deadline) {
                                // Skenario 1: Jika melewati tanggal deadline
                                $isExpired = \Carbon\Carbon::now()->greaterThan(
                                    \Carbon\Carbon::parse($loker->deadline)->addDay()->startOfDay(),
                                );
                            } else {
                                // Skenario 2: Jika tidak ada deadline, cek apakah sudah lebih dari 1 bulan dari created_at
                                $isExpired = \Carbon\Carbon::parse($loker->updated_at)->addMonth()->isPast();
                            }
                        @endphp
                        {{-- Deadline Horizontal - Teks diperbesar di Desktop --}}
                        <div
                            class="{{ $isExpired ? 'bg-red-50 dark:bg-red-900/10 border-red-100 dark:border-red-900/20' : 'bg-blue-50 dark:bg-blue-900/10 border-blue-100 dark:border-blue-900/20' }} mb-6 p-3 rounded-2xl border flex items-center justify-between">

                            {{-- Kiri: Label Status --}}
                            <span
                                class="{{ $isExpired ? 'text-red-400' : 'text-blue-400' }} text-[10px] font-black uppercase tracking-widest ml-1">
                                {{ $isExpired ? 'Lowongan Tutup' : 'Deadline' }}
                            </span>

                            {{-- Kanan: Detail Tanggal / Keterangan --}}
                            <p
                                class="{{ $isExpired ? 'text-red-600 dark:text-red-500' : 'text-blue-600 dark:text-blue-500' }} text-[12px] font-black mr-1">
                                @if ($loker->deadline)
                                    {{-- Jika ada deadline, tampilkan tanggalnya meskipun sudah lewat --}}
                                    {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                @else
                                    {{-- Jika tidak ada deadline --}}
                                    @if ($isExpired)
                                        Selesai (Sudah > 1 Bulan)
                                    @else
                                        Sampai Kuota Terpenuhi
                                    @endif
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
                                <a href="/pekerja/surat-lamaran?posisi={{ urlencode(ucwords(strtolower($loker->posisi))) }}&perusahaan={{ urlencode(ucwords(strtolower($loker->perusahaan))) }}"
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
    <style>
        /* Partikel kembang api */
        /* Menggunakan position: fixed agar menimpa seluruh halaman */
        .particle {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 2px;
            height: 2px;
            background-color: #747474 !important;
            border-radius: 50%;
            pointer-events: none;
            z-index: 999999 !important;
            /* Nilai setinggi mungkin */
            box-shadow: 0 0 10px #3b82f6;
            /* Sedikit efek glow agar lebih terlihat */
        }

        /* Animasi klik */
        @keyframes pulse-once {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.4);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-pulse-click {
            animation: pulse-once 0.4s ease-in-out;
        }
    </style>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showTab(tab) {
            if (tab === 'login') {
                $('#form-login').removeClass('hidden');
                $('#form-register').addClass('hidden');
                $('#tab-login-btn').addClass('border-blue-600 text-blue-600').removeClass(
                    'border-transparent text-slate-400');
                $('#tab-reg-btn').removeClass('border-blue-600 text-blue-600').addClass(
                    'border-transparent text-slate-400');
            } else {
                $('#form-login').addClass('hidden');
                $('#form-register').removeClass('hidden');
                $('#tab-reg-btn').addClass('border-blue-600 text-blue-600').removeClass(
                    'border-transparent text-slate-400');
                $('#tab-login-btn').removeClass('border-blue-600 text-blue-600').addClass(
                    'border-transparent text-slate-400');
            }
        }

        function closeModal() {
            $('#auth-modal').addClass('hidden');
        }
        $(document).ready(function() {
            function createFirework(x, y) {
                console.log("Kembang api dipicu di:", x, y); // Cek di console apakah fungsi ini jalan
                const particleCount = 12; // Tambah jumlah partikel
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    document.body.appendChild(particle);

                    const angle = (i / particleCount) * Math.PI * 2;
                    const velocity = 50;
                    const dx = Math.cos(angle) * velocity;
                    const dy = Math.sin(angle) * velocity;

                    particle.animate([{
                            transform: `translate(${x}px, ${y}px)`,
                            opacity: 1
                        },
                        {
                            transform: `translate(${x + dx}px, ${y + dy}px)`,
                            opacity: 0
                        }
                    ], {
                        duration: 800,
                        easing: 'cubic-bezier(0,0,0.2,1)'
                    }).onfinish = () => particle.remove();
                }
            }

            $('#save-btn').on('click', function(e) {
                e.preventDefault();
                // Cek login
                @if (!auth()->check())
                    $('#auth-modal').removeClass('hidden').addClass('flex');
                    return;
                @endif

                var btn = $(this);
                var icon = btn.find('#save-icon');
                var text = btn.find('#save-text');
                var lokerId = btn.data('id');
                var isSaved = $(this).data('saved') === true || $(this).data('saved') === 'true';

                if (!isSaved) {
                    var rect = this.getBoundingClientRect();
                    var x = rect.left + rect.width / 2;
                    var y = rect.top + rect.height / 2;
                    createFirework(x, y);
                }

                // Ambil koordinat untuk kembang api
                var rect = this.getBoundingClientRect();
                var x = rect.left + rect.width / 2;
                var y = rect.top + rect.height / 2;

                // Efek kembang api jika baru disimpan
                if (!isSaved) {
                    createFirework(x, y);
                }

                // --- Efek Visual: Animasi klik ---
                icon.addClass('animate-pulse-click');
                setTimeout(() => icon.removeClass('animate-pulse-click'), 400);

                var url = isSaved ? '/loker/' + lokerId + '/unsave' : '/loker/' + lokerId + '/save';
                var method = isSaved ? 'DELETE' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        if (!isSaved) {
                            // Berubah jadi tersimpan
                            icon.fadeOut(100, function() {
                                $(this).removeClass('bi-bookmark').addClass(
                                    'bi-bookmark-fill text-blue-600').fadeIn(100);
                            });
                            text.fadeOut(100, function() {
                                $(this).text('Tersimpan').fadeIn(100);
                            });
                            btn.data('saved', true);
                        } else {
                            // Berubah jadi belum tersimpan
                            icon.fadeOut(100, function() {
                                $(this).removeClass('bi-bookmark-fill text-blue-600')
                                    .addClass('bi-bookmark').fadeIn(100);
                            });
                            text.fadeOut(100, function() {
                                $(this).text('Simpan Loker').fadeIn(100);
                            });
                            btn.data('saved', false);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            @if ($errors->any())
                $('#auth-modal').removeClass('hidden');

                // Opsional: Jika error berasal dari register, pindahkan ke tab register
                @if (session('error_type') == 'register') // Anda perlu mengirim session ini dari Controller
                    showTab('register');
                @endif
            @endif
        });
    </script>
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

    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "JobPosting",
  "title": "{{ $loker->posisi }}",
  "description": {!! json_encode(strip_tags($loker->deskripsi)) !!},
  "hiringOrganization" : {
    "@type": "Organization",
    "name": "{{ $loker->perusahaan }}"
  },
  "datePosted": "{{ $loker->created_at->toIso8601String() }}",
  "validThrough": "{{ $loker->deadline ? \Carbon\Carbon::parse($loker->deadline)->toIso8601String() : $loker->updated_at->addDays(30)->toIso8601String() }}",
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": {!! json_encode($loker->alamat) !!},
      "addressLocality": "{{ $loker->kecamatan }}",
      "addressRegion": "{{ $loker->kota }}",
      "addressCountry": "ID"
    }
  }
@if($loker->gaji && trim($loker->gaji) !== '-')
  @php
    // 1. Bersihkan semua karakter selain angka dan tanda strip (-)
    $gaji_clean = preg_replace('/[^0-9-]/', '', $loker->gaji);

    // 2. Pecah string berdasarkan tanda strip (-) dan buang array yang kosong
    $salary_parts = array_values(array_filter(explode('-', $gaji_clean)));

    // Ambil angka pertama sebagai nilai minimum
    $min_salary = !empty($salary_parts) ? (int)$salary_parts[0] : 0;
    // Ambil angka terakhir sebagai nilai maksimum (jagam-jaga jika ada rentang)
    $max_salary = count($salary_parts) > 1 ? (int)end($salary_parts) : 0;
  @endphp

  {{-- Hanya merender baseSalary jika berhasil mendapatkan angka di atas 0 --}}
  @if($min_salary > 0)
  ,"baseSalary": {
    "@type": "MonetaryAmount",
    "currency": "IDR",
    "value": {
      "@type": "QuantitativeValue",
      @if($max_salary > $min_salary)
        "minValue": {{ $min_salary }},
        "maxValue": {{ $max_salary }},
      @else
        "value": {{ $min_salary }},
      @endif
      "unitText": "MONTH"
    }
  }
  @endif
@endif
}


</script>
@endpush
