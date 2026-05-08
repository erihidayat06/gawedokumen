@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER / HIGHLIGHT LOKER --}}
            <div
                class="relative mb-16 rounded-[2.5rem] overflow-hidden bg-blue-600 p-8 md:p-16 shadow-2xl overflow-hidden group">
                {{-- Dekorasi Background --}}
                <div
                    class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-blue-500 rounded-full opacity-20 group-hover:scale-110 transition-transform duration-700">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="max-w-2xl text-center md:text-left">
                        <span
                            class="px-4 py-1.5 bg-blue-500 text-white text-xs font-bold rounded-full uppercase tracking-widest mb-6 inline-block border border-blue-400">
                            🔥 Rekomendasi Karir
                        </span>
                        <h2 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">
                            Temukan Pekerjaan Impianmu di <span class="text-blue-200">Tegal & Sekitarnya</span>
                        </h2>
                        <p class="text-blue-100 text-lg mb-8 opacity-90">
                            Update harian lowongan kerja terbaru, mulai dari Staff Gudang, Admin, hingga IT Support dengan
                            informasi deadline yang akurat.
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                            <a href="#loker-terbaru"
                                class="px-8 py-4 bg-white text-blue-600 rounded-2xl font-bold shadow-xl hover:bg-blue-50 transition-all active:scale-95">Lihat
                                Lowongan</a>
                            <a href="/tools/cv"
                                class="px-8 py-4 bg-blue-700 text-white rounded-2xl font-bold hover:bg-blue-800 transition-all border border-blue-500/30">Buat
                                CV Otomatis</a>
                        </div>
                    </div>
                    <div
                        class="hidden md:block w-72 h-72 bg-blue-500/30 rounded-[3rem] rotate-12 border-4 border-blue-400/20 backdrop-blur-sm">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12" id="loker-terbaru">

                {{-- MAIN CONTENT: LIST LOKER --}}
                <div class="lg:col-span-8 space-y-8">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-2xl font-black dark:text-white border-l-4 border-blue-600 pl-4">
                            Lowongan Terbaru {{ $bulanSekarang }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        @forelse ($lokers as $loker)
                            <div
                                class="group p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] hover:border-blue-500 transition-all hover:shadow-xl hover:shadow-blue-500/5">
                                <div class="flex flex-col md:flex-row justify-between gap-6">
                                    <div class="flex gap-6">
                                        {{-- Inisial Perusahaan --}}
                                        <div
                                            class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center font-black text-blue-600 text-xl overflow-hidden shrink-0 uppercase">
                                            {{ substr($loker->perusahaan, 0, 2) }}
                                        </div>
                                        <div>
                                            {{-- Judul SEO: Posisi + Kecamatan + Kota --}}
                                            <h4
                                                class="text-xl font-bold dark:text-white group-hover:text-blue-600 transition-colors mb-1">
                                                {{ $loker->posisi }} - {{ $loker->kecamatan }}
                                            </h4>
                                            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-3">
                                                {{ $loker->perusahaan }} • {{ $loker->kota }}, Jawa Tengah
                                            </p>

                                            <div class="flex flex-wrap gap-2">
                                                <span
                                                    class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-bold rounded-lg uppercase">
                                                    {{ $loker->tipe_pekerjaan }}
                                                </span>
                                                @if ($loker->gaji)
                                                    <span
                                                        class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-600 text-[10px] font-bold rounded-lg uppercase">
                                                        {{ $loker->gaji }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col justify-between items-end gap-4">
                                        @if ($loker->deadline)
                                            <span
                                                class="text-xs font-bold text-red-500 bg-red-50 dark:bg-red-900/20 px-3 py-1 rounded-full uppercase tracking-tighter">
                                                Deadline:
                                                {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                            </span>
                                        @else
                                            <span class="text-xs font-bold text-slate-400 italic">
                                                Tayang {{ $loker->created_at->diffForHumans() }}
                                            </span>
                                        @endif

                                        <a href="{{ route('loker.show', $loker->slug) }}"
                                            class="w-full md:w-auto px-6 py-2.5 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-xl text-sm font-bold hover:bg-blue-600 dark:hover:bg-blue-50 transition-colors text-center">
                                            Detail Loker
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="p-20 text-center border-2 border-dashed border-slate-100 dark:border-slate-800 rounded-[2rem]">
                                <p class="text-slate-400 italic">Belum ada lowongan kerja untuk bulan ini.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination agar tidak berat --}}
                    {{-- <div class="mt-10">
                        {{ $lokers->links() }}
                    </div> --}}
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4 space-y-10">
                    {{-- Filter Sederhana --}}
                    <div
                        class="bg-slate-50 dark:bg-slate-900/50 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800">
                        <h3 class="text-xl font-black dark:text-white mb-6">Cari <span class="text-blue-600">Wilayah</span>
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @php $districts = ['Adiwerna', 'Slawi', 'Margadana', 'Talang', 'Dukuhwaru', 'Kramat']; @endphp
                            @foreach ($districts as $district)
                                <a href="#"
                                    class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all">
                                    {{ $district }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Banner Generator --}}
                    <div
                        class="p-8 bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group">
                        <div
                            class="absolute -right-4 -bottom-4 w-32 h-32 bg-blue-600 rounded-full opacity-20 blur-2xl group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <h4 class="font-black mb-4 text-2xl leading-tight">Siapkan Berkas <br>Sekarang!</h4>
                        <p class="text-slate-400 text-sm mb-6 leading-relaxed">Jangan biarkan loker impian hilang karena
                            belum punya Surat Lamaran Kerja atau CV yang rapi.</p>
                        <div class="space-y-3">
                            <a href="/tools/lamaran"
                                class="block text-center bg-blue-600 text-white py-3.5 rounded-2xl text-sm font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all">Generator
                                Surat Lamaran</a>
                            <a href="/tools/cv"
                                class="block text-center bg-white text-slate-900 py-3.5 rounded-2xl text-sm font-bold hover:bg-slate-100 transition-all">Buat
                                CV Online</a>
                        </div>
                    </div>

                    {{-- Tips Singkat --}}
                    <div class="p-8 border border-dashed border-slate-200 dark:border-slate-800 rounded-[2.5rem]">
                        <h4 class="font-bold dark:text-white mb-4 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Tips Cepat
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-4">
                            HRD biasanya mengecek email di pagi hari pukul <strong>08.00 - 10.00</strong>. Kirim lamaranmu
                            di jam tersebut agar posisi emailmu berada di urutan teratas!
                        </p>
                        <a href="/blog" class="text-blue-600 text-xs font-bold hover:underline">Pelajari Tips Lainnya
                            &rarr;</a>
                    </div>
                </aside>

            </div>
        </div>
    </div>
@endsection
