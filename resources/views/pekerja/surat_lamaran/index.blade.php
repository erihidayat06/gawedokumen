@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="/css/lamaranPekerjaan.css">

    <div class="mb-8 text-center px-4 mt-28">
        <span
            class="inline-block px-3 py-1 mb-3 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full dark:bg-slate-800 dark:text-blue-400">
            Document Generator
        </span>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Rancang Surat Lamaran <span class="text-blue-600">Profesional</span>
        </h1>

        <div class="mt-3 max-w-2xl mx-auto">
            <p class="text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Mudah, cepat, dan sesuai standar HRD. Isi formulir di bawah, dan biarkan <span
                    class="font-semibold italic">Gawe Dokument</span> mengerjakan sisanya untuk Anda.
            </p>
        </div>



        <div class="mt-4 flex justify-center items-center space-x-2 text-sm text-slate-400 italic">
            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span>Kami mendoakan kesuksesan karir Anda di tempat tujuan.</span>
        </div>



        <div class="mt-6 w-24 h-1 bg-blue-600 mx-auto rounded-full opacity-20"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-5">

        <div class="order-1 md:order-2 p-5 bg-white border rounded-xl flex flex-col h-[700px]">
            <h3 class="font-bold border-b pb-2 text-gray-700">Form Input</h3>

            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                <button onclick="openTab(event, 'Head')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 focus:outline-none flex-shrink-0">
                    Head
                </button>
                <button onclick="openTab(event, 'pengawalan')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                    Pengawalan
                </button>
                <button onclick="openTab(event, 'data-diri')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                    Data Diri
                </button>
                <button onclick="openTab(event, 'dokumen')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                    Lampiran
                </button>
                <button onclick="openTab(event, 'tanda-tangan')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                    Tanda Tangan
                </button>
            </div>

            <div id="Head" class="tab-content space-y-4 ">
                <div>
                    <label class="block text-sm font-medium text-gray-700 ">Gaya Tulisan Dokumen</label>
                    <select id="font-selector" onchange="changeDocFont(this.value)"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white  transition-all">
                        <option value="font-serif">Times New Roman / Serif (Sangat Formal)</option>
                        <option value="font-sans" selected>Arial / Figtree (Modern & Bersih)</option>
                        <option value="font-mono">Courier / Mono (Teknis/Laporan)</option>
                        <option value="font-georgia">Georgia (Elegan & Mudah Dibaca)</option>
                    </select>
                    <p class="text-[10px] text-gray-500 mt-1">*Berpengaruh pada tampilan cetak dokumen.</p>
                </div>

                <hr class="border-slate-200 dark:border-slate-700">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kota</label>
                    <input type="text" id="kota"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('kota', 'kota-text','Kota')">
                </div>

                <div>
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-medium text-gray-700">Tanggal dibuat</label>
                        <button type="button" onclick="setHariIni()"
                            class="text-xs text-blue-600 hover:text-blue-800 hover:underline focus:outline-none">
                            Gunakan hari ini
                        </button>
                    </div>
                    <input type="date" id="tanggal"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('tanggal', 'tanggal-text', getTanggalIndo())">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" id="pt"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('pt', 'pt-text','PT. xxxxxxxx')">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Perusahaan</label>
                    <input type="text" id="alamat-perusahaan"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('alamat-perusahaan', 'alamat-perusahaan-text','Jl. xxxxxxxx')">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kota Perusahaan</label>
                    <input type="text" id="kota-perusahaan"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('kota-perusahaan', 'kota-perusahaan-text','Kota Perusahaan')">
                </div>
            </div>

            <div id="pengawalan" class="tab-content hidden space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Media Informasi</label>
                    <input type="text" id="media"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('media', 'media-text','Sosial Media')">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Posisi Kerja</label>
                    <input type="text" id="posisi"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('posisi', 'posisi-text','Posisi Kerja')">
                </div>
            </div>
            <div id="data-diri" class="tab-content hidden space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('nama', 'nama-text','Nama Lengkap')">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-4">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="jk" value="Laki-laki" class="hidden peer"
                                onclick="myFunctionRadio('jk', 'jenis-kelamin-text', 'Jenis Kelamin')">
                            <div
                                class="px-4 py-2 border border-slate-300 rounded-lg peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 transition-all">
                                Laki-laki
                            </div>
                        </label>

                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="jk" value="Perempuan" class="hidden peer"
                                onclick="myFunctionRadio('jk', 'jenis-kelamin-text', 'Jenis Kelamin')">
                            <div
                                class="px-4 py-2 border border-slate-300 rounded-lg peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 transition-all">
                                Perempuan
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" id="tempat-lahir"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('tempat-lahir', 'tempat-lahir-text','Tempat Lahir')">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tanggal-lahir"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('tanggal-lahir', 'tanggal-lahir-text', getTanggalIndo())">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat diri</label>
                    <input type="text" id="alamat-diri"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('alamat-diri', 'alamat-diri-text','Sekarang')">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="no-tlp"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        oninput="myFunction('no-tlp', 'no-tlp-text','08xxxxxxxxxx')">
                </div>
            </div>
            <div id="dokumen" class="tab-content hidden space-y-4 flex-1 overflow-y-auto scrollbar-thin">
                <div class="flex justify-between items-center mt-4">
                    <label class="block text-sm font-medium text-gray-700">Daftar Lampiran</label>
                    <button onclick="tambahBarisInput()"
                        class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-all">
                        + Tambah Baris
                    </button>
                </div>

                <div id="container-input-dokumen" class="space-y-2">
                </div>
            </div>
            <div id="tanda-tangan" class="tab-content hidden space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto / Tanda Tangan</label>

                    {{-- Tombol ke Halaman Tanda Tangan Digital --}}
                    <a href="{{ route('tool.signature') }}" target="_blank"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 mb-3 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl font-bold text-sm hover:bg-blue-100 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Bikin Tanda Tangan Digital Baru
                    </a>

                    {{-- Pemisah --}}
                    <div class="relative flex items-center py-2 mb-3">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-4 text-slate-400 text-[10px] font-bold uppercase tracking-widest">Atau
                            Upload</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>

                    {{-- Input File --}}
                    <input type="file" id="input-foto" accept="image/*"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none text-sm file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        onchange="simpanGambar(this)">

                    <button onclick="hapusGambar()"
                        class="text-[10px] font-bold text-red-500 mt-2 uppercase tracking-tight hover:underline">
                        Hapus Gambar Terpilih
                    </button>

                    <hr class="my-4 border-slate-100">

                    <label class="block text-sm font-medium text-gray-700 mt-3 mb-1">Posisi Tanda Tangan</label>
                    <select id="ttd-align-selector" onchange="changeTTDAlign(this.value)"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none bg-white text-sm shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="items-start">Kiri</option>
                        <option value="items-center">Tengah</option>
                        <option value="items-end" selected>Kanan (Standar)</option>
                    </select>
                </div>
            </div>
        </div>

        <div
            class="order-2 md:order-1 w-full h-[500px] md:h-[700px] border bg-gray-300 overflow-hidden relative touch-none flex justify-center items-start rounded-xl">
            <div
                class="absolute z-10 flex gap-1 sm:gap-2 p-1.5 sm:p-2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 mt-2 ml-2 transition-all">

                <button id="zoom-in" title="Perbesar"
                    class="p-1.5 sm:p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                    </svg>
                </button>

                <button id="zoom-out" title="Perkecil"
                    class="p-1.5 sm:p-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
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

            <div id="panzoom-element" class="bg-white shadow-2xl p-10 origin-top flex-shrink-0 text-justify"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size:12pt;">

                <div class="jarak-paragraf text-left">
                    <span id="kota-text"></span>, <span id="tanggal-text"></span>
                </div>

                <div class="jarak-paragraf text-left">Perihal: Lamaran Pekerjaan</div>

                <div class="jarak-paragraf text-left">
                    Kepada,<br>
                    HRD <span id="pt-text"></span> <br>
                    <span id="alamat-perusahaan-text"></span> <br>
                    <span id="kota-perusahaan-text"></span> <br>
                </div>

                <div class="jarak-paragraf text-left">Dengan Hormat,</div>

                <div class="jarak-paragraf text-justify">
                    Sehubungan dengan informasi lowongan kerja yang saya dapatkan di <span id="media-text"></span>,
                    saya mengetahui bahwa perusahaan <span id="pt2-text"></span> sedang mencari posisi <span
                        id="posisi-text"></span>.
                    Untuk itu, saya yang bertanda tangan di bawah ini:
                </div>

                <div class="jarak-paragraf">
                    <table class="text-left">
                        <tr>
                            <td>Nama</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><span id="nama-text"></span></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><span id="jenis-kelamin-text"></span></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tanggal lahir</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><span id="tempat-lahir-text"></span>, <span id="tanggal-lahir-text"></span></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><span id="alamat-diri-text"></span></td>
                        </tr>
                        <tr>
                            <td>Nomor telepon</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><span id="no-tlp-text"></span></td>
                        </tr>
                    </table>
                </div>

                <div class="jarak-paragraf text-justify">
                    Dengan ini bermaksud untuk melamar posisi <span id="posisi2-text"></span> di <span
                        id="pt3-text"></span>.
                    Sebagai bahan pertimbangan, saya sertakan beberapa dokumen berikut:
                </div>

                <div class="jarak-paragraf " style="list-style-type: disc; margin-left: 20px;">
                    <ol id="dokumen-text" class="list-decimal ml-5 text-red-500"></ol>
                </div>

                <div class="jarak-paragraf text-justify">
                    Demikian surat lamaran kerja ini, saya ucapkan terima kasih atas perhatian Bapak/Ibu HRD.
                </div>

                <div class="jarak-paragraf mt-10 px-5">
                    <div id="ttd-container" class="flex flex-col items-end">
                        <div class="text-center">
                            <span class="block mb-2">Hormat saya,</span>
                            <div class="w-32 h-32 flex justify-center items-center mx-auto">
                                <img id="preview-foto" src=""
                                    class="hidden max-w-full max-h-full object-contain">
                            </div>
                            <div class="mt-2 font-bold underline">
                                <span id="nama2-text"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
                Data yang Anda masukkan tidak disimpan di server kami. Kami menggunakan teknologi penyimpanan lokal agar
                identitas Anda tetap aman di perangkat Anda sendiri.
            </p>
        </div>
    </div>

    {{-- Bagian Edukasi/Tips di bawah Form --}}
    <article class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-10 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-8 leading-tight text-center">
                Bagaimana Cara Membuat Surat Lamaran Kerja di GaweDokumen & Tips Mengisinya
            </h2>

            <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <div class="space-y-4">
                    <p>
                        Membuat surat lamaran kerja profesional kini hanya butuh hitungan menit. Di
                        <strong>GaweDokumen</strong>, kami sudah menyediakan struktur standar HRD 2026. Anda cukup
                        memasukkan data diri, posisi yang dilamar, dan pengalaman singkat.
                    </p>
                    <p>
                        Isilah form dengan teliti sesuai data diri Anda. Setiap teks yang Anda masukkan akan otomatis muncul
                        pada <strong>preview dokumen</strong> secara real-time. Demi keamanan, data Anda hanya akan
                        tersimpan di dalam browser (Local Storage) dan <strong>tidak akan pernah dikirim ke server
                            kami</strong>.
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">1. Font (Gaya Tulisan)</h3>
                        <p>
                            Pilih gaya tulisan yang sesuai dengan karakter dokumen Anda. Untuk kesan yang lebih formal dan
                            standar industri di Indonesia, kami sangat menyarankan menggunakan font <strong>Times New
                                Roman</strong>.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">2. Head (Bagian Atas)</h3>
                        <p>
                            Isi <strong>Kota</strong> tempat Anda membuat surat dan <strong>Tanggal</strong> pembuatan. Anda
                            bisa klik tombol <span class="text-blue-600 font-medium">"Gunakan hari ini"</span> untuk
                            pengisian otomatis. Masukkan juga nama dan alamat lengkap perusahaan tujuan. Nama perusahaan
                            yang Anda input di sini akan otomatis sinkron ke bagian isi surat agar Anda tidak perlu menulis
                            berulang kali.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">3. Data Diri</h3>
                        <p>
                            Masukkan informasi personal Anda dengan lengkap mulai dari Nama, Alamat, hingga kontak yang bisa
                            dihubungi. Pastikan tidak ada kesalahan ketik pada nomor telepon dan email agar HRD mudah
                            menghubungi Anda.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">4. Lampiran</h3>
                        <p>
                            Sebutkan dokumen apa saja yang Anda sertakan dalam lamaran ini (misal: CV, Ijazah, atau
                            Portofolio). Gunakan tanda koma atau baris baru agar daftar lampiran terlihat rapi di dokumen
                            final.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">5. Tanda Tangan</h3>
                        <p>
                            Bagian akhir adalah penutup dan nama terang. Nama Anda akan otomatis muncul di bawah kolom tanda
                            tangan. Setelah semua data terisi, Anda bisa langsung mengunduh dokumen dalam format PDF yang
                            siap cetak.
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
                        Tips Biar Dilirik HRD:
                    </h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm text-blue-800/80 dark:text-blue-200/80">
                        <li><strong>Fokus pada Solusi:</strong> Jelaskan bagaimana skill Anda bisa menyelesaikan masalah
                            atau membantu target perusahaan.</li>
                        <li><strong>Gunakan Kata Kerja Aktif:</strong> Gunakan kata seperti "Meningkatkan", "Mengelola",
                            atau "Membangun" untuk menunjukkan inisiatif.</li>
                        <li><strong>Cek Typo:</strong> Teliti kembali sebelum download. Surat yang bersih dari salah ketik
                            menunjukkan profesionalisme dan ketelitian Anda.</li>
                    </ul>
                </div>
            </div>
        </div>
    </article>

    {{-- FAQ KHUSUS SURAT LAMARAN --}}
    <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                Pertanyaan Seputar <span class="text-blue-600">Surat Lamaran</span>
            </h2>

            <div class="space-y-4" x-data="{ active: null }">

                {{-- Item 1 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 1 ? active = 1 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apakah format surat ini sudah ramah sistem
                            ATS?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Ya. Kami menggunakan struktur teks bersih dan font standar seperti Times New Roman atau Arial yang
                        sangat mudah dibaca oleh sistem ATS (Applicant Tracking System) perusahaan besar.
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 2 ? active = 2 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Bolehkah saya mengosongkan bagian
                            lampiran?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Boleh. Jika Anda mengirim lamaran via email dan dokumen sudah digabung menjadi satu PDF, Anda bisa
                        mengosongkan bagian lampiran atau cukup menuliskan "Dokumen Pendukung" saja.
                    </div>
                </div>

                {{-- Item 3 yang sudah diupdate sesuai fitur upload --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 3 ? active = 3 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Bagaimana cara memasukkan tanda tangan
                            saya?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Anda bisa langsung mengunggah foto tanda tangan (format .png atau .jpg) melalui input yang tersedia.
                        Sistem akan otomatis menempatkannya di atas nama terang Anda. <strong>Tips:</strong> Gunakan foto
                        tanda tangan di atas kertas putih polos dengan pencahayaan yang terang agar hasilnya terlihat
                        natural seperti tanda tangan basah.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="printAdModal"
        class="fixed inset-0 z-[999] hidden flex items-center justify-center bg-slate-900/90 backdrop-blur-md p-4">
        <div
            class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl border border-slate-100 dark:border-slate-800">

            <div id="loadingState" class="text-center mb-6">
                <div
                    class="w-14 h-14 border-4 border-emerald-100 border-t-emerald-600 rounded-full animate-spin mx-auto mb-4">
                </div>
                <h3 class="text-xl font-black dark:text-white">Menyiapkan Dokumen...</h3>
                <p class="text-sm text-slate-500">Mohon tunggu sebentar</p>
            </div>

            <div id="readyState" class="hidden text-center mb-6">
                <div
                    class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-black dark:text-white">Dokumen Siap!</h3>
                <p class="text-sm text-slate-500">Silakan klik tombol di bawah</p>
            </div>

            <div
                class="my-6 min-h-[250px] bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-dashed border-slate-200 dark:border-slate-700 flex flex-col items-center justify-center p-4">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Advertisement</span>
                <div class="text-slate-300 italic text-xs text-center">
                    {{-- Taruh Script Iklan AdSense Kamu Di Sini --}}
                    Iklan Display akan muncul di area ini
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button id="btnRealPrint" disabled
                    class="w-full py-4 bg-slate-200 text-slate-400 font-bold rounded-2xl transition-all cursor-not-allowed flex items-center justify-center gap-1">
                    <span id="btnText">Tunggu</span>
                    <span id="adTimerSpan"><span id="adTimer">5</span>s</span>
                </button>
                <button onclick="closeAdModal()"
                    class="text-sm font-bold text-slate-400 hover:text-red-500 transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>




    <style>
        /* Font standar untuk dokumen formal */
        .font-serif {
            font-family: "Times New Roman", Times, serif;
        }

        .font-sans {
            font-family: ui-sans-serif, system-ui, sans-serif;
        }

        .font-mono {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }

        .font-georgia {
            font-family: Georgia, serif;
        }

        /* Utility agar spasi antar baris di kertas terlihat rapi */
        .jarak-paragraf {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
    </style>


    <script>
        let printTimer = null;
        let preparedData = {};

        // 1. EVENT LISTENER TOMBOL PRINT UTAMA
        document.getElementById('print').addEventListener('click', function() {
            const modal = document.getElementById('printAdModal');
            const timerDigit = document.getElementById('adTimer');
            const timerSpan = document.getElementById('adTimerSpan');
            const btnText = document.getElementById('btnText');
            const btnPrint = document.getElementById('btnRealPrint');
            const loading = document.getElementById('loadingState');
            const ready = document.getElementById('readyState');

            // --- RESET STATE (PENTING BIAR GAK BUG) ---
            if (printTimer) clearInterval(printTimer);
            let timeLeft = 5;

            modal.classList.remove('hidden');
            loading.classList.remove('hidden');
            ready.classList.add('hidden');

            // Kembalikan tombol ke mode nunggu
            btnPrint.disabled = true;
            btnText.innerText = "Tunggu ";
            timerDigit.innerText = timeLeft;
            timerSpan.classList.remove('hidden');
            btnPrint.className =
                "w-full py-4 bg-slate-200 text-slate-400 font-bold rounded-2xl transition-all cursor-not-allowed flex items-center justify-center gap-1";

            // --- AMBIL DATA DARI INPUT (DATA BINDING) ---
            const inputLampiran = Array.from(document.querySelectorAll('#container-input-dokumen input'))
                .map(i => i.value).filter(val => val.trim() !== "");

            const lampiranFinal = inputLampiran.length > 0 ? inputLampiran : ["Daftar Lampiran (Belum diisi)"];

            preparedData = {
                _token: "{{ csrf_token() }}",
                kota: document.getElementById('kota').value || "Kota",
                tanggal: document.getElementById('tanggal').value || (window.getTanggalInput ?
                    getTanggalInput() : ""),
                pt: document.getElementById('pt').value || "PT. xxxxxxxx",
                alamat_perusahaan: document.getElementById('alamat-perusahaan').value || "Jl. xxxxxxxx",
                kota_perusahaan: document.getElementById('kota-perusahaan').value || "Kota Perusahaan",
                media: document.getElementById('media').value || "Media Sosial",
                posisi: document.getElementById('posisi').value || "Posisi Kerja",
                nama: document.getElementById('nama').value || "Nama Lengkap",
                jk: document.querySelector('input[name="jk"]:checked')?.value || "Laki-laki",
                tempat_lahir: document.getElementById('tempat-lahir').value || "Tempat Lahir",
                tanggal_lahir: document.getElementById('tanggal-lahir').value || (window.getTanggalInput ?
                    getTanggalInput() : ""),
                alamat_diri: document.getElementById('alamat-diri').value || "Alamat Sekarang",
                no_tlp: document.getElementById('no-tlp').value || "08xxxxxxxxxx",
                ttd_align: document.getElementById('ttd-align-selector').value,
                font_style: document.getElementById('font-selector').value,
                lampiran: JSON.stringify(lampiranFinal),
                ttd_base64: document.getElementById('preview-foto').classList.contains('hidden') ? null :
                    document.getElementById('preview-foto').src
            };

            // --- JALANKAN COUNTDOWN ---
            printTimer = setInterval(() => {
                timeLeft--;

                if (timeLeft >= 0) {
                    timerDigit.innerText = timeLeft;
                }

                if (timeLeft <= 0) {
                    clearInterval(printTimer);

                    // Ganti Loading jadi Checklist
                    loading.classList.add('hidden');
                    ready.classList.remove('hidden');

                    // Update Tombol jadi Siap Cetak
                    btnText.innerText = "Cetak Sekarang";
                    timerSpan.classList.add('hidden'); // Sembunyikan angka detiknya

                    btnPrint.disabled = false;
                    btnPrint.className =
                        "w-full py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition-all active:scale-95 cursor-pointer flex items-center justify-center";

                    // Pasang fungsi kirim ke server
                    btnPrint.onclick = finalExecutePrint;
                }
            }, 1000);
        });

        // 2. FUNGSI KIRIM DATA KE SERVER (FORM BAYANGAN)
        function finalExecutePrint() {
            closeAdModal();

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('pdf.generate') }}";
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

        // 3. FUNGSI TUTUP MODAL & RESET
        function closeAdModal() {
            document.getElementById('printAdModal').classList.add('hidden');
            if (printTimer) clearInterval(printTimer);
        }


        function changeDocFont(fontClass) {
            // Targetkan elemen kertas preview
            const kertas = document.getElementById('panzoom-element');

            if (kertas) {
                // Daftar semua class font yang mungkin ada (agar bisa dihapus dulu)
                const allFonts = ['font-serif', 'font-sans', 'font-mono', 'font-georgia'];

                // Hapus class font yang lama
                allFonts.forEach(f => kertas.classList.remove(f));

                // Tambahkan class font yang baru dipilih
                kertas.classList.add(fontClass);

                // Simpan pilihan ke localStorage
                localStorage.setItem('selected_font', fontClass);
            }
        }

        // Jalankan saat halaman pertama kali dibuka
        document.addEventListener('DOMContentLoaded', () => {
            const savedFont = localStorage.getItem('selected_font') || 'font-sans';
            const fontSelector = document.getElementById('font-selector');

            if (fontSelector) {
                fontSelector.value = savedFont;
            }
            changeDocFont(savedFont);
        });


        function changeTTDAlign(alignClass) {
            const container = document.getElementById('ttd-container');
            if (container) {
                // Hapus semua class alignment yang mungkin ada
                container.classList.remove('items-start', 'items-center', 'items-end');
                // Tambah class yang dipilih
                container.classList.add(alignClass);
                // Simpan ke localStorage
                localStorage.setItem('storage_ttd_align', alignClass);
            }
        }

        // Tambahkan ini di dalam DOMContentLoaded agar saat refresh posisi tidak balik lagi
        document.addEventListener('DOMContentLoaded', () => {
            const savedAlign = localStorage.getItem('storage_ttd_align') || 'items-end';
            const alignSelector = document.getElementById('ttd-align-selector');

            if (alignSelector) {
                alignSelector.value = savedAlign;
            }
            changeTTDAlign(savedAlign);
        });




        // 1. Fungsi untuk Radio Button (Jenis Kelamin)
        function myFunctionRadio(name, targetId, defaultText) {
            const target = document.getElementById(targetId);
            const selected = document.querySelector(`input[name="${name}"]:checked`);

            if (selected) {
                const nilai = selected.value;
                target.textContent = nilai;
                target.classList.remove('text-red-500');
                localStorage.setItem("storage_" + targetId, nilai);
            } else {
                target.textContent = defaultText;
                target.classList.add('text-red-500');
                localStorage.removeItem("storage_" + targetId);
            }
        }

        // 2. Fungsi Utama (Update & Simpan Input Teks)
        function myFunction(inputId, targetId, defaultText) {
            const input = document.getElementById(inputId);
            const target = document.getElementById(targetId);
            if (!input || !target) return;

            let nilaiInput = input.value;

            // Fungsi pembantu untuk update teks & warna
            const updateElement = (tglId, val, def) => {
                const el = document.getElementById(tglId);
                if (!el) return;

                if (val.trim() !== "") {
                    el.classList.remove('text-red-500');
                    el.textContent = (input.type === 'date') ? getTanggalIndo(new Date(val)) : val;
                    localStorage.setItem("storage_" + tglId, val);
                } else {
                    el.textContent = def;
                    el.classList.add('text-red-500');
                    localStorage.removeItem("storage_" + tglId);
                }
            };

            // Logika Khusus untuk Input yang muncul di banyak tempat
            if (inputId === 'nama') {
                updateElement('nama-text', nilaiInput, 'Nama Lengkap');
                updateElement('nama2-text', nilaiInput, 'Nama Lengkap');
            } else if (inputId === 'posisi') {
                updateElement('posisi-text', nilaiInput, 'Posisi Kerja');
                updateElement('posisi2-text', nilaiInput, 'Posisi Kerja');
            } else if (inputId === 'pt') {
                updateElement('pt-text', nilaiInput, 'PT. xxxxxxxx');
                updateElement('pt2-text', nilaiInput, 'PT. xxxxxxxx');
                updateElement('pt3-text', nilaiInput, 'PT. xxxxxxxx');
            } else {
                // Logika Default
                updateElement(targetId, nilaiInput, defaultText);
            }
        }

        // 3. Eksekusi Saat Halaman Dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Daftar semua field yang perlu di-load
            const fields = [{
                    inputId: 'kota',
                    targetId: 'kota-text',
                    defaultText: 'Kota'
                },
                {
                    inputId: 'tanggal',
                    targetId: 'tanggal-text',
                    defaultText: getTanggalIndo()
                },
                {
                    inputId: 'pt',
                    targetId: 'pt-text',
                    defaultText: 'PT. xxxxxxxx'
                },
                {
                    inputId: 'pt',
                    targetId: 'pt2-text',
                    defaultText: 'PT. xxxxxxxx'
                },
                {
                    inputId: 'pt',
                    targetId: 'pt3-text',
                    defaultText: 'PT. xxxxxxxx'
                },
                {
                    inputId: 'alamat-perusahaan',
                    targetId: 'alamat-perusahaan-text',
                    defaultText: 'Jl. xxxxxxxx'
                },
                {
                    inputId: 'kota-perusahaan',
                    targetId: 'kota-perusahaan-text',
                    defaultText: 'Kota Perusahaan'
                },
                {
                    inputId: 'media',
                    targetId: 'media-text',
                    defaultText: 'Media Sosial'
                },
                {
                    inputId: 'posisi',
                    targetId: 'posisi-text',
                    defaultText: 'Posisi Kerja'
                },
                {
                    inputId: 'posisi',
                    targetId: 'posisi2-text',
                    defaultText: 'Posisi Kerja'
                },
                {
                    inputId: 'nama',
                    targetId: 'nama-text',
                    defaultText: 'Nama Lengkap'
                },
                {
                    inputId: 'nama',
                    targetId: 'nama2-text',
                    defaultText: 'Nama Lengkap'
                },
                {
                    inputId: 'tempat-lahir',
                    targetId: 'tempat-lahir-text',
                    defaultText: 'Tempat Lahir'
                },
                {
                    inputId: 'tanggal-lahir',
                    targetId: 'tanggal-lahir-text',
                    defaultText: getTanggalIndo()
                },
                {
                    inputId: 'alamat-diri',
                    targetId: 'alamat-diri-text',
                    defaultText: "Alamat Sekarang"
                },
                {
                    inputId: 'no-tlp',
                    targetId: 'no-tlp-text',
                    defaultText: "08xxxxxxxxxx"
                }
            ];

            fields.forEach(field => {
                const inputElem = document.getElementById(field.inputId);
                const targetElem = document.getElementById(field.targetId);
                const savedValue = localStorage.getItem("storage_" + field.targetId);

                if (savedValue) {
                    if (inputElem) inputElem.value = savedValue;
                    targetElem.textContent = (inputElem && inputElem.type === 'date') ? getTanggalIndo(
                        new Date(savedValue)) : savedValue;
                    targetElem.classList.remove('text-red-500');
                } else {
                    targetElem.textContent = field.defaultText;
                    targetElem.classList.add('text-red-500');
                    // Set default tanggal hari ini jika input tanggal kosong
                    if (inputElem && field.inputId === 'tanggal' && !savedValue) {
                        inputElem.value = getTanggalInput();
                        targetElem.textContent = getTanggalIndo();
                        targetElem.classList.remove('text-red-500');
                    }
                }
            });

            // Load Radio Button Jenis Kelamin
            const savedJK = localStorage.getItem("storage_jenis-kelamin-text");
            const targetJK = document.getElementById('jenis-kelamin-text');
            if (savedJK && targetJK) {
                const radioToSelect = document.querySelector(`input[name="jk"][value="${savedJK}"]`);
                if (radioToSelect) radioToSelect.checked = true;
                targetJK.textContent = savedJK;
                targetJK.classList.remove('text-red-500');
            }

            // Load Foto/Tanda Tangan
            const savedFoto = localStorage.getItem("storage_foto");
            if (savedFoto) tampilkanGambar(savedFoto);

            // Load & Render Lampiran
            renderInputs();
        });

        // --- LOGIKA LAMPIRAN DOKUMEN ---
        let daftarDokumen = JSON.parse(localStorage.getItem("storage_list_dokumen")) || [""];

        function renderInputs() {
            const container = document.getElementById('container-input-dokumen');
            if (!container) return;
            container.innerHTML = '';

            daftarDokumen.forEach((value, index) => {
                const div = document.createElement('div');
                div.className = "flex gap-2";
                div.innerHTML = `
                <input type="text"
                    class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Lampiran ${index + 1}"
                    value="${value}"
                    onkeyup="updateDataDokumen(${index}, this.value)">
                <button onclick="hapusBarisInput(${index})"
                    class="text-red-500 p-2 ${daftarDokumen.length === 1 ? 'hidden' : ''}">✕</button>
            `;
                container.appendChild(div);
            });
            updatePreviewDokumen();
        }

        function tambahBarisInput() {
            daftarDokumen.push("");
            renderInputs();
        }

        function updateDataDokumen(index, val) {
            daftarDokumen[index] = val;
            localStorage.setItem("storage_list_dokumen", JSON.stringify(daftarDokumen));
            updatePreviewDokumen();
        }

        function updatePreviewDokumen() {
            const listPreview = document.getElementById('dokumen-text');
            if (!listPreview) return;
            const dokumenValid = daftarDokumen.filter(item => item.trim() !== "");
            if (dokumenValid.length > 0) {
                listPreview.classList.remove('text-red-500');
                listPreview.innerHTML = dokumenValid.map(doc => `<li>${doc}</li>`).join('');
            } else {
                listPreview.classList.add('text-red-500');
                listPreview.innerHTML = `<li>Daftar Lampiran (Belum diisi)</li>`;
            }
        }

        function hapusBarisInput(index) {
            if (daftarDokumen.length > 1) {
                daftarDokumen.splice(index, 1);
                localStorage.setItem("storage_list_dokumen", JSON.stringify(daftarDokumen));
                renderInputs();
            }
        }

        // --- LOGIKA GAMBAR ---
        function simpanGambar(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onloadend = () => {
                    localStorage.setItem("storage_foto", reader.result);
                    tampilkanGambar(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }

        function tampilkanGambar(base64) {
            const imgPreview = document.getElementById('preview-foto');
            if (imgPreview) {
                imgPreview.src = base64;
                imgPreview.classList.remove('hidden');
            }
        }

        function hapusGambar() {
            localStorage.removeItem("storage_foto");
            document.getElementById('input-foto').value = "";
            const imgPreview = document.getElementById('preview-foto');
            if (imgPreview) imgPreview.classList.add('hidden');
        }

        // --- UTILS TANGGAL ---
        function getTanggalIndo(dateObj = new Date()) {
            const bulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];
            return `${String(dateObj.getDate()).padStart(2, '0')} ${bulanIndo[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
        }

        function getTanggalInput(dateObj = new Date()) {
            return dateObj.toISOString().split('T')[0];
        }
    </script>
    <script>
        function openTab(evt, tabName) {
            // 1. Ambil semua elemen dengan class "tab-content" dan sembunyikan (tambah class hidden)
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            // 2. Ambil semua tombol "tab-link" dan reset stylenya ke default
            const links = document.querySelectorAll('.tab-link');
            links.forEach(link => {
                link.classList.remove('border-blue-500', 'text-blue-600');
                link.classList.add('border-transparent', 'text-gray-500');
            });

            // 3. Tampilkan tab yang dipilih
            document.getElementById(tabName).classList.remove('hidden');

            // 4. Tambahkan styling aktif pada tombol yang diklik
            evt.currentTarget.classList.remove('border-transparent', 'text-gray-500');
            evt.currentTarget.classList.add('border-blue-500', 'text-blue-600');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elem = document.getElementById('panzoom-element');
            const parent = elem.parentElement;

            if (typeof Panzoom !== 'undefined') {
                // 1. Tentukan Koordinat Berdasarkan Layar
                const isDesktop = window.innerWidth >= 768;

                // Angka dari temuan kamu (Desktop)
                const desktopScale = 0.9;
                const desktopX = 0;
                const desktopY = 0;

                // Angka perkiraan untuk Mobile (Silakan sesuaikan jika sudah nemu yang pas)
                const mobileScale = 0.4;
                const mobileY = -750;

                const panzoom = Panzoom(elem, {
                    maxScale: 5,
                    minScale: 0.1,
                    canvas: true,
                    startScale: isDesktop ? desktopScale : mobileScale,
                    cursor: 'move',
                });

                // 2. Fungsi Reset ke Posisi Presisi
                const setPresisi = () => {
                    if (window.innerWidth >= 768) {
                        // Pakai angka desktop kamu
                        panzoom.zoom(desktopScale);
                        panzoom.pan(desktopX, desktopY, {
                            force: true
                        });
                    } else {
                        // Pakai angka mobile
                        panzoom.zoom(mobileScale);
                        panzoom.pan(0, mobileY, {
                            force: true
                        });
                    }
                };

                // Jalankan otomatis saat buka
                setTimeout(setPresisi, 100);

                // Tombol Reset balik ke angka sakti ini
                document.getElementById('reset').addEventListener('click', () => {
                    setPresisi();
                });

                parent.addEventListener('wheel', panzoom.zoomWithWheel);
                document.getElementById('zoom-in').addEventListener('click', panzoom.zoomIn);
                document.getElementById('zoom-out').addEventListener('click', panzoom.zoomOut);
            }
        });

        function setHariIni() {
            const inputTanggal = document.getElementById('tanggal');

            // 1. Ambil format YYYY-MM-DD untuk input date
            const hariIni = getTanggalInput(); // Fungsi ini sudah ada di kode sebelumnya

            // 2. Set nilai input
            inputTanggal.value = hariIni;

            // 3. Jalankan fungsi update agar preview di kertas berubah
            // Kita panggil manual karena nilai yang diubah lewat JS tidak memicu event 'oninput'
            myFunction('tanggal', 'tanggal-text', getTanggalIndo());
        }
    </script>
@endsection
