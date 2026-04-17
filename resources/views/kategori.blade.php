@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER KATEGORI --}}
            <div class="mb-16">
                <nav class="flex mb-6 text-sm font-medium text-slate-500 dark:text-slate-400">
                    <a href="/" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-900 dark:text-white capitalize">Kategori {{ $categoryName }}</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 dark:text-white mb-2 capitalize">
                            Layanan untuk <span class="text-blue-600">{{ $categoryName }}</span>
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400">Pilih template dokumen yang ingin Anda buat secara
                            otomatis.</p>
                    </div>

                    {{-- SEARCH MINI --}}
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari layanan..."
                            class="w-full bg-slate-100 dark:bg-slate-900 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-blue-600 dark:text-white">
                        <svg class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- TOOLS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Contoh Item Tool 1 --}}
                @foreach ($tools as $tool)
                    <div
                        class="group bg-white dark:bg-slate-900 rounded-[2.5rem] p-2 border border-slate-100 dark:border-slate-800 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-2 transition-all duration-500">

                        <div
                            class="aspect-[4/3] rounded-[2rem] bg-slate-100 dark:bg-slate-800 mb-4 overflow-hidden relative">
                            {{-- Preview Image dengan Efek Zoom --}}
                            <img src="{{ asset($tool->gambar) }}" alt="{{ $tool->nama_tool }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                            {{-- Overlay halus agar gambar tidak terlalu kontras --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                        </div>

                        <div class="px-6 py-4">
                            <h3 class="text-xl font-bold dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $tool->nama_tool }}
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 line-clamp-2">
                                {{ $tool->deskripsi }}
                            </p>

                            <a href="{{ url($tool->route_path) }}"
                                class="flex items-center justify-between w-full py-4 px-6 bg-slate-100 dark:bg-slate-800 rounded-2xl text-sm font-bold dark:text-white group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <span>Gunakan Tool</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tambahkan FAQ Statis di bawah Loop khusus untuk kategori ini --}}
            @if ($categoryName == 'Pekerja')
                <section class="mt-24 border-t border-slate-100 dark:border-slate-800 pt-16">
                    <h2 class="text-2xl font-black text-center mb-10 text-slate-900 dark:text-white">
                        Tips & FAQ Seputar <span class="text-blue-600">Dunia Kerja</span>
                    </h2>

                    <div class="max-w-3xl mx-auto space-y-6">
                        {{-- Item 1 --}}
                        <div
                            class="p-8 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2rem] transition-all hover:bg-white dark:hover:bg-slate-900 hover:shadow-xl hover:shadow-blue-500/5">
                            <p class="font-bold text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Apa itu Surat Lamaran Kerja standar ATS?
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                                ATS (Applicant Tracking System) adalah software yang digunakan HRD untuk menyaring ribuan CV
                                secara otomatis. Surat lamaran standar ATS biasanya menggunakan format teks yang bersih,
                                tanpa terlalu banyak elemen desain atau tabel yang rumit, agar sistem mudah membaca
                                kualifikasi Anda.
                            </p>
                        </div>

                        {{-- Item 2 --}}
                        <div
                            class="p-8 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2rem] transition-all hover:bg-white dark:hover:bg-slate-900 hover:shadow-xl hover:shadow-blue-500/5">
                            <p class="font-bold text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Kapan waktu terbaik mengirim lamaran kerja via Email?
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                                Disarankan mengirim lamaran pada hari kerja (Senin - Kamis) antara pukul <strong>08:00
                                    hingga 10:00 pagi</strong>. Ini adalah waktu di mana HRD baru mulai membuka email,
                                sehingga posisi lamaran Anda berada di urutan paling atas.
                            </p>
                        </div>

                        {{-- Item 3 --}}
                        <div
                            class="p-8 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2rem] transition-all hover:bg-white dark:hover:bg-slate-900 hover:shadow-xl hover:shadow-blue-500/5">
                            <p class="font-bold text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Berapa ukuran file PDF yang disarankan?
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                                Usahakan total ukuran file (Surat Lamaran + CV + Lampiran) tidak lebih dari
                                <strong>2MB</strong>. File yang terlalu besar berisiko ditolak oleh sistem email perusahaan
                                atau lambat saat diunduh oleh rekruter.
                            </p>
                        </div>

                        {{-- Item 4 --}}
                        <div
                            class="p-8 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2rem] transition-all hover:bg-white dark:hover:bg-slate-900 hover:shadow-xl hover:shadow-blue-500/5">
                            <p class="font-bold text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Apakah surat pengunduran diri wajib dibuat?
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                                Sangat wajib jika Anda ingin menjaga profesionalisme dan "pintu" silaturahmi tetap terbuka.
                                Surat resign formal membantu proses serah terima pekerjaan (handover) menjadi lebih jelas
                                dan legal secara administrasi perusahaan.
                            </p>
                        </div>
                    </div>
                </section>
            @endif

            {{-- CTA JIKA TIDAK MENEMUKAN --}}
            <div class="mt-20 p-10 bg-blue-600 rounded-[3rem] text-center text-white">
                <h2 class="text-2xl font-black mb-4">Butuh dokumen khusus?</h2>
                <p class="text-blue-100 mb-8 max-w-xl mx-auto text-sm">Tim GaweDokumen terus menambah template setiap
                    minggu. Request template yang kamu butuhkan sekarang!</p>
                <a href="/contact"
                    class="inline-block bg-white text-blue-600 px-8 py-3 rounded-xl font-black shadow-lg hover:bg-blue-50 transition-colors">Hubungi
                    Kami</a>
            </div>
        </div>
    </div>
@endsection
