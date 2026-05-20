@extends('layouts.app')

@section('title', 'Membuat Text Body Email Lamaran Online Gratis')

@section('content')
    <link rel="stylesheet" href="/css/lamaranPekerjaan.css">

    <div class="mb-8 text-center px-4 mt-28">
        <span
            class="inline-block px-3 py-1 mb-3 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full dark:bg-slate-800 dark:text-blue-400">
            Email Body Generator
        </span>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Kirim Lamaran Kerja <span class="text-blue-600">Otomatis ke HRD</span>
        </h1>

        <div class="mt-3 max-w-2xl mx-auto">
            <p class="text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Nggak perlu pusing mikir kata-kata pengantar. Isi formulir, salin teks berformat tabel, atau langsung <span
                    class="font-semibold italic">kirim otomatis</span> langsung ke aplikasi email kamu dengan rapi.
            </p>
        </div>

        <div class="mt-4 flex justify-center items-center space-x-2 text-sm text-slate-400 italic">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span>Kami mendoakan kesuksesan karir Anda di tempat tujuan.</span>
        </div>

        <div class="mt-6 w-24 h-1 bg-blue-600 mx-auto rounded-full opacity-20"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-5">

        @php
            // Konfigurasi Tab
            $tabs = [
                ['id' => 'email_subjek', 'label' => 'Email & Subjek'],
                ['id' => 'Head', 'label' => 'Head'],
                ['id' => 'pengawalan', 'label' => 'Pengawalan'],
                ['id' => 'data-diri', 'label' => 'Data Diri'],
                ['id' => 'dokumen', 'label' => 'Lampiran'],
            ];

            // Definisi Field Email & Subjek

            $allFields = [
                'email_hrd' => [
                    [
                        'id' => 'email_tujuan',
                        'label' => 'Email HRD',
                        'targets' => ['email-text'],
                        'default' => 'contoh@gawedokumen.com',
                    ],
                    [
                        'id' => 'subjek_custom',
                        'label' => 'Subjek Email (Opsional)',
                        'targets' => ['subjek-text'],
                        'default' => 'Lamaran Pekerjaan',
                    ],
                ],
                'head' => [
                    [
                        'id' => 'pt',
                        'label' => 'Nama Perusahaan',
                        'targets' => ['pt-text', 'pt2-text', 'pt3-text'],
                        'default' => 'PT. xxxxxxxx',
                    ],
                    [
                        'id' => 'alamat-perusahaan',
                        'label' => 'Alamat Perusahaan',
                        'targets' => ['alamat-perusahaan-text'],
                        'default' => 'Jl. xxxxxxxx',
                    ],
                    [
                        'id' => 'kota-perusahaan',
                        'label' => 'Kota Perusahaan',
                        'targets' => ['kota-perusahaan-text'],
                        'default' => 'Kota Perusahaan',
                    ],
                ],
                'pengawalan' => [
                    [
                        'id' => 'media',
                        'label' => 'Media Informasi',
                        'targets' => ['media-text'],
                        'default' => 'Media Sosial',
                    ],
                    [
                        'id' => 'posisi',
                        'label' => 'Posisi Kerja',
                        'targets' => ['posisi-text', 'posisi2-text'],
                        'default' => 'Posisi Kerja',
                    ],
                ],
                'dataDiri' => [
                    [
                        'id' => 'nama',
                        'label' => 'Nama Lengkap',
                        'targets' => ['nama-text', 'nama2-text'],
                        'default' => 'Nama Lengkap',
                    ],
                    [
                        'id' => 'tempat-lahir',
                        'label' => 'Tempat Lahir',
                        'targets' => ['tempat-lahir-text'],
                        'default' => 'Tempat Lahir',
                    ],
                    [
                        'id' => 'alamat-diri',
                        'label' => 'Alamat Sekerang',
                        'targets' => ['alamat-diri-text'],
                        'default' => 'Alamat Sekarang',
                    ],
                    [
                        'id' => 'no-tlp',
                        'label' => 'Nomor Telepon',
                        'targets' => ['no-tlp-text'],
                        'default' => '08xxxxxxxxxx',
                    ],
                ],
            ];

            // Konfigurasi untuk JS binding otomatis
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
            $jsConfig[] = [
                'inputId' => 'tanggal',
                'targets' => ['tanggal-text'],
                'default' => 'DATE_NOW',
                'isDate' => true,
            ];
            $jsConfig[] = [
                'inputId' => 'tanggal-lahir',
                'targets' => ['tanggal-lahir-text'],
                'default' => 'DATE_NOW',
                'isDate' => true,
            ];
        @endphp

        <div class="order-1 md:order-2 p-5 bg-white border rounded-xl flex flex-col h-[700px]">
            <h3 class="font-bold border-b pb-2 text-gray-700">Form Input</h3>

            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                @foreach ($tabs as $index => $tab)
                    <button onclick="openTab(event, '{{ $tab['id'] }}')"
                        class="tab-link py-2 px-4 text-sm font-medium border-b-2 {{ $index == 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500' }} hover:text-gray-700 hover:border-gray-300 focus:outline-none flex-shrink-0">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="flex-1 overflow-y-auto pr-1 scrollbar-thin">
                <div id="email_subjek" class="tab-content space-y-4">
                    @foreach ($allFields['email_hrd'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')">
                        </div>
                    @endforeach
                </div>

                <div id="Head" class="tab-content hidden space-y-4">
                    @foreach ($allFields['head'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')">
                        </div>
                    @endforeach

                </div>

                <div id="pengawalan" class="tab-content hidden space-y-4">
                    @foreach ($allFields['pengawalan'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')">
                        </div>
                    @endforeach
                </div>

                <div id="data-diri" class="tab-content hidden space-y-4">
                    @foreach ($allFields['dataDiri'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            <input type="text" id="{{ $field['id'] }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                oninput="myFunction('{{ $field['id'] }}', '{{ $field['targets'][0] }}', '{{ $field['default'] }}')">
                        </div>
                    @endforeach
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="radio" name="jk" value="{{ $jk }}" class="hidden peer"
                                        onclick="myFunctionRadio('jk', 'jenis-kelamin-text', 'Jenis Kelamin')">
                                    <div
                                        class="px-4 py-2 border border-slate-300 rounded-lg peer-checked:bg-blue-500 peer-checked:text-white transition-all">
                                        {{ $jk }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="tanggal-lahir"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                            oninput="myFunction('tanggal-lahir', 'tanggal-lahir-text', getTanggalIndo())">
                    </div>
                </div>

                <div id="dokumen" class="tab-content hidden space-y-4">
                    <div class="flex justify-between items-center mt-2">
                        <label class="block text-sm font-medium text-gray-700">Daftar Lampiran</label>
                        <button onclick="tambahBarisInput()"
                            class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-all">
                            + Tambah Baris
                        </button>
                    </div>
                    <div id="container-input-dokumen" class="space-y-2 pb-4"></div>
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

                <button id="btn-copy-toolbar" title="Salin Teks Berbentuk Tabel untuk Email"
                    class="flex items-center gap-1.5 p-1.5 sm:p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                    <span class="hidden sm:block text-xs font-bold uppercase tracking-wider">Copy</span>
                </button>

                <button id="btn-kirim-toolbar" title="Kirim ke Email HRD (Otomatis)"
                    class="flex items-center gap-1.5 p-1.5 sm:p-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-all shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <span class="hidden sm:block text-xs font-bold uppercase tracking-wider">Kirim</span>
                </button>
            </div>

            <div id="panzoom-element"
                class="bg-white shadow-2xl origin-top flex-shrink-0 flex flex-col rounded-xl border border-slate-200"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size:12pt; font-family: Arial, sans-serif;">

                <div
                    class="bg-slate-50 border-b border-slate-200 p-4 rounded-t-xl text-sm text-slate-600 space-y-2 text-left">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold w-16 text-slate-400">Kepada:</span>
                        <div class="bg-slate-200/70 px-2 py-0.5 rounded text-slate-700 font-medium">
                            <span id="email-text"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 border-t border-slate-100 pt-2">
                        <span class="font-semibold w-16 text-slate-400">Subjek:</span>
                        <span class="font-bold text-slate-800" id="subjek-text"></span>
                    </div>
                </div>

                <div class="p-8 flex-1 overflow-y-auto text-justify text-slate-800" style="line-height: 1.6;">


                    <div class="jarak-paragraf text-left mb-4">
                        Yth. HRD <span id="pt-text" class=" text-slate-900"></span><br>
                        <span id="alamat-perusahaan-text"></span> <br>
                        di <span id="kota-perusahaan-text"></span> <br>
                    </div>

                    <div class="jarak-paragraf text-left mb-4">With compliments / Dengan Hormat,</div>

                    <div class="jarak-paragraf text-justify mb-4">
                        Sehubungan dengan informasi lowongan kerja yang saya dapatkan di <span id="media-text"
                            class=""></span>,
                        saya mengetahui bahwa perusahaan <span id="pt2-text" class=""></span> sedang mencari
                        posisi <span id="posisi-text" class=""></span>.
                        Untuk itu, saya yang bertanda tangan di bawah ini:
                    </div>

                    <div class="jarak-paragraf mb-4">
                        <table
                            class="text-left bg-slate-50/50 border border-slate-100 rounded-xl p-3 block sm:inline-block">
                            <tr class="align-top">
                                <td style="width: 150px; padding: 4px 0;">Nama</td>
                                <td style="padding: 4px 0;">&nbsp;:&nbsp;</td>
                                <td style="padding: 4px 0;" class="font-medium text-slate-900"><span
                                        id="nama-text"></span></td>
                            </tr>
                            <tr class="align-top">
                                <td style="padding: 4px 0;">Jenis Kelamin</td>
                                <td style="padding: 4px 0;">&nbsp;:&nbsp;</td>
                                <td style="padding: 4px 0;"><span id="jenis-kelamin-text"></span></td>
                            </tr>
                            <tr class="align-top">
                                <td style="padding: 4px 0;">Tempat/Tanggal lahir</td>
                                <td style="padding: 4px 0;">&nbsp;:&nbsp;</td>
                                <td style="padding: 4px 0;"><span id="tempat-lahir-text"></span>, <span
                                        id="tanggal-lahir-text"></span></td>
                            </tr>
                            <tr class="align-top">
                                <td style="padding: 4px 0;">Alamat</td>
                                <td style="padding: 4px 0;">&nbsp;:&nbsp;</td>
                                <td style="padding: 4px 0;"><span id="alamat-diri-text"></span></td>
                            </tr>
                            <tr class="align-top">
                                <td style="padding: 4px 0;">Nomor telepon</td>
                                <td style="padding: 4px 0;">&nbsp;:&nbsp;</td>
                                <td style="padding: 4px 0;"><span id="no-tlp-text"></span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="jarak-paragraf text-justify mb-4">
                        Dengan ini bermaksud untuk melamar posisi <span id="posisi2-text" class=""></span>
                        di <span id="pt3-text" class=""></span>.
                        Sebagai bahan pertimbangan, saya sertakan beberapa dokumen berikut:
                    </div>

                    <div class="jarak-paragraf mb-4" style="list-style-type: disc; margin-left: 20px;">
                        <ol id="dokumen-text" class="list-decimal ml-5 text-red-500 font-medium"></ol>
                    </div>

                    <div class="jarak-paragraf text-justify mb-6">
                        Besar harapan saya untuk dapat mengikuti tahapan seleksi selanjutnya. Demikian permohonan ini saya
                        sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.
                    </div>

                    <div class="jarak-paragraf text-left border-t border-slate-100 pt-4">
                        <span class="block text-sm text-slate-400">Hormat saya,</span>
                        <span class="block font-bold text-slate-900 mt-1" id="nama2-text"></span>
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
                Cara Menggunakan Generator Body Email & Etika Mengirimnya
            </h2>

            <div class="space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <div class="space-y-4">
                    <p>
                        Menulis kalimat pengantar di body email (cover letter) seringkali membingungkan. Di
                        <strong>Gawe Dokumen</strong>, kami menyediakan generator otomatis yang menyusun teks pengantar
                        resmi, lengkap dengan format data diri yang tegak lurus dan rapi saat diterima oleh HRD.
                    </p>
                    <p>
                        Cukup isi data diri Anda pada tab-tab di atas. Data yang Anda masukkan akan langsung terformat
                        otomatis. Demi keamanan privasi, data Anda hanya disimpan di dalam browser Anda sendiri (Local
                        Storage) dan
                        <strong>tidak akan pernah dikirim atau disimpan di server kami</strong>.
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">1. Email & Subjek</h3>
                        <p>
                            Masukkan alamat email HRD perusahaan tujuan dengan teliti. Pada kolom subjek, gunakan format
                            standar profesional seperti
                            <strong>"Lamaran Pekerjaan - [Posisi] - [Nama Anda]"</strong>. Jika dikosongkan, sistem kami
                            akan membuatkan subjek otomatis tersebut untuk Anda.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">2. Data Diri Otomatis Rapi</h3>
                        <p>
                            Format teks data diri pada tombol <strong>Kirim</strong> dan <strong>Copy</strong> sudah
                            dilengkapi dengan enkripsi spasi khusus. Ini memastikan tanda titik dua (`:`) pada data pribadi
                            Anda tetap lurus, sejajar, dan tidak berantakan saat dibuka oleh HRD melalui komputer maupun
                            aplikasi Gmail di HP.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">3. Daftar Lampiran</h3>
                        <p>
                            Tuliskan berkas apa saja yang Anda lampirkan di dalam email (misalnya: CV, Portofolio, atau
                            Ijazah). Menyebutkan daftar lampiran di body email berfungsi sebagai penanda bagi HRD bahwa ada
                            berkas penting di bawah pesan Anda yang wajib mereka periksa.
                        </p>
                    </div>
                </div>

                {{-- Tips Card (Sama Pakai Tema Biru / Blue) --}}
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 p-8 rounded-[2rem] border border-blue-100 dark:border-blue-800/50">
                    <h3 class="font-bold text-blue-900 dark:text-blue-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tips Penting Mengirim Lamaran via Email:
                    </h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm text-blue-800/80 dark:text-blue-200/80">
                        <li><strong>Jangan Pernah Kosongkan Body Email:</strong> Mengirim email tanpa teks pengantar (hanya
                            melampirkan file) dianggap tidak sopan oleh HRD dan berpotensi besar membuat email Anda otomatis
                            masuk ke folder **Spam**.</li>
                        <li><strong>Wajib Lampirkan Berkas (Attachment):</strong> Tombol kirim otomatis kami berfungsi
                            mengisikan teks pembuka, tujuan, dan subjek. Setelah aplikasi Gmail terbuka, **ingatlah untuk
                            melampirkan file CV (PDF)** Anda terlebih dahulu sebelum menekan tombol kirim email.</li>
                        <li><strong>Gunakan Email Profesional:</strong> Kirimkan lamaran menggunakan nama email yang formal
                            (contoh: *eri.hidayat@email.com*), hindari menggunakan nama email yang tidak serius atau
                            menggunakan nama samaran.</li>
                    </ul>
                </div>
            </div>
        </div>
    </article>

    {{-- FAQ KHUSUS EMAIL LAMARAN (Warna Judul Biru) --}}
    <section class="mt-20 border-t border-slate-100 dark:border-slate-800 pt-16 px-5">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 text-center">
                Pertanyaan Seputar <span class="text-blue-600">Pengiriman Email Lamaran</span>
            </h2>

            <div class="space-y-4" x-data="{ active: null }">

                {{-- Item 1 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 1 ? active = 1 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apa bedanya tombol Copy dan tombol Kirim di
                            toolbar?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Tombol <strong>Kirim</strong> akan langsung membuka aplikasi Gmail/Outlook di HP atau Laptop Anda
                        dengan data tujuan, subjek, dan isi yang sudah terisi otomatis (instan). Sedangkan tombol
                        <strong>Copy</strong> menyalin struktur tabel teks ke clipboard, sehingga jika Anda melakukan
                        *paste* secara manual di Gmail, layout data diri Anda akan berbentuk kolom tabel yang lurus
                        sempurna.
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 2 ? active = 2 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Kenapa file PDF/CV saya tidak ikut terlampir
                            otomatis saat klik Kirim?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Demi keamanan privasi global, seluruh web browser dan sistem operasi melarang keras sebuah website
                        untuk menyisipkan berkas lokal secara otomatis ke dalam aplikasi email pihak ketiga. Jadi, Anda
                        wajib menekan ikon klip kertas (attachment) di Gmail secara manual untuk mengunggah file CV Anda.
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <button @click="active !== 3 ? active = 3 : active = null"
                        class="flex items-center justify-between w-full p-6 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 transition-all">
                        <span class="font-bold text-slate-900 dark:text-white">Apakah format teks ini aman dari sensor
                            penyaringan HRD?</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="p-6 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                        Sangat aman. Sistem kami menyusun kata-kata pembuka dan penutup menggunakan bahasa baku, sopan,
                        serta langsung *to the point* ke inti maksud lamaran. Format ini sangat disukai oleh HRD karena
                        mereka tidak perlu membuang banyak waktu untuk memahami informasi profil singkat dan berkas yang
                        Anda bawa.
                    </div>
                </div>

            </div>
        </div>
    </section>



    <div id="kirimAdModal"
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
                <button id="btnRealkirim" disabled
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
        let kirimTimer = null;
        let preparedData = {};

        // ==========================================
        // 1. HELPER: UNTUK FORMAT TEXT BIASA (Buat Kirim Email / Mailto)
        // ==========================================
        function generateFormattedTextFromInputs() {
            // Ambil data lampiran terbaru
            const inputLampiran = Array.from(document.querySelectorAll('#container-input-dokumen input'))
                .map(i => i.value).filter(val => val.trim() !== "");
            const lampiranFinal = inputLampiran.length > 0 ? inputLampiran : ["Daftar Lampiran (Belum diisi)"];
            const daftarLampiran = lampiranFinal.map((item, i) => `${i + 1}. ${item}`).join('\n');

            // Ambil semua data dari input form
            const pt = document.getElementById('pt').value || "PT. xxxxxxxx";
            const kotaPerusahaan = document.getElementById('kota-perusahaan').value || "Kota Perusahaan";
            const media = document.getElementById('media').value || "Media Sosial";
            const posisi = document.getElementById('posisi').value || "Posisi Kerja";
            const nama = document.getElementById('nama').value || "Nama Lengkap";
            const jk = document.querySelector('input[name="jk"]:checked')?.value || "Laki-laki";
            const tempatLahir = document.getElementById('tempat-lahir').value || "Tempat Lahir";

            const tanggalLahirRaw = document.getElementById('tanggal-lahir').value;
            const tanggalLahir = (tanggalLahirRaw && window.getTanggalIndo) ?
                getTanggalIndo(new Date(tanggalLahirRaw)) :
                (tanggalLahirRaw || "Tanggal Lahir");

            const alamatDiri = document.getElementById('alamat-diri').value || "Alamat Sekarang";
            const noTlp = document.getElementById('no-tlp').value || "08xxxxxxxxxx";

            // TRIK SAKTI: Kita pakai spasi Unicode kaku (\u00A0 / No-Break Space)
            // Spasi ini tidak akan dipotong atau diciutkan oleh browser maupun Gmail lewat mailto!
            const s = "\u00A0"; // Kita simpan di variabel 's' biar kodenya pendek

            const dataDiriClean = [
                `Nama${s.repeat(21)}: ${nama}`,
                `Jenis Kelamin${s.repeat(9)}: ${jk}`,
                `Tempat/Tgl Lahir${s.repeat(4)}: ${tempatLahir}, ${tanggalLahir}`,
                `Alamat${s.repeat(19)}: ${alamatDiri}`,
                `No. Telepon${s.repeat(11)}: ${noTlp}`
            ].join('\n');

            return `Yth. HRD ${pt}
di ${kotaPerusahaan}

Dengan hormat,

Sehubungan dengan informasi lowongan kerja yang saya dapatkan melalui ${media}, saya bermaksud melamar posisi ${posisi} di perusahaan yang Bapak/Ibu pimpin.

Berikut adalah data singkat saya:
${dataDiriClean}

Sebagai bahan pertimbangan, saya sertakan dokumen berikut:
${daftarLampiran}

Besar harapan saya untuk dapat mengikuti tahapan seleksi selanjutnya. Demikian permohonan ini saya sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.

Hormat saya,

${nama}`;
        }

        // ==========================================
        // 2. EVENT LISTENER: TOMBOL COPY (Mendukung Format Tabel Rapi)
        // ==========================================
        document.getElementById('btn-copy-toolbar').addEventListener('click', function() {
            const pt = document.getElementById('pt').value || "PT. xxxxxxxx";
            const kotaPerusahaan = document.getElementById('kota-perusahaan').value || "Kota Perusahaan";
            const media = document.getElementById('media').value || "Media Sosial";
            const posisi = document.getElementById('posisi').value || "Posisi Kerja";
            const nama = document.getElementById('nama').value || "Nama Lengkap";
            const jk = document.querySelector('input[name="jk"]:checked')?.value || "Laki-laki";
            const tempatLahir = document.getElementById('tempat-lahir').value || "Tempat Lahir";

            const tanggalLahirRaw = document.getElementById('tanggal-lahir').value;
            const tanggalLahir = (tanggalLahirRaw && window.getTanggalIndo) ? getTanggalIndo(new Date(
                tanggalLahirRaw)) : "Tanggal Lahir";

            const alamatDiri = document.getElementById('alamat-diri').value || "Alamat Sekarang";
            const noTlp = document.getElementById('no-tlp').value || "08xxxxxxxxxx";

            const inputLampiran = Array.from(document.querySelectorAll('#container-input-dokumen input')).map(i => i
                .value).filter(val => val.trim() !== "");
            const lampiranFinal = inputLampiran.length > 0 ? inputLampiran : ["Daftar Lampiran (Belum diisi)"];

            // Generate elemen list untuk versi HTML dan Plain Text
            const daftarLampiranHTML = lampiranFinal.map(item => `<li>${item}</li>`).join('');
            const plainText = generateFormattedTextFromInputs();

            // Skenario HTML: Menggunakan susunan table agar 100% tegak lurus pas di-paste ke Gmail
            const htmlContainer = `
        <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">
            <p>Yth. HRD ${pt}<br>di ${kotaPerusahaan}</p>
            <p>Dengan hormat,</p>
            <p>Sehubungan dengan informasi lowongan kerja yang saya dapatkan melalui ${media}, saya bermaksud melamar posisi ${posisi} di perusahaan yang Bapak/Ibu pimpin.</p>
            <p>Berikut adalah data singkat saya:</p>

            <table style="border-collapse: collapse; width: auto; font-family: Arial, sans-serif; font-size: 14px; margin-bottom: 15px;">
                <tr><td style="padding: 2px 10px 2px 0; width: 140px; vertical-align: top;">Nama</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${nama}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Jenis Kelamin</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${jk}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Tempat/Tgl Lahir</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${tempatLahir}, ${tanggalLahir}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Alamat</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${alamatDiri}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">No. Telepon</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${noTlp}</td></tr>
            </table>

            <p>Sebagai bahan pertimbangan, saya sertakan dokumen berikut:</p>
            <ol style="margin-top: 5px; padding-left: 20px;">${daftarLampiranHTML}</ol>
            <p>Besar harapan saya untuk dapat mengikuti tahapan seleksi selanjutnya. Demikian permohonan ini saya sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.</p>
            <p>Hormat saya,<br><br><strong>${nama}</strong></p>
        </div>
    `;

            // Ambil Blob data untuk disalin sebagai Rich Text
            const blobHTML = new Blob([htmlContainer], {
                type: 'text/html'
            });
            const blobText = new Blob([plainText], {
                type: 'text/plain'
            });

            // Gunakan ClipboardItem API agar format tabel terbawa saat dipaste ke Gmail/Outlook
            const dataItem = [new ClipboardItem({
                'text/html': blobHTML,
                'text/plain': blobText
            })];

            navigator.clipboard.write(dataItem).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = "Copied!";

                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);

                alert("Teks lamaran berbentuk TABEL RAPI berhasil disalin! Tinggal paste ke Gmail.");
            }).catch(err => {
                console.error('Gagal menyalin teks tabel: ', err);
            });
        });

        // ==========================================
        // 3. EVENT LISTENER: TOMBOL KIRIM EMAIL (Direct via Mailto)
        // ==========================================
        // ==========================================
        // 1. HELPER: GENERATE TEXT KHUSUS UNTUK MAILTO (ANTI-KECIL/MENCUT)
        // ==========================================
        function generateMailText() {
            // Ambil lampiran
            const inputLampiran = Array.from(document.querySelectorAll('#container-input-dokumen input'))
                .map(i => i.value).filter(val => val.trim() !== "");
            const lampiranFinal = inputLampiran.length > 0 ? inputLampiran : ["Daftar Lampiran (Belum diisi)"];
            const daftarLampiran = lampiranFinal.map((item, i) => `${i + 1}. ${item}`).join('\n');

            // Ambil value input form
            const pt = document.getElementById('pt').value || "PT. xxxxxxxx";
            const kotaPerusahaan = document.getElementById('kota-perusahaan').value || "Kota Perusahaan";
            const media = document.getElementById('media').value || "Media Sosial";
            const posisi = document.getElementById('posisi').value || "Posisi Kerja";
            const nama = document.getElementById('nama').value || "Nama Lengkap";
            const jk = document.querySelector('input[name="jk"]:checked')?.value || "Laki-laki";
            const tempatLahir = document.getElementById('tempat-lahir').value || "Tempat Lahir";

            const tanggalLahirRaw = document.getElementById('tanggal-lahir').value;
            const tanggalLahir = (tanggalLahirRaw && window.getTanggalIndo) ? getTanggalIndo(new Date(tanggalLahirRaw)) :
                "Tanggal Lahir";

            const alamatDiri = document.getElementById('alamat-diri').value || "Alamat Sekarang";
            const noTlp = document.getElementById('no-tlp').value || "08xxxxxxxxxx";

            // MENGGUNAAN NO-BREAK SPACE (\u00A0) AGAR DI GMAIL TIDAK DI-STRIP MENJADI SATU SPASI
            const s = "\u00A0";
            const dataDiriClean = [
                `Nama${s.repeat(21)}: ${nama}`,
                `Jenis Kelamin${s.repeat(9)}: ${jk}`,
                `Tempat/Tgl Lahir${s.repeat(4)}: ${tempatLahir}, ${tanggalLahir}`,
                `Alamat${s.repeat(19)}: ${alamatDiri}`,
                `No. Telepon${s.repeat(11)}: ${noTlp}`
            ].join('\n');

            return `Yth. HRD ${pt}
di ${kotaPerusahaan}

Dengan hormat,

Sehubungan dengan informasi lowongan kerja yang saya dapatkan melalui ${media}, saya bermaksud melamar posisi ${posisi} di perusahaan yang Bapak/Ibu pimpin.

Berikut adalah data singkat saya:
${dataDiriClean}

Sebagai bahan pertimbangan, saya sertakan dokumen berikut:
${daftarLampiran}

Besar harapan saya untuk dapat mengikuti tahapan seleksi selanjutnya. Demikian permohonan ini saya sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.

Hormat saya,

${nama}`;
        }

        // ==========================================
        // 2. EVENT LISTENER: TOMBOL COPY (Mendukung Copy Tabel HTML)
        // ==========================================
        document.getElementById('btn-copy-toolbar').addEventListener('click', function() {
            const pt = document.getElementById('pt').value || "PT. xxxxxxxx";
            const kotaPerusahaan = document.getElementById('kota-perusahaan').value || "Kota Perusahaan";
            const media = document.getElementById('media').value || "Media Sosial";
            const posisi = document.getElementById('posisi').value || "Posisi Kerja";
            const nama = document.getElementById('nama').value || "Nama Lengkap";
            const jk = document.querySelector('input[name="jk"]:checked')?.value || "Laki-laki";
            const tempatLahir = document.getElementById('tempat-lahir').value || "Tempat Lahir";

            const tanggalLahirRaw = document.getElementById('tanggal-lahir').value;
            const tanggalLahir = (tanggalLahirRaw && window.getTanggalIndo) ? getTanggalIndo(new Date(
                tanggalLahirRaw)) : "Tanggal Lahir";

            const alamatDiri = document.getElementById('alamat-diri').value || "Alamat Sekarang";
            const noTlp = document.getElementById('no-tlp').value || "08xxxxxxxxxx";

            const inputLampiran = Array.from(document.querySelectorAll('#container-input-dokumen input')).map(i => i
                .value).filter(val => val.trim() !== "");
            const lampiranFinal = inputLampiran.length > 0 ? inputLampiran : ["Daftar Lampiran (Belum diisi)"];

            const daftarLampiranHTML = lampiranFinal.map(item => `<li>${item}</li>`).join('');
            const plainText = generateMailText(); // Ambil plain-text cadangan

            // Versi HTML Table (Sempurna saat di-paste manual ke Gmail/Outlook)
            const htmlContainer = `
        <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">
            <p>Yth. HRD ${pt}<br>di ${kotaPerusahaan}</p>
            <p>Dengan hormat,</p>
            <p>Sehubungan dengan informasi lowongan kerja yang saya dapatkan melalui ${media}, saya bermaksud melamar posisi ${posisi} di perusahaan yang Bapak/Ibu pimpin.</p>
            <p>Berikut adalah data singkat saya:</p>

            <table style="border-collapse: collapse; width: auto; font-family: Arial, sans-serif; font-size: 14px; margin-bottom: 15px;">
                <tr><td style="padding: 2px 10px 2px 0; width: 140px; vertical-align: top;">Nama</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${nama}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Jenis Kelamin</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${jk}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Tempat/Tgl Lahir</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${tempatLahir}, ${tanggalLahir}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">Alamat</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${alamatDiri}</td></tr>
                <tr><td style="padding: 2px 10px 2px 0; vertical-align: top;">No. Telepon</td><td style="vertical-align: top;">:</td><td style="padding: 2px 0 2px 10px; vertical-align: top;">${noTlp}</td></tr>
            </table>

            <p>Sebagai bahan pertimbangan, saya sertakan dokumen berikut:</p>
            <ol style="margin-top: 5px; padding-left: 20px;">${daftarLampiranHTML}</ol>
            <p>Besar harapan saya untuk dapat mengikuti tahapan seleksi selanjutnya. Demikian permohonan ini saya sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.</p>
            <p>Hormat saya,<br><br><strong>${nama}</strong></p>
        </div>
    `;

            const blobHTML = new Blob([htmlContainer], {
                type: 'text/html'
            });
            const blobText = new Blob([plainText], {
                type: 'text/plain'
            });

            const dataItem = [new ClipboardItem({
                'text/html': blobHTML,
                'text/plain': blobText
            })];

            navigator.clipboard.write(dataItem).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = "Copied!";
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);
                alert(
                    "Teks lamaran berbentuk TABEL RAPI berhasil disalin! Silakan tempel (paste) di Gmail kamu."
                );
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
        });

        // ==========================================
        // 3. EVENT LISTENER: TOMBOL KIRIM EMAIL (Direct Mailto Link)
        // ==========================================
        document.getElementById('btn-kirim-toolbar').addEventListener('click', function() {
            const emailTujuan = document.getElementById('email_tujuan').value || "";
            const subjekCustom = document.getElementById('subjek_custom').value;
            const posisi = document.getElementById('posisi').value || "Posisi Kerja";
            const nama = document.getElementById('nama').value || "Nama Lengkap";

            // Ambil isi teks yang kebal dari penciutan spasi browser
            const isiEmail = generateMailText();

            // Jika input subjek custom diisi, pakai itu. Jika kosong, pakai format default otomatis.
            const subjekFinal = subjekCustom.trim() !== "" ? subjekCustom :
                `Lamaran Pekerjaan - ${posisi} - ${nama}`;

            const mailtoLink =
                `mailto:${emailTujuan}?subject=${encodeURIComponent(subjekFinal)}&body=${encodeURIComponent(isiEmail)}`;

            window.location.href = mailtoLink;

            alert(
                "Aplikasi email berhasil dibuka!\n\nPENTING: Jangan lupa untuk melampirkan file CV / PDF Anda sebelum menekan tombol kirim di email."
            );
        });


        // 3. FUNGSI TUTUP MODAL & RESET
        function closeAdModal() {
            document.getElementById('kirimAdModal').classList.add('hidden');
            if (kirimTimer) clearInterval(kirimTimer);
        }




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

        // Fungsi khusus untuk menyimpan inputan Email & Subjek ke LocalStorage
        function updateEmailSubjek(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            let nilaiInput = input.value;

            if (nilaiInput.trim() !== "") {
                localStorage.setItem("storage_" + inputId, nilaiInput);
            } else {
                localStorage.removeItem("storage_" + inputId);
            }
        }

        function getTanggalInput(dateObj = new Date()) {
            return dateObj.toISOString().split('T')[0];
        }
    </script>
@endpush
