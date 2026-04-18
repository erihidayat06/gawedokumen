@extends('layouts.app')

@section('content')
    <div class="py-24 bg-white dark:bg-slate-950 min-h-screen">
        <div class="max-w-xl mx-auto px-2">

            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">Tanda Tangan Digital</h1>
                <p class="text-slate-500 dark:text-slate-400">Buat tanda tangan transparan dengan kualitas HD.</p>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-blue-500/5">

                {{-- Toolbar Kontrol --}}
                <div
                    class="flex flex-wrap items-center justify-between gap-4 mb-6 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl">
                    {{-- Pilihan Warna --}}
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Warna:</span>
                        <button onclick="changeColor('#000000')"
                            class="w-8 h-8 rounded-full bg-black border-2 border-white dark:border-slate-700 shadow-sm hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('#0000FF')"
                            class="w-8 h-8 rounded-full bg-blue-700 border-2 border-white dark:border-slate-700 shadow-sm hover:scale-110 transition-transform"></button>
                    </div>

                    {{-- Slider Ketebalan --}}
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tebal:</span>
                        <input type="range" id="thickness" min="1" max="8" value="2"
                            class="w-24 h-1.5 bg-blue-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600">
                    </div>
                </div>

                {{-- Area Canvas --}}
                <div
                    class="relative bg-slate-50 dark:bg-slate-800 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
                    <canvas id="signature-pad" class="w-full h-72 cursor-crosshair touch-none"></canvas>
                </div>

                {{-- Tombol Aksi --}}
                <div class="grid grid-cols-2 gap-4">
                    <button id="clear"
                        class="py-4 px-6 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400 text-sm md:text-xl transition-all">
                        Hapus
                    </button>
                    <button id="save"
                        class="py-4 px-6 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all flex items-center justify-center gap-2 text-sm md:text-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </button>
                </div>
            </div>

            {{-- Info SEO/Edukasi --}}
            <div class="mt-12 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-500 italic">
                    * Hasil tanda tangan otomatis dipotong (Auto-Crop) dan memiliki latar belakang transparan.
                </p>
            </div>


        </div>
        <article class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-10 px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-8 leading-tight text-center">
                    Bagaimana Cara Membuat Tanda Tangan Digital di GaweDokumen?
                </h2>

                <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed text-base">
                    <div class="space-y-4">
                        <p>
                            Membuat tanda tangan di <strong>GaweDokumen</strong> adalah solusi praktis bagi Anda yang
                            membutuhkan aset digital secara instan. Tidak perlu lagi repot mencetak dokumen hanya untuk
                            membubuhkan tanda tangan basah, lalu memindainya (scan) kembali ke komputer.
                        </p>
                        <p>
                            Tool ini dirancang agar siapa saja bisa memiliki file tanda tangan berformat PNG transparan
                            dengan kualitas tajam, yang siap digunakan untuk berbagai keperluan administrasi seperti surat
                            lamaran kerja, nota, hingga dokumen PDF lainnya.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Langkah Mudah Menggunakan Signature
                            Generator</h3>
                        <ul class="list-decimal list-inside space-y-3">
                            <li>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Gunakan Area Canvas:</span>
                                Cukup gerakkan kursor mouse atau gunakan jari Anda jika mengakses melalui smartphone pada
                                kotak yang tersedia.
                            </li>
                            <li>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Atur Ketebalan &
                                    Warna:</span>
                                Gunakan slider untuk menyesuaikan tebal garis dan pilih warna tinta (hitam atau biru) agar
                                terlihat lebih natural.
                            </li>
                            <li>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Download Hasilnya:</span>
                                Klik tombol "Download PNG". Sistem akan otomatis melakukan <em>Auto-Crop</em> sehingga file
                                yang Anda dapatkan memiliki ukuran yang pas tanpa ruang kosong yang mengganggu.
                            </li>
                        </ul>
                    </div>

                    <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-3xl border border-blue-100 dark:border-blue-800">
                        <h4 class="text-blue-800 dark:text-blue-400 font-bold mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tips Hasil Maksimal
                        </h4>
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            Jika Anda membuat tanda tangan melalui HP, gunakan mode landscape (miring) agar area coretan
                            menjadi lebih luas dan Anda bisa berekspresi dengan lebih leluasa.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <p>
                            Dengan hadirnya fitur ini, kami berharap proses administrasi digital Anda menjadi lebih efisien.
                            Silakan gunakan tool ini secara gratis dan bagikan ke teman-teman yang membutuhkan!
                        </p>
                    </div>
                </div>
            </div>

        </article>

        {{-- SECTION FAQ SIGNATURE GENERATOR --}}
        <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 mb-20 px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                    Pertanyaan yang Sering <span class="text-blue-600">Diajukan</span>
                </h2>

                <div class="space-y-4" x-data="{ active: null }">

                    {{-- Item 1 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 1 ? active = 1 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all group">
                            <span
                                class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">Apakah
                                tanda tangan ini aman dan tidak disimpan di server?</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="active === 1 ? 'rotate-180 text-blue-600' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 1" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                            Sangat aman. Proses pembuatan tanda tangan dilakukan sepenuhnya di sisi browser (client-side).
                            GaweDokumen tidak mengirim atau menyimpan gambar tanda tangan Anda ke server kami. Begitu
                            halaman ditutup, data sementara tersebut akan hilang.
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 2 ? active = 2 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all group">
                            <span
                                class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">Kenapa
                                hasilnya transparan (format PNG)?</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="active === 2 ? 'rotate-180 text-blue-600' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 2" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                            Kami menggunakan format PNG transparan agar tanda tangan Anda bisa langsung ditempelkan di atas
                            teks atau garis dokumen (seperti file Word atau PDF) tanpa ada kotak putih yang mengganggu di
                            belakangnya.
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 3 ? active = 3 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all group">
                            <span
                                class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">Apakah
                                bisa digunakan di dokumen resmi?</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="active === 3 ? 'rotate-180 text-blue-600' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 3" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                            Bisa, untuk keperluan administrasi yang mengizinkan penggunaan tanda tangan elektronik (tanda
                            tangan scan). Namun, untuk dokumen yang memerlukan sertifikat digital resmi (E-Meterai/BSrE),
                            pastikan Anda mengikuti aturan instansi terkait.
                        </div>
                    </div>

                    {{-- Item 4 --}}
                    <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <button @click="active !== 4 ? active = 4 : active = null"
                            class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all group">
                            <span
                                class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">Bagaimana
                                jika hasil coretan saya berantakan?</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="active === 4 ? 'rotate-180 text-blue-600' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="active === 4" x-collapse
                            class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                            Anda cukup mengklik tombol "Hapus" untuk membersihkan area canvas dan mengulangi tanda tangan
                            sebanyak yang Anda inginkan sampai mendapatkan hasil yang paling pas.
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const thicknessSlider = document.getElementById('thickness');

        // Inisialisasi Signature Pad
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)', // Transparan
            penColor: '#000000',
            minWidth: 2,
            maxWidth: 2
        });

        // Handle Ketebalan
        thicknessSlider.addEventListener('input', () => {
            const val = parseFloat(thicknessSlider.value);
            signaturePad.minWidth = val;
            signaturePad.maxWidth = val;
        });

        // Fungsi Ganti Warna
        function changeColor(color) {
            signaturePad.penColor = color;
        }

        // Responsif Canvas
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        // Fungsi Hapus
        document.getElementById('clear').addEventListener('click', () => {
            signaturePad.clear();
        });

        // Fungsi Auto-Crop (Menghilangkan ruang kosong)
        function getTrimmedCanvas(canvas) {
            const context = canvas.getContext('2d');
            const imgWidth = canvas.width;
            const imgHeight = canvas.height;
            const imgData = context.getImageData(0, 0, imgWidth, imgHeight);
            let top = null,
                left = null,
                bottom = null,
                right = null;

            for (let i = 0; i < imgData.data.length; i += 4) {
                const alpha = imgData.data[i + 3];
                if (alpha > 0) {
                    const x = (i / 4) % imgWidth;
                    const y = ~~((i / 4) / imgWidth);

                    if (top === null || y < top) top = y;
                    if (left === null || x < left) left = x;
                    if (bottom === null || y > bottom) bottom = y;
                    if (right === null || x > right) right = x;
                }
            }

            if (top === null) return null;

            const trimmedCanvas = document.createElement('canvas');
            const trimmedContext = trimmedCanvas.getContext('2d');
            const trimmedWidth = right - left + 1;
            const trimmedHeight = bottom - top + 1;

            trimmedCanvas.width = trimmedWidth;
            trimmedCanvas.height = trimmedHeight;
            trimmedContext.drawImage(canvas, left, top, trimmedWidth, trimmedHeight, 0, 0, trimmedWidth, trimmedHeight);

            return trimmedCanvas;
        }

        // Fungsi Simpan dengan Auto-Crop
        document.getElementById('save').addEventListener('click', () => {
            if (signaturePad.isEmpty()) {
                alert("Silakan tanda tangan terlebih dahulu!");
                return;
            }

            const trimmedCanvas = getTrimmedCanvas(canvas);
            if (trimmedCanvas) {
                const dataURL = trimmedCanvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = 'tanda-tangan-gawedokumen.png';
                link.href = dataURL;
                link.click();
            }
        });
    </script>
@endsection
