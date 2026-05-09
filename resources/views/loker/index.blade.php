@extends('layouts.app')

@section('content')
    <div class="bg-slate-50 dark:bg-slate-950 min-h-screen pt-20 pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-6">

            {{-- SECTION FILTER & SEARCH --}}
            <div class="mb-10">
                <form action="{{ route('loker.index') }}" method="GET"
                    class="bg-white dark:bg-slate-900 p-4 md:p-2 rounded-[2rem] md:rounded-full shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">

                    <div class="flex flex-col md:flex-row items-center gap-1">

                        {{-- Keyword Search --}}
                        <div class="relative w-full md:flex-[1.5]">
                            <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-blue-600"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Posisi atau Perusahaan..."
                                class="w-full pl-12 pr-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium">
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Wilayah --}}
                        <div class="w-full md:flex-1 group">
                            <select name="wilayah"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Semua Wilayah</option>
                                @foreach (['Kabupaten Tegal', 'Kota Tegal', 'Brebes', 'Pemalang', 'Slawi'] as $w)
                                    <option value="{{ $w }}" {{ request('wilayah') == $w ? 'selected' : '' }}>
                                        {{ $w }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Pendidikan --}}
                        <div class="w-full md:flex-1">
                            <select name="pendidikan"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Pendidikan...</option>
                                @foreach (['SMP', 'SMA/SMK', 'D3', 'S1/S2'] as $p)
                                    <option value="{{ $p }}" {{ request('pendidikan') == $p ? 'selected' : '' }}>
                                        {{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                        {{-- Filter Tipe --}}
                        <div class="w-full md:flex-1">
                            <select name="tipe"
                                class="w-full px-4 py-4 bg-transparent border-none focus:ring-0 dark:text-white text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Tipe Kerja...</option>
                                <option value="Full Time" {{ request('tipe') == 'Full Time' ? 'selected' : '' }}>Full Time
                                </option>
                                <option value="Part Time" {{ request('tipe') == 'Part Time' ? 'selected' : '' }}>Part Time
                                </option>
                                <option value="Kontrak" {{ request('tipe') == 'Kontrak' ? 'selected' : '' }}>Kontrak
                                </option>
                                <option value="Magang" {{ request('tipe') == 'Magang' ? 'selected' : '' }}>Magang</option>
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

                {{-- Pencarian Populer (Opsional untuk mempercantik) --}}
                <div class="mt-4 flex flex-wrap gap-2 px-6">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mr-2 py-1">Populer:</span>
                    @foreach (['Admin', 'Sales', 'Driver', 'Operator'] as $tag)
                        <a href="?search={{ $tag }}"
                            class="text-[10px] font-bold text-slate-500 hover:text-blue-600 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full transition-colors border border-transparent hover:border-blue-200">
                            #{{ $tag }}
                        </a>
                    @endforeach
                </div>
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

                                @if ($loker->deadline)
                                    @php $isExpired = \Carbon\Carbon::parse($loker->deadline)->isPast(); @endphp
                                    <span
                                        class="text-[9px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider {{ $isExpired ? 'bg-red-50 text-red-500' : 'bg-green-50 text-green-600' }} dark:bg-slate-800">
                                        {{ $isExpired ? 'Tutup' : 'Hingga ' . \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Info Utama --}}
                            <div class="mb-4">
                                <h4
                                    class="text-base font-bold dark:text-white group-hover:text-blue-600 transition-colors leading-snug mb-1 line-clamp-1">
                                    {{ $loker->posisi }}
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
