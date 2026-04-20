@extends('layouts.app')

@section('content')
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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-5" x-data="{
        selectedTemplate: 'ats-classic',
        baseUrl: '/img/cv/',
        open: false,
        templates: [
            { id: 'ats-classic', nama: 'ATS Classic (Standard)', gambar: '/img/cv/cv1.jpg' },
            { id: 'modern-blod', nama: 'Modern Blod', gambar: '/img/cv/cv2.jpg' }
        ]
    }">

        <div class="order-1 md:order-2 p-5 bg-white border rounded-xl flex flex-col h-[700px]">
            <h3 class="font-bold border-b pb-2 text-gray-700">Form Input</h3>

            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                <button onclick="openTab(event, 'Head')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 focus:outline-none flex-shrink-0">
                    Sidebar
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

                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Pilih Desain CV (Template)</label>
                    <div class="relative">
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="relative w-full cursor-default rounded-md bg-white py-3 pl-4 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm">
                            <span class="flex items-center">
                                <img :src="templates.find(t => t.id === selectedTemplate)?.gambar"
                                    class="h-6 w-6 flex-shrink-0 rounded-full object-cover border">
                                <span x-text="templates.find(t => t.id === selectedTemplate)?.nama"
                                    class="ml-3 block truncate font-medium"></span>
                            </span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <ul x-show="open" x-transition
                            class="absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 sm:text-sm">
                            <template x-for="template in templates" :key="template.id">
                                <li class="text-gray-900 relative cursor-pointer select-none py-3 pl-3 pr-9 hover:bg-blue-50"
                                    role="option"
                                    @click="
                                        selectedTemplate = template.id;
                                        open = false;
                                        document.getElementById('panzoom-element').style.backgroundImage = 'url(' + template.gambar + ')';
                                    ">
                                    <div class="flex items-center space-x-4">
                                        <img :src="template.gambar"
                                            class="h-10 w-10 flex-shrink-0 rounded object-cover border">
                                        <div>
                                            <span x-text="template.nama" class="block font-medium truncate"></span>
                                            <span class="text-xs text-gray-500">Klik untuk memilih</span>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <input type="hidden" name="template_id" :value="selectedTemplate">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
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

            <div id="panzoom-element"
                class="bg-white shadow-2xl p-10 origin-top flex-shrink-0 text-justify transition-all duration-300"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size: 12pt; background-size: cover; background-position: center; background-image: url('/img/cv/cv1.jpg');">

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
@endsection
