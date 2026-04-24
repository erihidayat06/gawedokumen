@extends('layouts.app')

@section('content')
    <div class="py-24 bg-white dark:bg-slate-950 min-h-screen">
        <div class="max-w-xl mx-auto px-4">

            {{-- Header Section --}}
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">Kompres PDF</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm md:text-base">Kecilkan ukuran file PDF tanpa merusak
                    kualitas teks (ATS Friendly).</p>
            </div>

            {{-- Main Card --}}
            <div x-data="pdfCompressor()"
                class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-6 md:p-8 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-blue-500/5">

                {{-- Upload Area --}}
                <div class="relative group">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 ml-1">Pilih File
                        PDF:</label>
                    <div class="relative flex items-center justify-center w-full">
                        <label
                            class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-3xl cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all overflow-hidden">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="mb-2 text-sm text-slate-700 dark:text-slate-300 font-semibold">Klik atau seret
                                    file ke sini</p>
                                <p class="text-xs text-slate-500">Maksimal 15MB (PDF saja)</p>
                            </div>
                            <input type="file" class="hidden" @change="handleFile" accept="application/pdf" />
                        </label>
                    </div>
                </div>

                {{-- Loading State --}}
                <template x-if="loading">
                    <div
                        class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-3xl border border-blue-100 dark:border-blue-800 flex items-center gap-4">
                        <div class="w-10 h-10 border-4 border-blue-600 border-t-transparent rounded-full animate-spin">
                        </div>
                        <div>
                            <p class="text-blue-700 dark:text-blue-400 font-bold">⚡ Sedang diproses, Lur...</p>
                            <p class="text-xs text-blue-600/70 dark:text-blue-400/70">Ghostscript lagi kerja keras buat
                                kamu.</p>
                        </div>
                    </div>
                </template>

                {{-- Result State --}}
                <template x-if="result">
                    <div class="mt-8 space-y-4">
                        <div
                            class="p-6 bg-green-50 dark:bg-green-900/20 rounded-3xl border border-green-100 dark:border-green-800">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-500 text-white p-1 rounded-full text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-green-700 dark:text-green-400">Berhasil Dikompres!</h3>
                                </div>
                                {{-- Badge Persentase --}}

                            </div>

                            <div
                                class="flex flex-col mb-6 bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-inner">
                                <div class="grid grid-cols-12 items-center gap-4">

                                    <div
                                        class="col-span-4 flex flex-col items-center justify-center border-r border-slate-100 dark:border-slate-700 pr-4">
                                        <p class="text-slate-400 text-[10px] uppercase font-black tracking-tighter mb-1">
                                            Hemat</p>
                                        <div class="text-4xl font-black text-green-600 dark:text-green-400 tracking-tighter"
                                            x-text="savings"></div>
                                    </div>

                                    <div class="col-span-8 flex justify-around items-center pl-2">
                                        <div class="text-center">
                                            <p class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Awal
                                            </p>
                                            <p class="text-slate-600 dark:text-slate-300 text-lg font-black"
                                                x-text="oldSize"></p>
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-blue-500 animate-pulse" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </div>

                                        <div class="text-center">
                                            <p class="text-blue-500 text-[10px] uppercase font-bold tracking-widest">
                                                Sekarang</p>
                                            <p class="text-blue-600 dark:text-blue-400 text-2xl font-black"
                                                x-text="newSize"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <a :href="downloadUrl" download
                                class="w-full py-4 px-6 bg-green-600 text-white font-bold rounded-2xl shadow-lg shadow-green-600/20 hover:bg-green-700 transition-all flex items-center justify-center gap-2 text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download PDF Kecil
                            </a>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Footer Info --}}
            <div class="mt-8 text-center">
                <p class="text-xs text-slate-400 italic">* File otomatis dihapus dari server dalam waktu 1 jam untuk menjaga
                    privasi Anda.</p>
            </div>
        </div>

        {{-- Artikel Edukasi --}}
        <article class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-8 leading-tight text-center">
                    Mengapa Harus Mengompres PDF di <span class="text-blue-600">GaweDokumen?</span>
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <div
                        class="p-6 bg-slate-50 dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800">
                        <div
                            class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04 Pelajaran Penting7M12 21.35s-8-4.5-8-11.858V5a11.955 11.955 0 018-2.944 11.955 11.955 0 018 2.944v4.5c0 7.358-8 11.858-8 11.858z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-2">Keamanan Terjamin</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 line-height-relaxed">File Anda diproses
                            langsung di server kami tanpa melibatkan pihak ketiga. Privasi Anda adalah prioritas utama.</p>
                    </div>
                    <div
                        class="p-6 bg-slate-50 dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800">
                        <div
                            class="w-10 h-10 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-2">Optimasi Cerdas</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 line-height-relaxed">Menggunakan teknologi
                            Ghostscript untuk mengecilkan gambar tanpa merusak kejelasan teks.</p>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>

    {{-- Script Tetap Sama --}}
    <script>
        function pdfCompressor() {
            return {
                loading: false,
                result: false,
                oldSize: '',
                newSize: '',
                savings: '',
                downloadUrl: '',

                async handleFile(e) {
                    const file = e.target.files[0];
                    if (!file || file.type !== 'application/pdf') return;

                    const oldBytes = file.size;
                    this.loading = true;
                    this.result = false;
                    this.oldSize = (oldBytes / 1024 / 1024).toFixed(2) + ' MB';

                    const formData = new FormData();
                    formData.append('pdf_file', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    try {
                        const response = await fetch('{{ route('tool.kompres.pdf') }}', {
                            method: 'POST',
                            body: formData
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.downloadUrl = data.download_url;
                            this.newSize = data.new_size;

                            // HITUNG PERSENTASE DI SINI (Di dalam blok sukses)
                            if (data.new_size_bytes) {
                                const newBytes = data.new_size_bytes;
                                const diff = oldBytes - newBytes;
                                // Pastikan tidak bagi nol dan hasil tidak negatif
                                const percentage = diff > 0 ? Math.floor((diff / oldBytes) * 100) : 0;
                                this.savings = percentage + '%';
                            } else {
                                this.savings = '0%';
                            }

                            this.result = true;
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan koneksi ke server.');
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
@endpush
