@extends('layouts.app')

@section('content')
    <div class="py-24 bg-white dark:bg-slate-950 min-h-screen">
        <div class="max-w-xl mx-auto px-2">

            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">Kompres Gambar Gratis</h1>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Format: <span class="font-medium text-indigo-600">JPG, PNG, WebP</span> (Maks 5MB)
                </p>

            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div
                    class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-6 md:p-8 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-blue-500/5">

                    <form action="{{ route('tool.kompres.gambar') }}" method="POST" enctype="multipart/form-data"
                        x-data="imageCompressor()" x-init="init()">
                        @csrf
                        <div class="space-y-6">
                            <!-- Input File Section -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">
                                    Pilih Gambar
                                </label>
                                <div class="relative">
                                    <input type="file" name="image" @change="handleFile" id="imageInput"
                                        class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-bold
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100
                            dark:file:bg-indigo-950 dark:file:text-indigo-400
                            border border-slate-200 dark:border-slate-700 rounded-2xl bg-slate-50 dark:bg-slate-800/50 p-1">
                                </div>
                            </div>

                            <!-- Compression Settings Panel -->
                            <div x-show="originalSize > 0 || {{ session('success') ? 'true' : 'false' }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                class="border border-slate-200 dark:border-slate-700 rounded-3xl bg-slate-50 dark:bg-slate-800/50 p-5 space-y-5">

                                <!-- Stats Header -->
                                <div
                                    class="flex justify-between items-center border-b border-slate-200 dark:border-slate-700 pb-3">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 uppercase font-black tracking-wider">Ukuran
                                            Asli</span>
                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200"
                                            x-text="formatBytes(originalSize) || 'N/A'"></span>
                                    </div>

                                </div>

                                <!-- Quality Slider -->
                                <div class="space-y-3">
                                    <div class="flex justify-between uppercase tracking-tight">
                                        <label class="text-xs font-bold text-slate-600 dark:text-slate-400">Kualitas</label>
                                        <span class="text-xs font-black text-indigo-600" x-text="quality + '%'"></span>
                                    </div>
                                    <input type="range" name="quality" min="10" max="100" x-model="quality"
                                        class="w-full h-1.5 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                </div>

                                <!-- Width Slider -->
                                <div class="space-y-3">
                                    <div class="flex justify-between uppercase tracking-tight">
                                        <label class="text-xs font-bold text-slate-600 dark:text-slate-400">Lebar
                                            Maksimal</label>
                                        <span class="text-xs font-black text-indigo-600" x-text="width + 'px'"></span>
                                    </div>
                                    <input type="range" name="width" min="100" max="3000" step="50"
                                        x-model="width"
                                        class="w-full h-1.5 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                                Kompres Sekarang
                            </button>
                        </div>
                    </form>

                    {{-- Success State --}}
                    @if (session('success'))
                        <div
                            class="mt-6 p-4 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 rounded-2xl animate-pulse">
                            <div class="flex items-center mb-4">
                                <div class="bg-emerald-500 rounded-full p-1 mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-emerald-800 dark:text-emerald-400 text-xs font-bold uppercase tracking-wide">
                                    {{ session('success') }}
                                </p>
                            </div>

                            <a href="{{ asset('storage/temp/' . session('file')) }}" download
                                class="flex items-center justify-center w-full px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-colors shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download Hasil
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Back Navigation -->
                <div class="mt-8 text-center">
                    <a href="/"
                        class="group inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        <article class="text-black mt-24 dark:text-slate-100 px-3 leading-relaxed sm:mx-auto sm:w-full sm:max-w-4xl">
            <div class="mb-8 text-center">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Cara Kompres Gambar di <span class="text-indigo-600">GaweDokumen</span>
                </h2>
                <p class="mt-3 text-slate-500 dark:text-slate-400 font-medium">
                    Solusi cerdas kecilkan ukuran foto tanpa ribet.
                </p>
            </div>
            <div class="prose dark:prose-invert max-w-none">
                <p class="mb-4">
                    Pernahkah Anda mencoba mengunggah foto untuk pendaftaran kerja atau tugas sekolah, tetapi ditolak karena
                    ukuran filenya terlalu besar? Tenang, Anda tidak sendirian. Di <strong>GaweDokumen</strong>, kami
                    menyediakan alat kompresi cerdas yang membantu Anda mengecilkan ukuran gambar tanpa mengorbankan
                    kualitas secara drastis.
                </p>

                <h2 class="text-lg font-bold mb-2 text-indigo-600 dark:text-indigo-400">Cara Menggunakan Fitur Kompres
                    Gambar</h2>
                <ol class="list-decimal ml-5 mb-6 space-y-2">
                    <li><strong>Pilih Gambar:</strong> Klik tombol pilih gambar dan masukkan foto (JPG, PNG, atau WebP) yang
                        ingin Anda kecilkan.</li>
                    <li><strong>Atur Kualitas:</strong> Gunakan slider kualitas. Angka 60% adalah titik seimbang (sweet
                        spot) antara ukuran kecil dan tampilan yang tetap tajam.</li>
                    <li><strong>Atur Lebar (Opsional):</strong> Jika gambar Anda terlalu lebar (misal 4000px), kecilkan ke
                        1500px untuk penghematan ruang yang lebih signifikan.</li>
                    <li><strong>Klik Kompres:</strong> Tekan tombol "Kompres Sekarang", tunggu sebentar, dan file siap
                        diunduh!</li>
                </ol>

                <h2 class="text-lg font-bold mb-2 text-indigo-600 dark:text-indigo-400">Manfaat Melakukan Kompresi Gambar
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-sm mb-1 text-slate-700 dark:text-slate-200">🚀 Pengiriman Lebih Cepat</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">File yang lebih kecil akan lebih cepat
                            terkirim melalui email, WhatsApp, atau formulir pendaftaran online.</p>
                    </div>
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-sm mb-1 text-slate-700 dark:text-slate-200">💾 Hemat Penyimpanan</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Menghemat ruang di memori HP atau laptop
                            Anda.
                            Foto yang dikompres bisa menghemat ruang hingga 80%!</p>
                    </div>
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-sm mb-1 text-slate-700 dark:text-slate-200">📉 Ramah Kuota</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Mengunggah file kecil berarti menghemat kuota
                            internet Anda, terutama saat berada di jaringan yang lambat.</p>
                    </div>
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-sm mb-1 text-slate-700 dark:text-slate-200">🛡️ Privasi Terjaga</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Di GaweDokumen, file Anda akan dihapus secara
                            otomatis dalam 60 menit. Keamanan data Anda adalah prioritas kami.</p>
                    </div>
                </div>

                <blockquote class="border-l-4 border-indigo-500 pl-4 italic text-slate-600 dark:text-slate-400 text-sm">
                    "Gambar yang bagus bukan berarti harus berukuran raksasa. Kompresi yang tepat adalah kunci efisiensi
                    digital."
                </blockquote>
            </div>
        </article>
        <!-- Wrapper FAQ sejajar dengan Form dan Artikel -->
        <div class="sm:mx-auto sm:w-full sm:max-w-4xl mt-24 mb-12">
            <div class="px-4 sm:px-0">
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.443 1.103m-3.13 0a1.166 1.166 0 01-1.166-1.166V12a1.166 1.166 0 011.166-1.166h.5c.53 0 .964.433.964.964v.5c0 .53-.433.964-.964.964h-.5zM12 17h.01">
                        </path>
                    </svg>
                    Pertanyaan Sering Diajukan
                </h3>

                <div class="space-y-4" x-data="{ active: null }">

                    <!-- FAQ 1 -->
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-3xl bg-white dark:bg-slate-900 overflow-hidden shadow-sm">
                        <button @click="active !== 1 ? active = 1 : active = null"
                            class="w-full flex justify-between items-center p-5 text-left transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Apakah gambar saya
                                aman?</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-300"
                                :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 1" x-collapse x-cloak>
                            <div class="p-5 pt-0 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Sangat aman. Kami menggunakan sistem penghapusan otomatis. Semua file yang Anda unggah akan
                                dihapus permanen dari server kami dalam waktu 60 menit.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-3xl bg-white dark:bg-slate-900 overflow-hidden shadow-sm">
                        <button @click="active !== 2 ? active = 2 : active = null"
                            class="w-full flex justify-between items-center p-5 text-left transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Format apa saja yang
                                didukung?</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-300"
                                :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 2" x-collapse x-cloak>
                            <div class="p-5 pt-0 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Saat ini GaweDokumen mendukung format gambar populer yaitu JPG, JPEG, PNG, dan WebP dengan
                                ukuran maksimal 5MB per file.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div
                        class="border border-slate-100 dark:border-slate-800 rounded-3xl bg-white dark:bg-slate-900 overflow-hidden shadow-sm">
                        <button @click="active !== 3 ? active = 3 : active = null"
                            class="w-full flex justify-between items-center p-5 text-left transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Mengapa hasil kompresi
                                buram?</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-300"
                                :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 3" x-collapse x-cloak>
                            <div class="p-5 pt-0 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                Hal ini terjadi jika slider kualitas diatur terlalu rendah (di bawah 30%). Kami menyarankan
                                pengaturan di angka 60% - 80% untuk hasil optimal.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function imageCompressor() {
            return {
                quality: 60,
                width: 1500,
                // AMBIL LANGSUNG SAAT DEFINISI:
                originalSize: parseInt(localStorage.getItem('compress_orig_size')) || 0,
                originalWidth: parseInt(localStorage.getItem('compress_orig_width')) || 2000,

                init() {
                    // Tambahkan pengecekan log di konsol untuk memastikan data masuk
                    console.log('Data dari storage:', this.originalSize);

                    // Tetap pasang event listener untuk pembersihan saat keluar halaman
                    window.addEventListener('beforeunload', () => {
                        this.clearImageData();
                    });
                },

                handleFile(e) {
                    const file = e.target.files[0];
                    if (file) {
                        this.originalSize = file.size;
                        localStorage.setItem('compress_orig_size', file.size);

                        const img = new Image();
                        img.onload = () => {
                            this.originalWidth = img.width;
                            localStorage.setItem('compress_orig_width', img.width);

                            if (parseInt(this.originalWidth) < parseInt(this.width)) {
                                this.width = this.originalWidth;
                            }
                        };
                        img.src = URL.createObjectURL(file);
                    }
                },

                clearImageData() {
                    // Jangan panggil ini di dalam init() tanpa kondisi,
                    // karena akan langsung menghapus data saat refresh.
                    localStorage.removeItem('compress_orig_size');
                    localStorage.removeItem('compress_orig_width');
                },

                estimateSize() {
                    if (this.originalSize === 0) return '0 KB';

                    let dimensionRatio = Math.pow(this.width / this.originalWidth, 2);
                    if (dimensionRatio > 1) dimensionRatio = 1;

                    let qualityFactor = Math.pow(this.quality / 100, 1.5);
                    let estimated = this.originalSize * dimensionRatio * qualityFactor * 0.8;

                    return this.formatBytes(estimated / 2);
                },

                formatBytes(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }
            }
        }
    </script>
@endpush
