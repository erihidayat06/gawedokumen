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
        selectedTemplate: '',
        templates: JSON.parse('{{ addslashes($templates) }}'),
        open: false,
    
        init() {
            // 1. Cek apakah ada pilihan sebelumnya di localStorage
            const savedTemplate = localStorage.getItem('selected_cv_template');
    
            if (savedTemplate && this.templates.find(t => t.id === savedTemplate)) {
                this.selectedTemplate = savedTemplate;
            } else if (this.templates.length > 0) {
                // Default ke template pertama jika belum ada simpanan
                this.selectedTemplate = this.templates[0].id;
            }
    
            this.$nextTick(() => {
                this.updateStyles();
            });
        },
    
        updateStyles() {
            const template = this.templates.find(t => t.id === this.selectedTemplate);
            if (!template) return;
    
            // 2. Simpan pilihan terbaru ke localStorage setiap kali ganti
            localStorage.setItem('selected_cv_template', this.selectedTemplate);
    
            // --- Logic Update Styles Tetap Sama ---
            const panzoom = document.getElementById('panzoom-element');
            if (panzoom) panzoom.style.backgroundImage = 'url(' + template.gambar + ')';
    
            document.querySelectorAll('.text-primary-dynamic').forEach(el => el.style.color = template.config.primary);
            document.querySelectorAll('.text-sidebar-dynamic').forEach(el => el.style.color = template.config.sidebarText);
            document.querySelectorAll('.bg-text').forEach(el => el.style.backgroundColor = template.config.bgText);
        }
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
                                        updateStyles();
                                        document.getElementById('panzoom-element').style.backgroundImage = 'url(' + template.gambar + ')';
                                        const primaryTexts = document.querySelectorAll('.text-primary-dynamic');
                                            primaryTexts.forEach(el => {
                                                el.style.color = template.config.primary;
                                            });
                                        const sidebarTexts = document.querySelectorAll('.text-sidebar-dynamic');
                                            sidebarTexts.forEach(el => {
                                                el.style.color = template.config.sidebarText;
                                            });
                                       const bgTexts = document.querySelectorAll('.bg-text');
                                        bgTexts.forEach(el => {
                                            // Gunakan backgroundColor
                                            el.style.backgroundColor = template.config.bgText;
                                        });
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


            <div id="panzoom-element" class="bg-white shadow-2xl origin-top flex flex-row"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size: 12pt;
           background-image: url('/img/cv/cv1.jpg'); background-size: cover; background-repeat: no-repeat;">

                <div class="w-[85mm] flex-shrink-0" style="padding: 10mm 0mm 10mm 10mm;">

                    <div class="flex justify-center pr-[5mm] pt-[5mm]">
                        <img src="/img/cv/765-default-avatar.png" alt="Avatar"
                            class="rounded-full object-cover border-4 border-slate-100 shadow-md" width="220"
                            height="220">
                    </div>

                    <div style="margin-top: 10mm; margin-left: -10mm;"
                        class="rounded-r-xl bg-slate-100 w-[75mm] px-6 py-2 bg-text">
                        <span class="text-[16pt] font-bold tracking-wide uppercase text-primary-dynamic text-[#1d8bbe]">
                            Data Diri
                        </span>
                    </div>

                    <div class="space-y-5 " style="margin-top: 6mm;">
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 text-sidebar-dynamic leading-tight">
                                Tempat/Tanggal Lahir</h3>
                            <p class="text-[12pt] text-slate-100 text-sidebar-dynamic">Tegal, 17 Mei 2004</p>
                        </div>
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 text-sidebar-dynamic leading-tight">Jenis
                                Kelamin</h3>
                            <p class="text-[12pt] text-slate-100 text-sidebar-dynamic">Laki-Laki</p>
                        </div>
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 leading-tight text-sidebar-dynamic">
                                Kewarganegaraan</h3>
                            <p class="text-[12pt] text-slate-100 text-sidebar-dynamic">Indonesia</p>
                        </div>
                    </div>

                    <div style="margin-top: 10mm; margin-left: -10mm;"
                        class="rounded-r-xl bg-slate-100 w-[75mm] px-6 py-2 bg-text">
                        <span class="text-[16pt] font-bold text-[#1d8bbe] tracking-wide uppercase text-primary-dynamic">
                            KONTAK
                        </span>
                    </div>

                    <div class="space-y-5" style="margin-top: 6mm;">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-slate-100 text-sidebar-dynamic">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Telepon</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic">0812-3456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-slate-100 text-sidebar-dynamic">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Email</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic">eri@email.com</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-slate-100 text-sidebar-dynamic">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Alamat</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic">Kota Tegal, Jawa Tengah</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1" style="padding: 15mm 15mm 10mm 15mm;">

                    <div class="border-b-4 border-[#1d8bbe] pb-4">
                        <h1 class="text-[32pt] font-extrabold text-slate-800 leading-none">ERI SUKIRNO</h1>
                        <h2 class="text-[18pt] font-medium text-[#1d8bbe] tracking-[0.2em] uppercase mt-2">Web Developer
                        </h2>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">Profil
                        </h3>
                        <p class="mt-4 text-[12pt] text-slate-600 leading-relaxed">
                            Saya adalah seorang Full-stack Programmer yang berpengalaman mengelola lebih dari 20 proyek web.
                            Ahli dalam penggunaan Laravel dan React JS, serta memiliki minat tinggi dalam digital content
                            creation
                            dan optimasi performa website.
                        </p>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">
                            Pengalaman Kerja</h3>
                        <div class="mt-6 space-y-8">
                            <div>
                                <div class="flex justify-between items-baseline">
                                    <span class="font-bold text-[14pt] text-slate-800">Web Developer - Freelance</span>
                                    <span class="text-[11pt] italic text-slate-500">2024 - Sekarang</span>
                                </div>
                                <p class="text-[12pt] text-slate-600 mt-2">Mengembangkan aplikasi manajemen keuangan (BATI)
                                    untuk UMKM dan membangun platform GaweDokumen dengan optimasi SEO tinggi.</p>
                            </div>
                            <div>
                                <div class="flex justify-between items-baseline">
                                    <span class="font-bold text-[14pt] text-slate-800">Culinary Entrepreneur</span>
                                    <span class="text-[11pt] italic text-slate-500">2026</span>
                                </div>
                                <p class="text-[12pt] text-slate-600 mt-2">Membangun brand Tahu Bakso Goreng K.E.S,
                                    mengelola strategi branding digital, serta operasional harian.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">
                            Pendidikan</h3>
                        <div class="mt-6">
                            <div class="flex justify-between items-baseline">
                                <span class="font-bold text-[14pt] text-slate-800">Teknik Informatika</span>
                                <span class="text-[11pt] text-slate-500">2022 - 2026</span>
                            </div>
                            <p class="text-[12pt] text-slate-600 mt-1">Fokus pada pengembangan web dan sistem informasi.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script src="/js/gawedokumen.js"></script>
@endpush
