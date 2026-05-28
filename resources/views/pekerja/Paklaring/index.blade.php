@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/lamaranPekerjaan.css">
    <div class="mb-8 text-center px-4 mt-28">
        <span
            class="inline-block px-3 py-1 mb-3 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full dark:bg-slate-800 dark:text-blue-400">
            Document Generator
        </span>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Buat Surat Paklaring <span class="text-blue-600">Resmi & Legal</span>
        </h1>

        <div class="mt-3 max-w-2xl mx-auto">
            <p class="text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Mudah, cepat, dan sesuai standar hukum ketenagakerjaan. Isi formulir di bawah, dan biarkan <span
                    class="font-semibold italic">Gawe Dokumen</span> menyusun draf legalnya untuk Anda.
            </p>
        </div>

        <div class="mt-4 flex justify-center items-center space-x-2 text-sm text-slate-400 italic">
            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Memberikan bukti administrasi profesional demi mendukung masa depan eks-karyawan Anda.</span>
        </div>

        <div class="mt-6 w-24 h-1 bg-blue-600 mx-auto rounded-full opacity-20"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-5">

        @php
            // 1. Konfigurasi Tab Paklaring (Dibuat mengalir sesuai struktur surat)
            $tabs = [
                ['id' => 'head', 'label' => 'Perusahaan'],
                ['id' => 'karyawan', 'label' => 'Data Karyawan'],
                ['id' => 'masa-kerja', 'label' => 'Masa Kerja'],
                ['id' => 'penandatangan', 'label' => 'Penandatangan'],
            ];

            // 2. Definisi Field Paklaring (HTML & JS)
            $allFields = [
                // Tab Perusahaan (Kop & Profil Penerbit Surat)
                'head' => [
                    [
                        'id' => 'no-surat',
                        'label' => 'Nomor Surat',
                        'targets' => ['no-surat-text'],
                        'default' => '001/HRD/PK/' . date('Y'),
                    ],
                    [
                        'id' => 'pt',
                        'label' => 'Nama Perusahaan / Toko',
                        'targets' => ['pt-text', 'pt2-text', 'pt3-text'],
                        'default' => 'PT. Nama Perusahaan',
                    ],
                    [
                        'id' => 'alamat-perusahaan',
                        'label' => 'Alamat Perusahaan',
                        'targets' => ['alamat-perusahaan-text'],
                        'default' => 'Jl. Jalur Utama No. X, Kota',
                    ],
                    [
                        'id' => 'kota-perusahaan',
                        'label' => 'Kota Penerbit Surat',
                        'targets' => ['kota-perusahaan-text'],
                        'default' => 'Jakarta',
                    ],
                ],

                // Tab Karyawan (Data internal pekerja yang resign)
                'karyawan' => [
                    [
                        'id' => 'nama-karyawan',
                        'label' => 'Nama Lengkap Karyawan',
                        'targets' => ['nama-karyawan-text', 'nama-karyawan2-text'],
                        'default' => 'Nama Karyawan',
                    ],
                    [
                        'id' => 'nik',
                        'label' => 'Nomor Induk Karyawan (NIK) / KTP',
                        'targets' => ['nik-text'],
                        'default' => '1234567890',
                    ],
                    [
                        'id' => 'posisi',
                        'label' => 'Jabatan Terakhir',
                        'targets' => ['posisi-text', 'posisi2-text'],
                        'default' => 'Staff Administrasi',
                    ],
                ],

                // Tab Masa Kerja (Menggunakan Input Date nanti di form)
                'masa-kerja' => [
                    [
                        'id' => 'alasan-keluar',
                        'label' => 'Alasan Berhenti (opsional)',
                        'targets' => ['alasan-keluar-text'],
                        'default' => 'Pengunduran Diri (Resign)',
                    ],
                ],

                // Tab Penandatangan (Atasan/HRD/Owner yang sah)
                'penandatangan' => [
                    [
                        'id' => 'nama-atasan',
                        'label' => 'Nama Penandatangan',
                        'targets' => ['nama-atasan-text', 'nama-atasan-sign-text'],
                        'default' => 'Nama Manager / Owner',
                    ],
                    [
                        'id' => 'jabatan-atasan',
                        'label' => 'Jabatan Penandatangan',
                        'targets' => ['jabatan-atasan-text', 'jabatan-atasan-sign-text'],
                        'default' => 'HRD Manager',
                    ],
                ],
            ];

            // 3. Khusus untuk JS (Flatten array agar sinkronisasi real-time otomatis jalan)
            $jsConfig = [];
            foreach ($allFields as $section) {
                foreach ($section as $f) {
                    $jsConfig[] = [
                        'inputId' => $f['id'],
                        'targets' => $f['targets'],
                        'default' => $f['default'],
                    ];
                }
            }

            // 4. Tambahkan field penanggalan dinamis ke konfigurasi JavaScript
            $jsConfig[] = [
                'inputId' => 'tanggal-mulai',
                'targets' => ['tanggal-mulai-text'],
                'default' => 'DATE_NOW',
                'isDate' => true,
            ];
            $jsConfig[] = [
                'inputId' => 'tanggal-selesai',
                'targets' => ['tanggal-selesai-text'],
                'default' => 'DATE_NOW',
                'isDate' => true,
            ];
            $jsConfig[] = [
                'inputId' => 'tanggal-surat', // Tanggal ditandatanganinya paklaring
                'targets' => ['tanggal-surat-text'],
                'default' => 'DATE_NOW',
                'isDate' => true,
            ];
        @endphp
        <div class="order-1 md:order-2 p-5 bg-white border rounded-xl flex flex-col h-[700px]">
            <h3 class="font-bold border-b pb-2 text-gray-700">Form Input Paklaring</h3>

            {{-- Navigasi Tab dinamis --}}
            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                @foreach ($tabs as $index => $tab)
                    <button onclick="openTab(event, '{{ $tab['id'] }}')"
                        class="tab-link py-2 px-4 text-sm font-medium border-b-2 {{ $index == 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500' }} hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="flex-1 overflow-y-auto pr-1 scrollbar-thin">

                {{-- TAB 1: PERUSAHAAN (HEAD) --}}
                <div id="head" class="tab-content space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gaya Tulisan Dokumen</label>
                        <select id="font-selector" onchange="changeDocFont(this.value)"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none bg-white transition-all">
                            <option value="font-serif" selected>Times New Roman / Serif (Sangat Formal)</option>
                            <option value="font-sans">Arial / Figtree (Modern & Bersih)</option>
                            <option value="font-georgia">Georgia (Elegan & Mudah Dibaca)</option>
                        </select>
                    </div>
                    <hr class="border-slate-200">

                    @foreach ($allFields['head'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')"
                                value="{{ $field['default'] }}">
                        </div>
                    @endforeach

                    {{-- Tanggal Surat Diterbitkan --}}
                    <div>
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-medium text-gray-700">Tanggal Surat</label>
                            <button type="button" onclick="setHariIni('tanggal-surat')"
                                class="text-xs text-blue-600 hover:underline">Gunakan hari ini</button>
                        </div>
                        <input type="date" id="tanggal-surat"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                            oninput="myFunction('tanggal-surat', 'tanggal-surat-text', getTanggalIndo())">
                    </div>
                </div>

                {{-- TAB 2: DATA KARYAWAN --}}
                <div id="karyawan" class="tab-content hidden space-y-4">
                    @foreach ($allFields['karyawan'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')"
                                value="{{ $field['default'] }}">
                        </div>
                    @endforeach
                </div>

                {{-- TAB 3: MASA KERJA --}}
                <div id="masa-kerja" class="tab-content hidden space-y-4">
                    {{-- Input Rentang Tanggal Kerja Karyawan --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mulai Kerja</label>
                            <input type="date" id="tanggal-mulai"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('tanggal-mulai', 'tanggal-mulai-text', getTanggalIndo())">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Selesai Kerja</label>
                            <input type="date" id="tanggal-selesai"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('tanggal-selesai', 'tanggal-selesai-text', getTanggalIndo())">
                        </div>
                    </div>

                    @foreach ($allFields['masa-kerja'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')"
                                value="{{ $field['default'] }}">
                        </div>
                    @endforeach
                </div>

                {{-- TAB 4: PENANDATANGAN & LEGALITAS --}}
                <div id="penandatangan" class="tab-content hidden space-y-4">
                    @foreach ($allFields['penandatangan'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')"
                                value="{{ $field['default'] }}">
                        </div>
                    @endforeach

                    <hr class="my-2 border-slate-200">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stempel / Tanda Tangan Atasan</label>

                        <a href="{{ route('tool.signature') }}" target="_blank"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 mb-3 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl font-bold text-sm hover:bg-blue-100 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                            Buat Tanda Tangan Digital Baru
                        </a>

                        <div class="relative flex items-center py-2 mb-3">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span
                                class="flex-shrink mx-4 text-slate-400 text-[10px] font-bold uppercase tracking-widest">Atau
                                Upload Scan TTD/Stempel</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>

                        <input type="file" id="input-foto" accept="image/*"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none text-sm file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            onchange="simpanGambar(this)">

                        <button onclick="hapusGambar()"
                            class="text-[10px] font-bold text-red-500 mt-2 uppercase tracking-tight hover:underline">
                            Hapus Gambar Terpilih
                        </button>

                        <hr class="my-4 border-slate-100">

                        <label class="block text-sm font-medium text-gray-700 mb-1">Posisi Tanda Tangan Surat</label>
                        <select id="ttd-align-selector" onchange="changeTTDAlign(this.value)"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg outline-none bg-white text-sm shadow-sm focus:ring-2 focus:ring-blue-500">
                            <option value="items-start">Kiri (Gaya Instansi Pemerintah)</option>
                            <option value="items-center">Tengah</option>
                            <option value="items-end" selected>Kanan (Standar Perusahaan/UMKM)</option>
                        </select>
                    </div>
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

            <div id="panzoom-element" class="bg-white shadow-2xl origin-top flex-shrink-0 text-justify"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size:12pt; padding: 20mm 25mm 20mm 26mm;">

                <div class="text-center border-b-4 border-gray-800 pb-4 mb-6">
                    <h1 id="pt-text" class="text-2xl font-black uppercase tracking-wide text-gray-900"></h1>
                    <p id="alamat-perusahaan-text" class="text-sm text-gray-600 mt-1"></p>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-lg font-bold uppercase tracking-wider underline text-gray-900">Surat Keterangan
                        Pengalaman Kerja</h2>
                    <p class="text-sm text-gray-700 mt-1">No: <span id="no-surat-text"></span></p>
                </div>

                <div class="jarak-paragraf text-justify mb-4">
                    Yang bertanda tangan di bawah ini mewakili manajemen <span id="pt2-text" class="font-bold"></span>,
                    menerangkan dengan sebenarnya bahwa:
                </div>

                <div class="jarak-paragraf mb-6 pl-6">
                    <table class="text-left w-full table-fixed">
                        <tr class="align-top">
                            <td class="w-1/4 py-1">Nama Lengkap</td>
                            <td class="w-4 py-1">&nbsp;:&nbsp;</td>
                            <td class="font-bold text-gray-900 py-1"><span id="nama-karyawan-text"></span></td>
                        </tr>
                        <tr class="align-top">
                            <td class="py-1">NIK / No. KTP</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td class="text-gray-800 py-1"><span id="nik-text"></span></td>
                        </tr>
                        <tr class="align-top">
                            <td class="py-1">Jabatan Terakhir</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td class="text-gray-800 py-1"><span id="posisi-text"></span></td>
                        </tr>
                    </table>
                </div>

                <div class="jarak-paragraf text-justify leading-relaxed mb-4">
                    Adalah benar telah bekerja pada perusahaan kami dalam kurun waktu terhitung sejak tanggal
                    <span id="tanggal-mulai-text" class="font-semibold text-gray-900"></span> sampai dengan tanggal
                    <span id="tanggal-selesai-text" class="font-semibold text-gray-900"></span>. Saudara/i yang
                    bersangkutan berhenti bekerja dikarenakan <span id="alasan-keluar-text"></span>.
                </div>

                <div class="jarak-paragraf text-justify leading-relaxed mb-8">
                    Selama menjadi bagian dari perusahaan kami, Saudara/i <span id="nama-karyawan2-text"
                        class="font-semibold"></span> telah menunjukkan dedikasi, loyalitas, serta kontribusi yang baik
                    untuk operasional dan perkembangan perusahaan. Seluruh tanggung jawab pekerjaan yang diberikan telah
                    diselesaikan dengan integritas yang tinggi.
                </div>

                <div class="jarak-paragraf text-justify leading-relaxed mb-12">
                    Kami mengucapkan terima kasih yang sebesar-besarnya atas pengabdian yang telah diberikan. Semoga
                    pengalaman kerja yang didapatkan di sini dapat bermanfaat untuk mendukung kesuksesan karier di masa yang
                    akan datang.
                </div>

                <div class="jarak-paragraf mt-12">
                    <div id="ttd-container" class="flex flex-col items-end">
                        <div class="text-center min-w-[200px]">
                            <span id="kota-perusahaan-text"></span>, <span id="tanggal-surat-text"></span>
                            <span class="block mt-1 mb-2 font-semibold" id="pt3-text"></span>

                            <div class="w-32 h-24 flex justify-center items-center mx-auto my-2">
                                <img id="preview-foto" src=""
                                    class="hidden max-w-full max-h-full object-contain">
                            </div>

                            <div class="font-bold underline text-gray-900">
                                <span id="nama-atasan-text"></span>
                            </div>
                            <div class="text-xs text-gray-600 font-medium">
                                <span id="jabatan-atasan-text"></span>
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
                Bagaimana Cara Membuat Surat Paklaring di GaweDokumen & Tips Mengisinya
            </h2>

            <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <div class="space-y-4">
                    <p>
                        Menerbitkan Surat Keterangan Kerja (Paklaring) resmi kini jauh lebih praktis. Di
                        <strong>GaweDokumen</strong>, kami menyediakan draf standar baku administrasi hukum ketenagakerjaan.
                        Anda selaku HRD atau pemilik usaha cukup mengisi informasi perusahaan, detail masa kerja, dan
                        identitas mantan karyawan.
                    </p>
                    <p>
                        Isilah formulir dengan data penanggalan yang valid. Setiap teks yang dimasukkan akan langsung
                        ter-update pada <strong>preview dokumen</strong> secara real-time. Demi menjaga privasi bisnis,
                        seluruh data operasional ini hanya tersimpan di browser Anda (Local Storage) dan <strong>tidak akan
                            pernah dikirim ke server kami</strong>.
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">1. Font (Gaya Tulisan)</h3>
                        <p>
                            Pilih jenis huruf yang mencerminkan dokumen legal. Untuk surat keterangan resmi perusahaan yang
                            bersifat formal, kami sangat menyarankan untuk memilih opsi font <strong>Times New Roman /
                                Serif</strong>.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">2. Bagian Perusahaan (Head)</h3>
                        <p>
                            Bagian ini berfungsi sebagai Kop Surat. Masukkan nama legal perusahaan/toko beserta alamat
                            operasional lengkap. Input juga nomor surat keluar resmi internal Anda dan tanggal penerbitan
                            dokumen agar arsip administrasi perusahaan tetap rapi.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">3. Data Karyawan</h3>
                        <p>
                            Tuliskan Nama Lengkap mantan karyawan sesuai yang tertera di KTP atau kontrak kerja asli.
                            Cantumkan pula NIK (Nomor Induk Karyawan) atau No. KTP beserta jabatan atau posisi terakhir yang
                            mereka ampu sebelum masa kerja berakhir.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">4. Masa Kerja & Keterangan</h3>
                        <p>
                            Tentukan tanggal pasti kapan karyawan mulai aktif bekerja hingga tanggal resmi mereka berhenti
                            (*resign*). Pilih juga alasan berhentinya hubungan kerja (seperti Pengunduran Diri atau Habis
                            Masa Kontrak) sebagai pemenuhan syarat sah administrasi eksternal.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">5. Penandatangan & Legalitas</h3>
                        <p>
                            Isi nama lengkap berserta jabatan atasan (Owner, Direktur, atau HR Manager) yang berwenang
                            melegalisasi surat ini. Format tata letak tanda tangan standar perusahaan swasta atau UMKM
                            umumnya menggunakan opsi posisi sebelah kanan (items-end).
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
                        Catatan Penting bagi Manajemen / Pemilik Usaha:
                    </h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm text-blue-800/80 dark:text-blue-200/80">
                        <li><strong>Apresiasi Profesional:</strong> Berikan kesan penutup yang baik pada teks apresiasi
                            untuk mendukung pengembangan karier mantan staf Anda di tempat baru mereka.</li>
                        <li><strong>Fakta Administrasi:</strong> Pastikan rentang tanggal masuk dan keluar sinkron dengan
                            buku absensi atau data payroll untuk menghindari kekeliruan verifikasi dari pihak ketiga.</li>
                        <li><strong>Stempel & Tanda Tangan:</strong> Agar dokumen PDF yang di-download sah digunakan sebagai
                            klaim BPJS Ketenagakerjaan oleh pekerja, jangan lupa unggah scan/foto stempel cap toko atau
                            tanda tangan basah manajemen.</li>
                    </ul>
                </div>
            </div>
        </div>
    </article>

    {{-- FAQ KHUSUS SURAT PAKLARING --}}
    <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                Pertanyaan Seputar <span class="text-blue-600">Surat Paklaring</span>
            </h2>

            <div class="space-y-4" x-data="{ active: null }">

                {{-- Item 1 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 1 ? active = 1 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apakah format Paklaring dari GaweDokumen
                            bisa untuk pencairan BPJS?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Bisa. Struktur isi, klausul apresiasi, dan data rentang masa kerja yang dihasilkan oleh generator
                        ini sudah memenuhi syarat kelayakan administrasi klaim JHT (Jaminan Hari Tua) di aplikasi BPJS
                        Ketenagakerjaan.
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 2 ? active = 2 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apakah karyawan yang di-PHK atau resign
                            mendadak tetap berhak mendapat Paklaring?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Ya, berhak. Surat Paklaring bertindak sebagai surat keterangan fakta operasional bahwa seseorang
                        pernah bekerja di perusahaan Anda. Apapun alasan berakhirnya hubungan kerja, manajemen disarankan
                        memberikan dokumen ini sebagai kewajiban normatif pemenuhan berkas administrasi tenaga kerja.
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 3 ? active = 3 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Bagaimana cara memasukkan cap stempel atau
                            TTD perusahaan?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Anda bisa menggunakan fitur upload file gambar tanda tangan atau stempel di tab Penandatangan.
                        <strong>Tips:</strong> Ambil foto cap stempel perusahaan atau TTD atasan di atas selembar kertas
                        putih bersih dengan pencahayaan terang tanpa bayangan, lalu upload ke form agar menyatu rapi dengan
                        teks dasar dokumen PDF.
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
@endsection

@push('scripts')
    <script src="/js/gawedokumen.js"></script>
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
            const rawTTD = document.getElementById('preview-foto').classList.contains('hidden') ? null : document
                .getElementById('preview-foto').src;

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

                // 1. Bagian Perusahaan (Head)
                no_surat: document.getElementById('no-surat').value || "001/HRD/PK/{{ date('Y') }}",
                pt: document.getElementById('pt').value || "PT. Nama Perusahaan",
                alamat_perusahaan: document.getElementById('alamat-perusahaan').value ||
                    "Jl. Jalur Utama No. X, Kota",
                kota_perusahaan: document.getElementById('kota-perusahaan').value || "Jakarta",
                tanggal_surat: document.getElementById('tanggal-surat').value || (window.getTanggalInput ?
                    getTanggalInput() : ""),

                // 2. Bagian Data Karyawan
                nama_karyawan: document.getElementById('nama-karyawan').value || "Nama Karyawan",
                nik: document.getElementById('nik').value || "1234567890",
                posisi: document.getElementById('posisi').value || "Staff Administrasi",

                // 3. Bagian Masa Kerja & Keterangan
                tanggal_mulai: document.getElementById('tanggal-mulai').value || "",
                tanggal_selesai: document.getElementById('tanggal-selesai').value || "",
                alasan_keluar: document.getElementById('alasan-keluar').value || "Pengunduran Diri (Resign)",

                // 4. Bagian Penandatangan & Tampilan Dokumen
                nama_atasan: document.getElementById('nama-atasan').value || "Nama Manager / Owner",
                jabatan_atasan: document.getElementById('jabatan-atasan').value || "HRD Manager",
                ttd_align: document.getElementById('ttd-align-selector').value,
                font_style: document.getElementById('font-selector').value,

                // Gambar TTD / Stempel Base64
                ttd_base64: rawTTD // Tetap biarkan raw untuk ditimpa logic kompresi gambar kamu
            };
            if (rawTTD) {
                compressSignature(rawTTD).then(compressed => {
                    preparedData.ttd_base64 = compressed;
                    console.log("TTD berhasil dikompres!");
                });
            }

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

        // Fungsi untuk mengecilkan ukuran string Base64 gambar
        function compressSignature(base64Str) {
            return new Promise((resolve) => {
                const img = new Image();
                img.src = base64Str;
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    // Set ukuran canvas lebih kecil (misal max lebar 400px)
                    const maxWidth = 400;
                    const scale = maxWidth / img.width;
                    canvas.width = maxWidth;
                    canvas.height = img.height * scale;

                    // Gambar ulang dengan kualitas rendah
                    ctx.fillStyle = "#FFFFFF"; // Beri background putih karena JPEG gak support transparan
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    // Export ke JPEG dengan kualitas 0.2 (Sangat kecil!)
                    resolve(canvas.toDataURL("image/jpeg", 0.2));
                };
            });
        }

        // 2. FUNGSI KIRIM DATA KE SERVER (FORM BAYANGAN)
        function finalExecutePrint() {
            closeAdModal();

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('pekerja.surat.paklaring.pdf') }}";
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
            if (inputId === 'nama-karyawan') {
                updateElement('nama-karyawan-text', nilaiInput, 'Nama Lengkap');
                updateElement('nama-karyawan2-text', nilaiInput, 'Nama Lengkap');
            } else if (inputId === 'pt') {
                updateElement('pt-text', nilaiInput, 'PT. Nama Perusahaan');
                updateElement('pt2-text', nilaiInput, 'PT. Nama Perusahaan');
                updateElement('pt3-text', nilaiInput, 'PT. Nama Perusahaan');
            } else {
                // Logika Default
                updateElement(targetId, nilaiInput, defaultText);
            }
        }

        // 3. Eksekusi Saat Halaman Dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil semua input yang ada di dalam tab pengawalan (atau seluruh form)

            // Ambil config dari PHP secara otomatis
            const fields = @json($jsConfig);

            fields.forEach(field => {
                const inputElem = document.getElementById(field.inputId);

                // Loop setiap target yang terdaftar untuk input ini
                field.targets.forEach(targetId => {
                    const targetElem = document.getElementById(targetId);
                    if (!targetElem) return;

                    const savedValue = localStorage.getItem("storage_" + targetId);
                    const defaultText = (field.default === 'DATE_NOW') ? getTanggalIndo() : field
                        .default;

                    if (savedValue) {
                        if (inputElem) inputElem.value = savedValue;
                        targetElem.textContent = (field.isDate) ? getTanggalIndo(new Date(
                            savedValue)) : savedValue;
                        targetElem.classList.remove('text-red-500');
                    } else {
                        targetElem.textContent = defaultText;
                        targetElem.classList.add('text-red-500');

                        // Set default tanggal hari ini khusus field 'tanggal'
                        if (inputElem && field.inputId === 'tanggal' && !savedValue) {
                            inputElem.value = getTanggalInput();
                            targetElem.textContent = getTanggalIndo();
                            targetElem.classList.remove('text-red-500');
                        }
                    }
                });
            });

            // Sisa logic (Radio JK, Foto, Render Lampiran)
            const savedJK = localStorage.getItem("storage_jenis-kelamin-text");
            const targetJK = document.getElementById('jenis-kelamin-text');
            if (savedJK && targetJK) {
                const radioToSelect = document.querySelector(`input[name="jk"][value="${savedJK}"]`);
                if (radioToSelect) radioToSelect.checked = true;
                targetJK.textContent = savedJK;
                targetJK.classList.remove('text-red-500');
            }

            const savedFoto = localStorage.getItem("storage_foto");
            if (savedFoto) tampilkanGambar(savedFoto);

            renderInputs();
        });
        // --- LOGIKA LAMPIRAN DOKUMEN ---
        let daftarDokumen = JSON.parse(localStorage.getItem("storage_list_dokumen_paklaring")) || [""];

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
            localStorage.setItem("storage_list_dokumen_paklaring", JSON.stringify(daftarDokumen));
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
                localStorage.setItem("storage_list_dokumen_paklaring", JSON.stringify(daftarDokumen));
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



        function getTanggalInput(dateObj = new Date()) {
            return dateObj.toISOString().split('T')[0];
        }
    </script>
@endpush
