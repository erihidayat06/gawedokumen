@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/lamaranPekerjaan.css">
    <div class="mb-8 text-center px-4 mt-28">
        <span
            class="inline-block px-3 py-1 mb-3 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full dark:bg-slate-800 dark:text-blue-400">
            Portfolio Builder
        </span>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Bangun Portofolio <span class="text-blue-600">Memukau</span>
        </h1>

        <div class="mt-3 max-w-2xl mx-auto">
            <p class="text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Pamerkan karya terbaik Anda dengan tata letak modern dan profesional. Isi data proyek, dan biarkan <span
                    class="font-semibold italic">Gawe Dokumen</span> menyusun portofolio impian Anda.
            </p>
        </div>

        <div class="mt-4 flex justify-center items-center space-x-2 text-sm text-slate-400 italic">
            {{-- Ikon Magic/Sparkles untuk merepresentasikan pembuatan karya/portofolio --}}
            <svg class="w-4 h-4 text-blue-500 animate-pulse" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.813 15.904L9 21l-.813-5.096L3 15l5.096-.813L9 9l.813 5.096L15 15l-5.187.904zM19.071 4.929l-.707 1.414-1.414.707 1.414.707.707 1.414.707-1.414 1.414-.707-1.414-.707-.707-1.414z" />
            </svg>
            <span>Tunjukkan potensi terbaik Anda kepada klien dan perusahaan impian.</span>
        </div>

        <div class="mt-6 w-24 h-1 bg-blue-600 mx-auto rounded-full opacity-20"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-5">

        @php
            $tabs = [['id' => 'Portofolio', 'label' => 'Portofolio & Karya']];

            $portfolioFields = [
                [
                    'id' => 'projek-nama',
                    'label' => 'Judul Karya / Projek',
                    'type' => 'text',
                    'placeholder' => 'Contoh: Desain Interior Rumah, Buku Novel "Senja", Campaign Ramadhan',
                ],
                [
                    'id' => 'projek-peran',
                    'label' => 'Peran / Posisi Anda',
                    'type' => 'text',
                    'placeholder' => 'Contoh: Fotografer, Penulis Konten, Manajer Projek, Arsitek',
                ],
                [
                    'id' => 'projek-tech',
                    'label' => 'Kategori / Keahlian / Alat yang Digunakan',
                    'type' => 'text',
                    'placeholder' => 'Contoh: Adobe Photoshop, Copywriting, Manajemen Tim (pisahkan dengan koma)',
                ],
                [
                    'id' => 'projek-tanggal',
                    'label' => 'Waktu Pelaksanaan / Pengerjaan',
                    'type' => 'text',
                    'placeholder' => 'Contoh: Jan 2026 - Mar 2026 atau Selesai Mei 2026',
                ],
                [
                    'id' => 'projek-link',
                    'label' => 'Link Tautan Berkas / Portofolio (URL)',
                    'type' => 'url',
                    'placeholder' => 'Contoh: https://behance.net/... atau https://drive.google.com/...',
                ],
                [
                    'id' => 'projek-gambar',
                    'label' => 'Upload Foto Karya / Mockup Dokumen',
                    'type' => 'file',
                    'placeholder' => '',
                ],
                [
                    'id' => 'projek-deskripsi',
                    'label' => 'Deskripsi Detail Karya',
                    'type' => 'textarea',
                    'placeholder' =>
                        'Jelaskan latar belakang, proses pengerjaan, hasil pencapaian, atau masalah yang berhasil Anda selesaikan...',
                ],
            ];
        @endphp

        <div class="order-1 md:order-2 p-5 bg-white border rounded-xl flex flex-col h-[700px]">
            <h3 class="font-bold border-b pb-2 text-gray-700">Form Input Portofolio</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gaya Tulisan Dokumen</label>
                <select id="font-selector" onchange="changeDocFont(this.value)"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none bg-white transition-all">
                    <option value="font-serif">Times New Roman / Serif (Sangat Formal)</option>
                    <option value="font-sans" selected>Arial / Figtree (Modern & Bersih)</option>
                    <option value="font-mono">Courier / Mono (Teknis/Laporan)</option>
                    <option value="font-georgia">Georgia (Elegan & Mudah Dibaca)</option>
                </select>
            </div>
            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                @foreach ($tabs as $index => $tab)
                    <button onclick="openTab(event, '{{ $tab['id'] }}')"
                        class="tab-link py-2 px-4 text-sm font-medium border-b-2 {{ $index == 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500' }} hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="flex-1 overflow-y-auto pr-1 scrollbar-thin space-y-6">
                <div id="Portofolio" class="tab-content">

                    <div id="project-container" class="space-y-6">

                        <div class="project-item p-4 border border-slate-200 rounded-xl bg-slate-50 relative"
                            data-index="1">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 header-index">
                                    Portofolio #1
                                </span>
                                <button type="button" onclick="hapusProjek(this)"
                                    class="btn-hapus hidden text-xs text-red-500 hover:text-red-700 font-medium">
                                    ✕ Hapus Portofolio
                                </button>
                            </div>

                            <div class="space-y-4">
                                @foreach ($portfolioFields as $field)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ $field['label'] }}
                                        </label>

                                        @if ($field['type'] === 'textarea')
                                            <textarea name="projek[1][{{ $field['id'] }}]"
                                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm"
                                                rows="3" placeholder="{{ $field['placeholder'] }}" oninput="updatePreview()"></textarea>
                                        @elseif ($field['type'] === 'file')
                                            <div class="flex items-center gap-4">
                                                <input type="file" name="projek[1][{{ $field['id'] }}]" accept="image/*"
                                                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer hover:file:bg-blue-100"
                                                    onchange="handleProjectImage(this)">

                                                <input type="hidden" name="projek[1][projek-gambar-base64]"
                                                    class="image-base64-holder">

                                                <div
                                                    class="form-img-preview hidden w-12 h-12 rounded border overflow-hidden flex-shrink-0 bg-gray-100 relative">
                                                    <img src="" class="w-full h-full object-cover">
                                                    <button type="button" onclick="removeProjectImage(this)"
                                                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-bl">✕</button>
                                                </div>
                                            </div>
                                        @else
                                            <input type="{{ $field['type'] }}" name="projek[1][{{ $field['id'] }}]"
                                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm"
                                                placeholder="{{ $field['placeholder'] }}" oninput="updatePreview()">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <button type="button" onclick="tambahProjek()"
                        class="w-full mt-4 py-2.5 border-2 border-dashed border-blue-400 text-blue-600 hover:bg-blue-50 rounded-lg font-medium text-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Portofolio Baru
                    </button>

                </div>
            </div>
        </div>
        <div
            class="order-2 md:order-1 w-full h-[500px] md:h-[700px] border bg-gray-300 overflow-hidden relative touch-none flex justify-center items-start rounded-xl">
            <div
                class="absolute z-10 flex gap-1 sm:gap-2 p-1.5 sm:p-2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 mt-2 ml-2 transition-all">

                <button id="zoom-in" title="Perbesar"
                    class="p-1.5 sm:p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                    </svg>
                </button>

                <button id="zoom-out" title="Perkecil"
                    class="p-1.5 sm:p-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7" />
                    </svg>
                </button>

                <button id="reset" title="Reset Tampilan"
                    class="p-1.5 sm:p-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>

                <div class="w-px h-5 sm:h-6 bg-slate-300 dark:bg-slate-600 self-center mx-0.5 sm:mx-1"></div>

                <button id="print" title="Cetak Dokumen"
                    class="p-1.5 sm:p-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </button>
            </div>
            <div class="w-full h-[750px] overflow-y-auto overflow-x-auto flex flex-col items-center bg-slate-100 p-4">

                <div id="panzoom-element-porto" class="origin-top transition-transform duration-200">
                </div>

            </div>
        </div>

    </div>

    @include('pekerja.tamplate.print_modal')

    <div class="mx-5">
        <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm text-blue-800 font-medium">Jaminan Privasi</span>
            </div>
            <p class="text-xs text-blue-600 mt-1">
                Data karya dan informasi pribadi yang Anda masukkan tidak disimpan di server kami. Kami menggunakan
                teknologi penyimpanan lokal agar data portofolio Anda tetap aman di perangkat Anda sendiri.
            </p>
        </div>
    </div>

    {{-- Bagian Edukasi/Tips di bawah Form --}}
    <article class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-10 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-8 leading-tight text-center">
                Bagaimana Cara Membuat Portofolio di GaweDokumen & Tips Mengisinya
            </h2>

            <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <div class="space-y-4">
                    <p>
                        Membangun portofolio profesional yang memikat klien kini jauh lebih mudah. Di
                        <strong>GaweDokumen</strong>, kami menyediakan struktur modern yang menonjolkan keahlian dan proyek
                        terbaik Anda. Cukup masukkan profil singkat, daftar keahlian, dan dokumentasi karya Anda.
                    </p>
                    <p>
                        Isilah formulir dengan teliti. Setiap data, deskripsi proyek, dan tautan yang Anda masukkan akan
                        otomatis muncul pada <strong>preview dokumen</strong> secara real-time. Demi keamanan, semua aset
                        teks dan konfigurasi Anda hanya akan tersimpan di dalam browser (Local Storage) dan <strong>tidak
                            akan pernah dikirim ke server kami</strong>.
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">1. Layout & Tipografi</h3>
                        <p>
                            Pilih gaya tulisan dan tata letak yang mencerminkan bidang industri Anda. Untuk kesan formal,
                            font seperti Inter atau Roboto sangat disarankan, sementara industri kreatif dapat
                            mengeksplorasi pilihan font yang lebih dinamis.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">2. Profil Singkat (About Me)</h3>
                        <p>
                            Tuliskan ringkasan profesional yang padat mengenai siapa Anda, keahlian utama, dan nilai jual
                            yang Anda tawarkan. Bagian ini adalah hal pertama yang akan dibaca oleh perekrut atau calon
                            klien potensial Anda.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">3. Pengalaman & Detail Proyek
                        </h3>
                        <p>
                            Masukkan daftar proyek terbaik yang pernah Anda kerjakan. Jelaskan peran Anda, teknologi atau
                            alat yang digunakan, serta dampak atau hasil akhir dari proyek tersebut. Hindari memasukkan
                            terlalu banyak proyek kecil; kurasi hanya karya terbaik Anda.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">4. Tautan Luar (Live Preview /
                            Repositori)</h3>
                        <p>
                            Sertakan tautan aktif menuju proyek asli Anda, seperti link website, repositori GitHub, Behance,
                            atau Google Drive. Pastikan tautan dapat diakses publik agar calon klien bisa langsung
                            memvalidasi hasil kerja Anda.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">5. Kontak & Call to Action (CTA)
                        </h3>
                        <p>
                            Pastikan email, nomor WhatsApp, atau LinkedIn yang dicantumkan sudah benar dan aktif. Setelah
                            semua komponen terisi, portofolio Anda siap diunduh dalam format PDF atau dibagikan dalam bentuk
                            tautan digital siap pakai.
                        </p>
                    </div>
                </div>

                {{-- Tips Card --}}
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 p-8 rounded-[2rem] border border-blue-100 dark:border-blue-800/50">
                    <h3 class="font-bold text-blue-900 dark:text-blue-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tips Biar Portofolio Dilirik Klien:
                    </h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm text-blue-800/80 dark:text-blue-200/80">
                        <li><strong>Kualitas > Kuantitas:</strong> Lebih baik menampilkan 3 proyek luar biasa dengan
                            penjelasan detail daripada 10 proyek biasa tanpa konteks yang jelas.</li>
                        <li><strong>Tunjukkan Proses Kerja:</strong> Perekrut menyukai penyelesaian masalah. Jelaskan
                            singkat tantangan yang Anda hadapi dan bagaimana Anda menyelesaikannya.</li>
                        <li><strong>Periksa Tautan Rusak:</strong> Pastikan semua link proyek eksternal berfungsi dengan
                            baik. Tautan yang rusak (broken link) dapat mengurangi nilai profesionalisme Anda.</li>
                    </ul>
                </div>
            </div>
        </div>
    </article>

    {{-- FAQ KHUSUS PORTOFOLIO --}}
    <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                Pertanyaan Seputar <span class="text-blue-600">Portofolio Digital</span>
            </h2>

            <div class="space-y-4" x-data="{ active: null }">

                {{-- Item 1 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 1 ? active = 1 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apakah format portofolio ini bisa dibaca
                            oleh sistem ATS?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Ya. Jika Anda mengunduhnya dalam format PDF, kami menjaga struktur teks tetap bersih dan
                        *selectable* (bisa diblok), sehingga informasi keahlian dan pengalaman Anda dapat dipindai dengan
                        sempurna oleh sistem ATS korporat.
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 2 ? active = 2 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Berapa banyak proyek yang idealnya saya
                            masukkan?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Untuk hasil terbaik, pilihlah sekitar 3 hingga 5 proyek paling relevan dan berskala besar yang
                        menunjukkan kemampuan terbaik Anda secara komprehensif.
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 3 ? active = 3 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Bagaimana cara memasukkan gambar tangkapan
                            layar (screenshot) proyek?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Anda bisa langsung mengunggah file gambar (format .png atau .jpg) mockup aplikasi/desain Anda pada
                        slot media proyek yang tersedia. <strong>Tips:</strong> Kompres gambar terlebih dahulu agar ukuran
                        dokumen final tidak terlalu besar namun tetap tajam.
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="/js/gawedokumen.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elem = document.getElementById('panzoom-element-porto');
            const parent = elem.parentElement;

            if (typeof Panzoom !== 'undefined' && elem) {
                const isDesktop = window.innerWidth >= 768;

                const desktopScale = 0.6;
                const mobileScale = 0.45;

                const panzoom = Panzoom(elem, {
                    maxScale: 3,
                    minScale: 0.1,
                    canvas: true,
                    startScale: isDesktop ? desktopScale : mobileScale,
                    cursor: 'default',
                    disablePan: true, // Matikan seret agar murni scroll biasa
                    touchAction: 'auto' // Kembalikan kontrol geser ke browser
                });

                // Set transform origin di tengah atas dan beri ruang margin agar rapi
                elem.style.transformOrigin = 'top center';
                elem.style.margin = '50px';

                // KUNCI UTAMA: Memaksa parent memunculkan scrollbar sesuai tinggi riil konten
                const sesuaikanTinggiContainer = (scale) => {
                    if (parent) {
                        // Gunakan scrollHeight (tinggi murni konten tanpa efek transform skala)
                        const tinggiAsli = elem.scrollHeight;

                        // Hitung tinggi visual setelah di-zoom
                        const tinggiHasilZoom = tinggiAsli * scale;

                        // Paksa tinggi parent mengikuti hasil zoom + ruang tambahan di bawahnya
                        parent.style.height = '750px'; // Sesuai tinggi container visualmu
                        parent.style.overflowY =
                            'auto'; // Paksa scrollbar vertikal aktif jika melebihi container

                        // Buat elemen pembungkus dalam (jika ada) atau elemen itu sendiri memanjang kebawah
                        elem.style.minHeight = `${tinggiAsli}px`;
                    }
                };

                const setPresisi = () => {
                    const currentScale = isDesktop ? desktopScale : mobileScale;
                    panzoom.zoom(currentScale);
                    // Beri jeda sedikit agar DOM selesai menghitung scrollHeight dokumen
                    setTimeout(() => sesuaikanTinggiContainer(currentScale), 150);
                };

                // Jalankan otomatis saat awal dimuat
                setTimeout(setPresisi, 200);

                // Tombol Reset
                const btnReset = document.getElementById('reset');
                if (btnReset) {
                    btnReset.addEventListener('click', () => {
                        setPresisi();
                        if (parent) parent.scrollTop = 0;
                    });
                }

                // Tombol Zoom In & Zoom Out
                const btnZoomIn = document.getElementById('zoom-in');
                const btnZoomOut = document.getElementById('zoom-out');

                if (btnZoomIn) {
                    btnZoomIn.addEventListener('click', () => {
                        panzoom.zoomIn();
                        setTimeout(() => sesuaikanTinggiContainer(panzoom.getScale()), 100);
                    });
                }
                if (btnZoomOut) {
                    btnZoomOut.addEventListener('click', () => {
                        panzoom.zoomOut();
                        setTimeout(() => sesuaikanTinggiContainer(panzoom.getScale()), 100);
                    });
                }
            }
        });
    </script>
    <script>
        // ==========================================
        // VARIABLES & GLOBAL STATES
        // ==========================================
        let printTimer = null;
        let preparedData = {};
        let projectCount = 1;

        // ==========================================
        // 1. EVENT LISTENERS & DATA BINDING PRINT
        // ==========================================

        // Event Listener Tombol Print Utama
        document.getElementById('print').addEventListener('click', function() {
            const modal = document.getElementById('printAdModal');
            const timerDigit = document.getElementById('adTimer');
            const timerSpan = document.getElementById('adTimerSpan');
            const btnText = document.getElementById('btnText');
            const btnPrint = document.getElementById('btnRealPrint');
            const loading = document.getElementById('loadingState');
            const ready = document.getElementById('readyState');

            // Mengambil tanda tangan / TTD (jika ada)
            const rawTTD = document.getElementById('preview-foto')?.classList.contains('hidden') ? null : document
                .getElementById('preview-foto')?.src;

            // --- RESET STATE ---
            if (printTimer) clearInterval(printTimer);
            let timeLeft = 5;

            modal.classList.remove('hidden');
            loading.classList.remove('hidden');
            ready.classList.add('hidden');

            btnPrint.disabled = true;
            btnText.innerText = "Tunggu ";
            timerDigit.innerText = timeLeft;
            timerSpan.classList.remove('hidden');
            btnPrint.className =
                "w-full py-4 bg-slate-200 text-slate-400 font-bold rounded-2xl transition-all cursor-not-allowed flex items-center justify-center gap-1";

            // --- AMBIL DATA KARYA / PROJEK MULTI-PROFESI ---
            const projectItems = document.querySelectorAll('#project-container .project-item');
            let listProjek = [];

            projectItems.forEach(item => {
                const index = item.getAttribute('data-index');

                // Mengambil semua value field secara fleksibel
                const nama = item.querySelector(`[name="projek[${index}][projek-nama]"]`)?.value || "";
                const peran = item.querySelector(`[name="projek[${index}][projek-peran]"]`)?.value || "";
                const tech = item.querySelector(`[name="projek[${index}][projek-tech]"]`)?.value || "";
                const tanggal = item.querySelector(`[name="projek[${index}][projek-tanggal]"]`)?.value ||
                    "";
                const link = item.querySelector(`[name="projek[${index}][projek-link]"]`)?.value || "";
                const gambar = item.querySelector('.image-base64-holder')?.value || "";
                const deskripsi = item.querySelector(`[name="projek[${index}][projek-deskripsi]"]`)
                    ?.value || "";

                // Validasi: Masukkan ke list jika minimal judul/nama karya diisi
                if (nama.trim() !== "") {
                    listProjek.push({
                        nama,
                        peran,
                        tech,
                        tanggal,
                        link,
                        gambar,
                        deskripsi
                    });
                }
            });

            // Jika kosong, berikan array berisi data placeholder umum (Agnostik)
            if (listProjek.length === 0) {
                listProjek.push({
                    nama: "Judul Karya / Projek (Belum diisi)",
                    peran: "",
                    tech: "",
                    tanggal: "",
                    link: "#",
                    gambar: "",
                    deskripsi: "Deskripsi detail mengenai karya, pencapaian, atau projek yang telah diselesaikan."
                });
            }

            // --- SIAPKAN DATA UNTUK DIKIRIM KE CONTROLLER ---
            preparedData = {
                _token: "{{ csrf_token() }}",
                font_style: document.getElementById('font-selector')?.value || 'font-sans',
                ttd_align: document.getElementById('ttd-align-selector')?.value || 'items-end',
                projek_data: JSON.stringify(listProjek),
                ttd_base64: rawTTD
            };

            if (rawTTD && typeof compressSignature === 'function') {
                compressSignature(rawTTD).then(compressed => {
                    preparedData.ttd_base64 = compressed;
                    console.log("TTD berhasil dikompres!");
                });
            }

            // --- JALANKAN COUNTDOWN MODAL ---
            printTimer = setInterval(() => {
                timeLeft--;

                if (timeLeft >= 0) {
                    timerDigit.innerText = timeLeft;
                }

                if (timeLeft <= 0) {
                    clearInterval(printTimer);

                    loading.classList.add('hidden');
                    ready.classList.remove('hidden');

                    btnText.innerText = "Cetak Sekarang";
                    timerSpan.classList.add('hidden');

                    btnPrint.disabled = false;
                    btnPrint.className =
                        "w-full py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition-all active:scale-95 cursor-pointer flex items-center justify-center";
                    btnPrint.onclick = finalExecutePrint;
                }
            }, 1000);
        });

        // Restore data dari localStorage saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const savedPortfolio = JSON.parse(localStorage.getItem("storage_portfolio_data"));
            const container = document.getElementById('project-container');

            // Ambil elemen pertama sebagai cetakan utama struktur form
            const blueprint = container.querySelector('.project-item');
            if (!blueprint) return;

            if (savedPortfolio && savedPortfolio.length > 0) {
                container.innerHTML = ''; // Kosongkan elemen default bawaan halaman

                savedPortfolio.forEach((data, index) => {
                    const currentIdx = index + 1;
                    const clone = blueprint.cloneNode(true);

                    clone.setAttribute('data-index', currentIdx);

                    // Ubah teks header menjadi lebih netral ("Item #1" atau "Portofolio #1")
                    const headerEl = clone.querySelector('.header-index');
                    if (headerEl) headerEl.innerText = `Portofolio #${currentIdx}`;

                    // Atur tombol hapus baris
                    const btnHapus = clone.querySelector('.btn-hapus');
                    if (btnHapus) {
                        if (currentIdx === 1) btnHapus.classList.add('hidden');
                        else btnHapus.classList.remove('hidden');
                    }

                    // Pengisian otomatis nilai input berdasarkan key dari localStorage
                    const inputs = clone.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        const oldName = input.getAttribute('name');
                        if (oldName) {
                            const newName = oldName.replace(/projek\[\d+\]/,
                                `projek[${currentIdx}]`);
                            input.setAttribute('name', newName);

                            const fieldMatch = oldName.match(/\[projek-([^\]]+)\]$/);
                            if (fieldMatch) {
                                const dataKey = fieldMatch[1];

                                if (input.type === 'file') {
                                    input.value = '';
                                } else if (input.classList.contains('image-base64-holder')) {
                                    input.value = data.gambar || '';
                                } else {
                                    input.value = data[dataKey] || '';
                                }
                            }
                        }
                    });

                    // Handler preview thumbnail gambar di form jika ada datanya
                    const formImgPreview = clone.querySelector('.form-img-preview');
                    if (formImgPreview) {
                        const base64Data = data.gambar || '';
                        if (base64Data) {
                            formImgPreview.querySelector('img').src = base64Data;
                            formImgPreview.classList.remove('hidden');
                        } else {
                            formImgPreview.classList.add('hidden');
                            formImgPreview.querySelector('img').src = '';
                        }
                    }

                    container.appendChild(clone);
                });
            }

            reindexProjek();
            updatePreview();
        });


        // ==========================================
        // 2. MANAGEMENT FORM PORTOFOLIO (CRUD DOM)
        // ==========================================

        // Tambah Baris Portofolio Baru
        function tambahProjek() {
            const container = document.getElementById('project-container');
            const items = container.querySelectorAll('.project-item');

            projectCount = items.length + 1;

            const firstItem = items[0];
            if (!firstItem) return;

            const newItem = firstItem.cloneNode(true);

            newItem.setAttribute('data-index', projectCount);

            const headerEl = newItem.querySelector('.header-index');
            if (headerEl) headerEl.innerText = `Portofolio #${projectCount}`;

            const btnHapus = newItem.querySelector('.btn-hapus');
            if (btnHapus) btnHapus.classList.remove('hidden');

            // Reset value input baris baru
            const inputs = newItem.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                if (input.type === 'file') input.value = '';
                else if (input.classList.contains('image-base64-holder')) input.value = '';
                else input.value = '';

                const oldName = input.getAttribute('name');
                if (oldName) {
                    const newName = oldName.replace(/projek\[\d+\]/, `projek[${projectCount}]`);
                    input.setAttribute('name', newName);
                }
            });

            const newFormImgPreview = newItem.querySelector('.form-img-preview');
            if (newFormImgPreview) {
                newFormImgPreview.classList.add('hidden');
                const imgTag = newFormImgPreview.querySelector('img');
                if (imgTag) imgTag.src = '';
            }

            container.appendChild(newItem);
            updatePreview();
        }

        // Hapus Baris Portofolio
        function hapusProjek(button) {
            button.closest('.project-item').remove();
            reindexProjek();
            updatePreview();
        }

        // Mengatur ulang index penamaan `name="projek[x]"` secara dinamis
        function reindexProjek() {
            const items = document.querySelectorAll('#project-container .project-item');
            projectCount = 0;

            items.forEach((item, index) => {
                projectCount = index + 1;
                item.setAttribute('data-index', projectCount);

                const headerEl = item.querySelector('.header-index');
                if (headerEl) headerEl.innerText = `Portofolio #${projectCount}`;

                const btnHapus = item.querySelector('.btn-hapus');
                if (btnHapus) {
                    if (items.length === 1) btnHapus.classList.add('hidden');
                    else if (projectCount > 1) btnHapus.classList.remove('hidden');
                }

                const inputs = item.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const oldName = input.getAttribute('name');
                    if (oldName) {
                        const newName = oldName.replace(/projek\[\d+\]/, `projek[${projectCount}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }


        // ==========================================
        // 3. LOGIKA GRAPHIC / FILE ATTACHMENT
        // ==========================================
        function handleProjectImage(input) {
            const file = input.files[0];
            const parentDiv = input.closest('.flex');

            // Pastikan selector ini sesuai dengan atribut name/class di elemen kamu
            const base64Holder = parentDiv.querySelector('.image-base64-holder') || parentDiv.querySelector(
                'input[type="hidden"]');
            const formImgPreview = parentDiv.querySelector('.form-img-preview');
            const imgTag = formImgPreview.querySelector('img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;

                    img.onload = function() {
                        // --- PROSES KOMPRESI MENGGUNAKAN CANVAS ---
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        // Tentukan maksimal resolusi lebar (1000px sudah sangat tajam untuk cetak A4 berukuran 500px)
                        const MAX_WIDTH = 1000;
                        let width = img.width;
                        let height = img.height;

                        // Hitung rasio aspek gambar secara proporsional agar tidak gepeng
                        if (width > MAX_WIDTH) {
                            height = Math.round((height * MAX_WIDTH) / width);
                            width = MAX_WIDTH;
                        }

                        // Set ukuran canvas sesuai hasil hitung proporsional
                        canvas.width = width;
                        canvas.height = height;

                        // Gambar ulang foto asli ke dalam canvas dengan dimensi baru
                        ctx.drawImage(img, 0, 0, width, height);

                        // Ubah canvas menjadi string Base64 format JPEG dengan kualitas 75% (0.75)
                        // Format JPEG jauh lebih ringan untuk kompresi foto dibanding PNG mentah
                        const compressedBase64 = canvas.toDataURL('image/jpeg', 0.75);

                        // --- MASUKKAN DATA HASIL KOMPRESI KE DOM ---
                        base64Holder.value = compressedBase64;
                        imgTag.src = compressedBase64;
                        formImgPreview.classList.remove('hidden');

                        // Jalankan fungsi live preview utama kamu
                        updatePreview();
                    };
                };
                reader.readAsDataURL(file);
            }
        }

        function removeProjectImage(button) {
            const parentDiv = button.closest('.flex');
            const fileInput = parentDiv.querySelector('input[type="file"]');
            const base64Holder = parentDiv.querySelector('.image-base64-holder');
            const formImgPreview = parentDiv.querySelector('.form-img-preview');

            fileInput.value = "";
            base64Holder.value = "";
            formImgPreview.classList.add('hidden');
            const imgTag = formImgPreview.querySelector('img');
            if (imgTag) imgTag.src = '';

            updatePreview();
        }


        // ==========================================
        // 4. LIVE PREVIEW RENDERER UNIVERSAL (A4)
        // ==========================================

        function updatePreview() {
            const items = document.querySelectorAll('#project-container .project-item');
            const panzoomElement = document.getElementById('panzoom-element-porto');
            if (!panzoomElement) return;

            let dataPortofolio = [];
            items.forEach(item => {
                const index = item.getAttribute('data-index');

                const nama = item.querySelector(`[name="projek[${index}][projek-nama]"]`)?.value || "";
                const peran = item.querySelector(`[name="projek[${index}][projek-peran]"]`)?.value || "";
                const tech = item.querySelector(`[name="projek[${index}][projek-tech]"]`)?.value || "";
                const tanggal = item.querySelector(`[name="projek[${index}][projek-tanggal]"]`)?.value || "";
                const link = item.querySelector(`[name="projek[${index}][projek-link]"]`)?.value || "";
                const gambar = item.querySelector('.image-base64-holder')?.value || "";
                const deskripsi = item.querySelector(`[name="projek[${index}][projek-deskripsi]"]`)?.value || "";

                dataPortofolio.push({
                    nama,
                    peran,
                    tech,
                    tanggal,
                    link,
                    gambar,
                    deskripsi
                });
            });

            localStorage.setItem("storage_portfolio_data", JSON.stringify(dataPortofolio));

            panzoomElement.innerHTML = '';
            const projekValid = dataPortofolio.filter(p => p.nama.trim() !== "");

            let halamanKe = 2;
            let projekDiHalamanIni = 0;

            let htmlKontenHalaman = `
        <div class="jarak-paragraf text-center text-xl font-semibold mb-6 text-slate-800 tracking-wide uppercase">
            Portofolio Karya & Projek
        </div>
    `;

            projekValid.forEach((p, idx) => {
                // --- DESAIN AGNOSTIK (UNIVERSAL UNTUK SEMUA PROFESI) ---
                let metadataBadges = [];
                if (p.peran.trim() !== "") metadataBadges.push(
                    `<span class="font-semibold text-slate-700">${p.peran}</span>`);
                if (p.tech.trim() !== "") metadataBadges.push(`<span>${p.tech}</span>`);

                const metadataHTML = metadataBadges.length > 0 ?
                    `<div class="text-xs text-slate-500 mb-2 flex flex-wrap gap-x-2 items-center">${metadataBadges.join('<span class="text-slate-300">•</span>')}</div>` :
                    '';

                // Tentukan batas max-height gambar: halaman 1 (eksklusif) bisa lebih besar dibanding halaman berikutnya
                const imgMaxHeight = (halamanKe === 1) ? 'max-h-[22rem]' : 'max-h-[15rem]';

                htmlKontenHalaman += `
            <div class="mb-6 border-b pb-5 last:border-0 text-justify">
                <div class="flex justify-between items-start mb-1">
                    <h4 class="font-bold text-lg text-slate-800 leading-snug">${p.nama}</h4>
                    ${p.tanggal ? `<span class="text-xs font-medium text-slate-400 whitespace-nowrap ml-4 bg-slate-50 px-2 py-0.5 rounded border border-slate-100">${p.tanggal}</span>` : ''}
                </div>

                ${metadataHTML}

                ${p.link ? `<a href="${p.link}" target="_blank" class="text-xs text-blue-500 hover:text-blue-600 underline block mb-2 break-all font-mono">${p.link}</a>` : ''}
              ${p.gambar ? `<img src="${p.gambar}" class="w-[450px] mx-auto block ${imgMaxHeight} synchronized-img object-cover my-3 rounded-xl border border-slate-200/60 shadow-sm" alt="Preview Karya">` : ''}
                <p class="text-sm text-slate-600 whitespace-pre-line leading-relaxed mt-2">${p.deskripsi || 'Tidak ada deskripsi detail.'}</p>
            </div>
        `;

                projekDiHalamanIni++;

                // --- LOGIKA PEMBATASAN DINAMIS ---
                // Aturan 1: Jika ini Halaman 1, maksimal 1 projek.
                // Aturan 2: Jika ini Halaman 2 dan seterusnya, maksimal 2 projek.
                const apakahBatasHalamanSatu = (halamanKe === 1 && projekDiHalamanIni === 1);
                const apakahBatasHalamanBerikutnya = (halamanKe > 1 && projekDiHalamanIni === 2);
                const apakahProjekTerakhir = (idx + 1 === projekValid.length);

                if (apakahBatasHalamanSatu || apakahBatasHalamanBerikutnya || apakahProjekTerakhir) {
                    panzoomElement.innerHTML += createHalamanHTML(halamanKe, htmlKontenHalaman);

                    // Reset state untuk mempersiapkan halaman berikutnya
                    halamanKe++;
                    projekDiHalamanIni = 0;
                    htmlKontenHalaman = ''; // Kosongkan container HTML text untuk halaman baru
                }
            });
        }

        // Generator Element Kertas A4
        function createHalamanHTML(nomorHalaman, konten) {
            return `
            <div class="page-a4 bg-white shadow-2xl p-12 text-justify flex flex-col justify-between border border-slate-200 relative mb-4"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size: 11pt; font-family: inherit;">
                <div class="flex-1 overflow-hidden">${konten}</div>

            </div>
        `;
        }

        // Eksekutor Akhir Kirim Form Request PDF (Post Form Bypass)
        function finalExecutePrint() {
            closeAdModal();

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('pekerja.portofolio.pdf') }}";
            form.target = '_blank';

            for (const key in preparedData) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = preparedData[key];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }

        function closeAdModal() {
            document.getElementById('printAdModal').classList.add('hidden');
            if (printTimer) clearInterval(printTimer);
        }

        function changeDocFont(fontClass) {
            const kertas = document.getElementById('panzoom-element-porto');
            if (kertas) {
                const allFonts = ['font-serif', 'font-sans', 'font-mono', 'font-georgia'];
                allFonts.forEach(f => kertas.classList.remove(f));
                kertas.classList.add(fontClass);
                localStorage.setItem('selected_font', fontClass);
            }
        }
    </script>
@endpush
