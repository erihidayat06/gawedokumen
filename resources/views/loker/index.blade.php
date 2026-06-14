@extends('layouts.app')

@section('title')
    @if (isset($currentWilayah))
        Lowongan Kerja Terbaru di {{ $currentWilayah }} - Mei 2026
    @else
        Portal Lowongan Kerja Tegal, Brebes, Pemalang Terbaru 2026
    @endif
@endsection

@section('meta_description')
    Cari loker {{ isset($currentWilayah) ? "di $currentWilayah" : 'se-Tegal Raya' }} terlengkap.
    Tersedia lowongan {{ $lokers->take(3)->pluck('posisi')->implode(', ') }}.
@endsection



@section('content')
    @php
        // Cek apakah variabel $currentSlug dikirim dari controller (halaman wilayah)
        // Jika ada, gunakan route wilayah. Jika tidak, gunakan route index biasa.
        $formAction = isset($currentSlug) ? route('loker.wilayah', $currentSlug) : route('loker.index');
    @endphp
    <div class=" min-h-screen pt-20 pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-6">


            {{-- SECTION FILTER & SEARCH --}}
            <div class="mb-10">
                <form id="lokerForm" action="{{ $formAction }}" method="GET"
                    class="bg-white dark:bg-slate-900 p-4 md:p-2 rounded-[2rem] md:rounded-full shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">

                    <div class="flex flex-col md:flex-row items-center gap-1">
                        {{-- Search Keyword --}}
                        <div class="relative w-full md:flex-[1.5]">
                            <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-blue-600"></i>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                placeholder="Posisi atau Perusahaan..."
                                class="w-full pl-12 pr-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium">
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Wilayah --}}
                        <div class="w-full md:flex-1 group">
                            <select name="wilayah" id="wilayahSelect"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Semua Wilayah</option>
                                @foreach (['Kabupaten Tegal', 'Kota Tegal', 'Brebes', 'Pemalang'] as $w)
                                    @php
                                        $slugW = str_replace(' ', '-', strtolower($w));
                                        $isSelected =
                                            request('wilayah') == $w || (isset($currentSlug) && $currentSlug == $slugW);
                                    @endphp
                                    <option value="{{ $slugW }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $w }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Pendidikan --}}
                        <div class="w-full md:flex-1">
                            <select name="pendidikan" id="pendidikanSelect"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Pendidikan...</option>
                                @foreach (['SMP', 'SMA/SMK', 'D3', 'S1/S2'] as $p)
                                    <option value="{{ $p }}" {{ request('pendidikan') == $p ? 'selected' : '' }}>
                                        {{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Tipe Pekerjaan --}}
                        <div class="w-full md:flex-1">
                            <select name="tipe" id="tipeSelect"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Tipe Kerja...</option>
                                @foreach (['Full Time', 'Part Time', 'Kontrak', 'Magang'] as $t)
                                    <option value="{{ $t }}" {{ request('tipe') == $t ? 'selected' : '' }}>
                                        {{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Button --}}
                        <div class="w-full md:w-auto p-1">
                            <button type="submit"
                                class="w-full md:w-auto px-10 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-xl md:rounded-full transition-all shadow-lg shadow-blue-500/25 text-sm uppercase tracking-wider">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- JUDUL DINAMIS --}}
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white leading-tight">
                    @if (isset($currentWilayah))
                        Lowongan Kerja di {{ $currentWilayah }}
                    @else
                        Lowongan Kerja Terbaru
                    @endif
                    <span class="text-blue-600">
                        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </span>
                </h2>
                <p class="text-sm md:text-base text-slate-500 dark:text-slate-400 mt-2">
                    @if (isset($currentWilayah))
                        Menampilkan peluang karir terbaik yang tersedia di wilayah {{ $currentWilayah }} dan sekitarnya.
                    @else
                        Temukan pekerjaan impian Anda dari berbagai perusahaan terpercaya di Tegal, Brebes, dan Pemalang.
                    @endif
                </p>
            </div>
            {{-- GRID LOKER --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @forelse ($lokers as $loker)
                    <a href="{{ route('loker.show', $loker->slug) }}" class="group block">
                        <div
                            class="relative h-full p-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] hover:border-blue-500 transition-all hover:shadow-xl hover:shadow-blue-500/5 flex flex-col overflow-hidden">

                            {{-- Badge Status Mobile Friendly --}}
                            <div class="flex justify-between items-start mb-4">

                                <div
                                    class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center font-black text-blue-600 text-base uppercase shrink-0">
                                    @php
                                        // Pecah nama perusahaan jadi array kata
                                        $words = explode(' ', $loker->perusahaan);
                                        $initials = '';

                                        foreach ($words as $w) {
                                            // Abaikan kata "PT" atau "CV" agar inisial lebih relevan (opsional)
                                            if (in_array(strtoupper($w), ['PT', 'PT.', 'CV', 'CV.'])) {
                                                continue;
                                            }

                                            // Ambil huruf pertama tiap kata
                                            $initials .= substr($w, 0, 1);
                                        }

                                        // Jika setelah difilter kosong (misal nama cuma "PT"), ambil 2 huruf depan asli
                                        if (empty($initials)) {
                                            $initials = substr($loker->perusahaan, 0, 2);
                                        }

                                        // Tampilkan maksimal 2 atau 3 huruf saja
                                        echo substr($initials, 0, 2);
                                    @endphp
                                </div>

                                @php
                                    $deadline = $loker->deadline;
                                    $isExpired = false;

                                    if ($deadline) {
                                        // Skenario 1: Jika ada deadline, cek apakah sudah lewat hari ini
                                        $isExpired = \Carbon\Carbon::now()->greaterThan(
                                            \Carbon\Carbon::parse($loker->deadline)->addDay()->startOfDay(),
                                        );
                                    } else {
                                        // Skenario 2: Jika tidak ada deadline, cek apakah sudah lebih dari 1 bulan daricreated_at
                                        $isExpired = \Carbon\Carbon::parse($loker->updated_at)->addMonth()->isPast();
                                    }
                                @endphp

                                <span
                                    class="text-[9px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider dark:bg-slate-800
                                     {{ $isExpired ? 'bg-red-50 text-red-500' : (!$deadline ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600') }}">

                                    @if ($isExpired)
                                        {{-- Kondisi Tutup: Baik karena lewat tanggal deadline, ATAU karena sudah > 1 bulan (jika null) --}}
                                        Tutup
                                    @elseif (!$deadline)
                                        {{-- Kondisi Terbuka: Jika deadline null DAN umur lowongan masih di bawah 1 bulan --}}
                                        <i class="bi bi-clock-history me-1"></i> Terbuka
                                    @else
                                        {{-- Kondisi Aktif dengan Tanggal: Jika ada deadline dan belum expired --}}
                                        Hingga {{ \Carbon\Carbon::parse($deadline)->translatedFormat('d M') }}
                                    @endif
                                </span>
                            </div>

                            {{-- Info Utama --}}
                            <div class="mb-4">
                                <h4
                                    class="text-base font-bold dark:text-white group-hover:text-blue-600 transition-colors leading-snug mb-1 line-clamp-1">
                                    {{ ucwords(strtolower($loker->posisi)) }}
                                </h4>
                                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium flex items-center gap-1">
                                    <i class="bi bi-building text-[10px]"></i> {{ $loker->perusahaan }}
                                </p>
                            </div>

                            {{-- Metadata Ramping --}}
                            <div class="flex flex-wrap gap-2 mt-auto">
                                <div
                                    class="flex items-center gap-1 px-2.5 py-1 bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-md">
                                    <i class="bi bi-geo-alt-fill text-blue-500"></i>
                                    <span class="capitalize">{{ Str::lower($loker->kecamatan) }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-1 px-2.5 py-1 bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-md">

                                    {{ $loker->kota }}
                                </div>

                                <div
                                    class="flex items-center gap-1 px-2.5 py-1 bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-md">

                                    Jawa Tengah
                                </div>
                                <div
                                    class="flex items-center gap-1 px-2.5 py-1 bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-md">

                                    {{ $loker->tipe_pekerjaan }}
                                </div>

                                @if ($loker->gaji)
                                    <div
                                        class="flex items-center gap-1 px-2.5 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-[10px] font-bold rounded-md">
                                        {{ $loker->gaji }}
                                    </div>
                                @endif
                            </div>

                            {{-- Footer Card --}}
                            <div
                                class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-800 flex items-center justify-between">
                                <span class="text-[10px] text-slate-400">
                                    <i class="bi bi-clock me-1"></i>{{ $loker->created_at->diffForHumans() }}
                                </span>
                                <span
                                    class="text-blue-600 text-[11px] font-black group-hover:translate-x-1 transition-transform">
                                    Detail <i class="bi bi-arrow-right ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- State Kosong Tetap Sama --}}
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $lokers->links() }}
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('lokerForm').addEventListener('submit', function(e) {
            const wilayah = document.getElementById('wilayahSelect').value;
            const search = document.getElementById('searchInput').value;
            const pendidikan = document.getElementById('pendidikanSelect').value;
            const tipe = document.getElementById('tipeSelect').value;

            // Jika ada input pencarian (text), biarkan form submit biasa ke /loker (standard query string)
            if (search) {
                return;
            }

            // Jika user memilih wilayah, kita arahkan ke URL cantik
            if (wilayah) {
                e.preventDefault();

                // Bangun Query String untuk filter lainnya agar tidak hilang
                let params = new URLSearchParams();
                if (pendidikan) params.append('pendidikan', pendidikan);
                if (tipe) params.append('tipe', tipe);

                let queryString = params.toString() ? '?' + params.toString() : '';

                // Redirect ke URL cantik wilayah + query string filter
                window.location.href = "{{ url('/loker/wilayah') }}/" + wilayah + queryString;
            }
        });
    </script>
@endpush
