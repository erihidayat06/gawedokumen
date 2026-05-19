@extends('layouts.app')

@section('content')
    <div class="py-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors">
        <div class="max-w-xl mx-auto px-4">

            {{-- Header Section --}}
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">Gabung PDF</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm md:text-base">
                    Gabungkan beberapa file PDF menjadi satu dokumen rapi secara instan.
                </p>
            </div>

            {{-- Form Container --}}
            <div
                class="w-full bg-white dark:bg-slate-900 rounded-2xl shadow-xl dark:shadow-2xl border border-slate-200 dark:border-slate-800 p-6 md:p-8 transition-all">

                {{-- Icon & Sub-Header Dalam Card --}}
                <div class="text-center mb-8">
                    <div
                        class="inline-flex p-3 bg-blue-500/10 rounded-xl text-blue-600 dark:text-blue-400 mb-3 border border-blue-500/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" />
                        </svg>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 font-semibold text-sm md:text-base">Pilih dan Urutkan File
                        PDF</p>
                </div>

                {{-- Alert Error Flash Laravel --}}
                @if (session('error'))
                    <div
                        class="mb-6 p-4 bg-red-500/10 border-l-4 border-red-500 text-red-600 dark:text-red-400 rounded-r-lg text-sm border-y border-r border-red-500/20">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validasi Error Form --}}
                @if ($errors->any())
                    <div
                        class="mb-6 p-4 bg-amber-500/10 border-l-4 border-amber-500 text-amber-600 dark:text-amber-400 rounded-r-lg text-sm border-y border-r border-amber-500/20">
                        <ul class="list-disc ml-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Utama --}}
                <form action="{{ route('tool.pdf.merge') }}" method="POST" enctype="multipart/form-data" id="pdfForm">
                    @csrf

                    {{-- Area Drag & Drop --}}
                    <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 rounded-xl p-8 text-center cursor-pointer transition-all bg-slate-50/50 dark:bg-slate-950/50 hover:bg-blue-50/20 dark:hover:bg-blue-950/20 relative group"
                        id="dropzone">
                        <input type="file" name="pdf_files[]" id="pdf_files" multiple accept="application/pdf"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>

                        <div class="space-y-4 pointer-events-none">
                            <svg class="w-12 h-12 text-slate-400 dark:text-slate-500 group-hover:text-blue-500 dark:group-hover:text-blue-400 mx-auto transition-colors duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <div class="space-y-1">
                                <p
                                    class="text-sm font-semibold text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-300 transition-colors">
                                    Klik untuk upload atau drag file PDF ke sini
                                </p>
                                <p class="text-xs text-slate-400 dark:text-slate-500">
                                    Pilih minimal 2 file atau lebih sekaligus (Maksimal 20MB per file)
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- List Preview Urutan File (Dikelola oleh JS) --}}
                    <div id="file-list" class="mt-8 space-y-3 hidden">
                        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-700 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Urutan
                                Penggabungan Dokumen:</h3>
                            <span id="file-count"
                                class="text-xs bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded-full font-medium">0
                                File</span>
                        </div>
                        <div id="list-container" class="space-y-2 max-h-60 overflow-y-auto pr-1 custom-scrollbar">
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" id="btnSubmit"
                        class="w-full mt-8 bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-600/10 dark:shadow-blue-600/20 transition-all flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="btnText">Gabungkan & Download PDF</span>
                        <svg id="btnIcon" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Footer Info --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-slate-400 dark:text-slate-500 italic">* File mentah langsung dibersihkan dari storage
                    setelah selesai digabungkan.</p>
            </div>
        </div>

        {{-- Bagian Edukasi/Tips di bawah Form Gabung PDF --}}
        <article class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-10 px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-8 leading-tight text-center">
                    Bagaimana Cara Menggabungkan PDF di GaweDokumen & Tips Merapikannya
                </h2>

                <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                    <div class="space-y-4">
                        <p>
                            Menyatukan berbagai dokumen terpisah menjadi satu file kini bisa dilakukan dalam hitungan detik.
                            Di
                            <strong>GaweDokumen</strong>, alat penggabung PDF kami dirancang untuk mempermudah Anda menyusun
                            berkas administrasi, lampiran lamaran kerja, atau laporan instansi secara praktis.
                        </p>
                        <p>
                            Cukup pilih atau seret (*drag and drop*) beberapa file PDF Anda ke dalam area unggahan. Urutan
                            penggabungan akan diproses berdasarkan daftar yang tampil di layar. Demi keamanan, file Anda
                            diproses secara instan di sistem internal kami dan <strong>langsung dihapus otomatis dari
                                server</strong> begitu proses unduh selesai.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">1. Pilih Dokumen</h3>
                            <p>
                                Klik tombol unggah dan pilih file-file PDF yang ingin disatukan. Anda bisa memilih dua atau
                                lebih file sekaligus. Pastikan kapasitas file yang diunggah masih dalam batas wajar agar
                                proses rendering berjalan lancar.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">2. Cek Urutan File</h3>
                            <p>
                                Perhatikan daftar file yang muncul di bawah input. File akan digabungkan berurutan mulai
                                dari nomor 1, 2, dan seterusnya. Jika ada dokumen yang salah pilih, Anda bisa menekan tombol
                                ikon tempat sampah di sebelah kanan file untuk menghapusnya sebelum digabung.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">3. Presisi Dimensi</h3>
                            <p>
                                Anda tidak perlu khawatir jika dokumen memiliki ukuran kertas yang berbeda-beda (misal
                                campuran antara A4 dan F4) atau orientasi yang beragam. Sistem kami akan membaca layout asli
                                setiap halaman secara otomatis tanpa merusak atau memotong teks.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">4. Proses & Download</h3>
                            <p>
                                Setelah daftar file sudah sesuai, klik tombol <span
                                    class="text-blue-600 font-medium">"Gabungkan & Download PDF"</span>. Tunggu beberapa
                                detik hingga sistem selesai merakit dokumen Anda, dan file PDF baru yang sudah menyatu akan
                                otomatis terunduh ke perangkat Anda.
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
                            Tips Menyusun Berkas Administrasi:
                        </h3>
                        <ul class="list-disc pl-5 space-y-3 text-sm text-blue-800/80 dark:text-blue-200/80">
                            <li><strong>Susun Berdasarkan Aturan:</strong> Jika untuk lamaran kerja atau pemberkasan
                                CPNS/PPPK, susun file sesuai urutan yang diminta instansi (misal: Surat Lamaran, CV, KTP,
                                Ijazah, lalu Sertifikat).</li>
                            <li><strong>Perhatikan Ukuran File:</strong> Menggabungkan banyak PDF akan membuat ukuran file
                                akhir membengkak. Pastikan total ukuran file hasil gabungan tidak melebihi batas maksimal
                                sistem portal tujuan Anda.</li>
                            <li><strong>Pastikan File Tidak Terkunci:</strong> Pastikan file PDF yang Anda unggah tidak
                                diberi password perlindungan (*password-protected*) agar sistem kami bisa membaca dan
                                menggabungkannya dengan sukses.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </article>

        {{-- FAQ KHUSUS GABUNG PDF --}}
        <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5 mb-12">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                    Pertanyaan Seputar <span class="text-blue-600">Gabung PDF</span>
                </h2>

                <div class="space-y-4" x-data="{ active: null }">

                    {{-- Item 1 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 1 ? active = 1 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                            <span class="font-bold text-slate-900 dark:text-white">Apakah ada batasan jumlah file PDF yang
                                bisa digabungkan?</span>
                            <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 1" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                            Tidak ada batasan jumlah file. Anda bebas memasukkan beberapa file sekaligus untuk disatukan,
                            selama total ukuran dokumen yang diunggah dalam satu kali proses tidak melebihi kapasitas memori
                            server.
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 2 ? active = 2 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                            <span class="font-bold text-slate-900 dark:text-white">Apakah urutan halaman PDF hasil gabungan
                                bisa berantakan?</span>
                            <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 2" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                            Tidak. Proses penggabungan berjalan presisi mengikuti urutan penomoran (indeks) yang tampil pada
                            daftar file di layar sebelum Anda menekan tombol gabung. Jika urutan belum pas, Anda bisa
                            menghapus dan memilih ulang file sesuai urutan yang benar.
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 3 ? active = 3 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                            <span class="font-bold text-slate-900 dark:text-white">Bagaimana keamanan dokumen penting yang
                                saya unggah?</span>
                            <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 3" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                            Privasi Anda aman 100%. Berkas mentah yang Anda unggah langsung diproses secara instan di sistem
                            internal dan langsung dihapus dari direktori temporary server. File hasil gabungan juga otomatis
                            dibersihkan seketika setelah Anda selesai mengunduhnya. Kami tidak menyimpan salinan berkas
                            Anda.
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>



@endsection

@push('scripts')
    <script>
        const fileInput = document.getElementById('pdf_files');
        const fileListDiv = document.getElementById('file-list');
        const listContainer = document.getElementById('list-container');
        const fileCountSpan = document.getElementById('file-count');
        const form = document.getElementById('pdfForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');

        // Variabel global untuk menyimpan array file yang aktif
        let selectedFiles = [];

        fileInput.addEventListener('change', function() {
            // Gabungkan file baru dimasukkan dengan file yang sudah ada (jika ingin akumulatif)
            // Atau jika ingin reset setiap pilih baru, gunakan: selectedFiles = Array.from(this.files);
            selectedFiles = Array.from(this.files);

            renderFileList();
        });

        // Fungsi pusat untuk me-render ulang UI daftar file
        function renderFileList() {
            listContainer.innerHTML = '';
            const totalFiles = selectedFiles.length;

            if (totalFiles > 0) {
                fileListDiv.classList.remove('hidden');
                fileCountSpan.textContent = `${totalFiles} File`;

                selectedFiles.forEach((file, index) => {
                    const fileSizeMb = (file.size / (1024 * 1024)).toFixed(2);
                    const itemRow = document.createElement('div');

                    itemRow.className =
                        'flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl transition-all hover:border-slate-300 dark:hover:border-slate-700 animate-fadeIn';
                    itemRow.innerHTML = `
                    <div class="flex items-center gap-3 overflow-hidden mr-4">
                        <span class="bg-blue-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full shrink-0 shadow-sm shadow-blue-600/30">${index + 1}</span>
                        <span class="truncate font-medium text-slate-700 dark:text-slate-200 text-sm">${file.name}</span>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-2 py-1 rounded-md">${fileSizeMb} MB</span>

                        <button type="button" onclick="removeFile(${index})" class="text-slate-400 hover:text-red-500 dark:text-slate-500 dark:hover:text-red-400 transition-colors p-1 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30" title="Hapus file ini">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                `;
                    listContainer.appendChild(itemRow);
                });

                // Sinkronisasikan array internal kita ke dalam elemen input file asli
                updateInputFileElement();
            } else {
                fileListDiv.classList.add('hidden');
                fileInput.value = ''; // Reset inputan jika kosong total
            }
        }

        // Fungsi untuk menghapus file berdasarkan indeksnya
        window.removeFile = function(index) {
            // Buang elemen array pada indeks terpilih
            selectedFiles.splice(index, 1);

            // Render ulang daftar tampilan
            renderFileList();
        }

        // Trik memanipulasi nilai objek FileList HTML yang Read-Only
        function updateInputFileElement() {
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            // Tembakkan data baru ke elemen input file agar backend Laravel menerima data ter-update
            fileInput.files = dataTransfer.files;
        }

        // Efek loading saat submit
        form.addEventListener('submit', function() {
            btnSubmit.disabled = true;
            btnText.textContent = 'Sedang Menggabungkan Dokumen...';
            setTimeout(() => {
                btnSubmit.disabled = false;
                btnText.textContent = 'Gabungkan & Download PDF';
            }, 5000);
        });
    </script>
@endpush
{{-- Bagian style ditaruh di luar/bisa dipindah ke CSS utama --}}
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #475569;
        border-radius: 9999px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out forwards;
    }
</style>
