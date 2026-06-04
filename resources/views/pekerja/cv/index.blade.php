@extends('layouts.app')
@section('title', 'Membuat Cv Online Otomatis Gratis')


@section('content')
    <div class="mb-8 text-center px-4 mt-28">
        <span
            class="inline-block px-3 py-1 mb-3 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full dark:bg-slate-800 dark:text-blue-400">
            CV Builder Engine
        </span>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Bangun Curriculum Vitae <span class="text-blue-600">Terbaik Anda</span>
        </h1>

        <div class="mt-3 max-w-2xl mx-auto">
            <p class="text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Tampilkan potensi terbaik Anda dengan format yang disukai rekruter. Cukup lengkapi data diri, dan biarkan
                <span class="font-semibold italic">Gawe Dokumen</span> menyusun CV profesional untuk Anda.
            </p>
        </div>

        <div class="mt-4 flex justify-center items-center space-x-2 text-sm text-slate-400 italic">
            <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            <span>Data Anda tersimpan secara lokal dan aman di browser Anda.</span>
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

            <!-- Navigasi Tab -->
            <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-hide mb-4">
                <button onclick="openTab(event, 'sidebar')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 focus:outline-none flex-shrink-0">
                    Sidebar
                </button>
                <button onclick="openTab(event, 'data-diri')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Data Diri
                </button>
                <button onclick="openTab(event, 'kontak')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Kontak
                </button>
                <button onclick="openTab(event, 'profil')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Profil
                </button>
                <button onclick="openTab(event, 'keahlian')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Keahlian
                </button>
                <button onclick="openTab(event, 'pengalaman')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Pengalaman Kerja
                </button>
                <button onclick="openTab(event, 'pendidikan')"
                    class="tab-link py-2 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 focus:outline-none flex-shrink-0">
                    Pendidikan
                </button>
            </div>


            <div class="flex-1 overflow-hidden flex flex-col">
                <form action="/simpan-cv" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Area Konten Tab (Ditambahkan scroll di sini) -->
                    <div id="sidebar" class="tab-content space-y-4  pr-2 ">
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
                    <!-- Tab Data Diri (Sembunyi) -->
                    <div id="data-diri" class="tab-content hidden space-y-4 overflow-y-auto pr-2 scrollbar-thin">
                        @php
                            $dataInputan = [
                                [
                                    'inputId' => 'nama',
                                    'targetId' => 'nama-text',
                                    'label' => 'Nama Lengkap',
                                    'defaultText' => '[Nama Lengkap]',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'profesi',
                                    'targetId' => 'profesi-text',
                                    'label' => 'Profesi',
                                    'defaultText' => '[Nama Profesi]',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'tempat-lahir',
                                    'targetId' => 'tempat-lahir-text',
                                    'label' => 'Tempat Lahir',
                                    'defaultText' => 'Jakarta',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'tanggal-lahir',
                                    'targetId' => 'tanggal-lahir-text',
                                    'label' => 'Tanggal Lahir',
                                    'defaultText' => '01 Januari 2000',
                                    'type' => 'date',
                                ],
                                [
                                    'inputId' => 'jk', // name untuk radio
                                    'targetId' => 'jenis-kelamin-text',
                                    'label' => 'Jenis Kelamin',
                                    'defaultText' => 'Laki-Laki',
                                    'type' => 'radio',
                                    'options' => ['Laki-Laki', 'Perempuan'],
                                ],
                                [
                                    'inputId' => 'kewarganegaraan',
                                    'targetId' => 'kewarganegaraan-text',
                                    'label' => 'Kewarganegaraan',
                                    'defaultText' => 'Indonesia',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'telp',
                                    'targetId' => 'telp-text',
                                    'label' => 'Telephon/WA (Aktif)',
                                    'defaultText' => '08xxxxxxxxx',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'email',
                                    'targetId' => 'email-text',
                                    'label' => 'Email',
                                    'defaultText' => 'nama@example.com',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'alamat',
                                    'targetId' => 'alamat-text',
                                    'label' => 'Alamat',
                                    'defaultText' => 'Jl xxxxxxxxx',
                                    'type' => 'text',
                                ],
                                [
                                    'inputId' => 'profile',
                                    'targetId' => 'profil-text',
                                    'label' => 'Profil Profesional',
                                    'defaultText' =>
                                        'Saya seorang [Pekerjaan] yang ahli dalam [Keahlian]. Berpengalaman selama [Jumlah] tahun dalam membangun solusi digital yang efisien dan skalabel.',
                                    'type' => 'textarea',
                                ],
                            ];
                        @endphp

                        <!-- Input Gambar di Form -->
                        <div class="mb-3">
                            <label class="block text-sm font-bold text-gray-700">Foto Profil</label>
                            <input type="file" id="input-avatar" accept="image/*" onchange="handleImageUpload(this)"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                            <p class="text-xs text-gray-400 ">*Gunakan foto formal dengan latar belakang polos untuk
                                hasil
                                terbaik.</p>
                        </div>

                        @foreach (array_slice($dataInputan, 0, 6) as $item)
                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">{{ $item['label'] }}</label>

                                {{-- JIKA INPUT TEXT ATAU DATE --}}
                                @if ($item['type'] == 'text' || $item['type'] == 'date')
                                    <input type="{{ $item['type'] }}" id="{{ $item['inputId'] }}"
                                        name="{{ $item['inputId'] }}" placeholder="{{ 'Contoh: ' . $item['defaultText'] }}"
                                        oninput="updatePreview('{{ $item['inputId'] }}', '{{ $item['targetId'] }}', '{{ $item['defaultText'] }}')"
                                        class="w-full border p-2 rounded">

                                    {{-- JIKA RADIO BUTTON --}}
                                @elseif($item['type'] == 'radio')
                                    <div class="flex gap-4 p-2 border rounded">
                                        @foreach ($item['options'] as $opt)
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="{{ $item['inputId'] }}"
                                                    value="{{ $opt }}" name="{{ $item['inputId'] }}"
                                                    onchange="updatePreviewRadio(this, '{{ $item['targetId'] }}')"
                                                    class="mr-2">
                                                <span class="text-sm">{{ $opt }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Tab Kontak (Sembunyi) -->
                    <div id="kontak" class="tab-content hidden space-y-4 overflow-y-auto pr-2 scrollbar-thin">
                        @foreach (array_slice($dataInputan, 6, 3) as $item)
                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">{{ $item['label'] }}</label>
                                <input type="{{ $item['type'] }}" id="{{ $item['inputId'] }}"
                                    name="{{ $item['inputId'] }}" placeholder="{{ 'Contoh: ' . $item['defaultText'] }}"
                                    oninput="updatePreview('{{ $item['inputId'] }}', '{{ $item['targetId'] }}', '{{ $item['defaultText'] }}')"
                                    class="w-full border p-2 rounded">

                                {{-- JIKA RADIO BUTTON --}}

                            </div>
                        @endforeach
                    </div>
                    <div id="profil" class="tab-content hidden space-y-4 overflow-y-auto pr-2 scrollbar-thin">
                        @foreach (array_slice($dataInputan, 9, 1) as $item)
                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">{{ $item['label'] }}</label>

                                <textarea name="{{ $item['inputId'] }}" id="{{ $item['inputId'] }}"
                                    oninput="updatePreview('{{ $item['inputId'] }}', '{{ $item['targetId'] }}', '{{ $item['defaultText'] }}')"
                                    class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none" rows="5"
                                    placeholder="Contoh: {{ $item['defaultText'] }}"></textarea> {{-- Pastikan rapat seperti ini --}}



                            </div>
                        @endforeach
                    </div>
                    <div id="keahlian" class="tab-content hidden space-y-4">
                        <div id="skill-list" class="space-y-4"></div>
                        <button type="button" onclick="addItem('skill')"
                            class="w-full py-3 border-2 border-dashed border-purple-300 text-purple-600 rounded-lg hover:bg-purple-50 transition font-medium">
                            + Tambah Keahlian
                        </button>
                    </div>
                    <div id="pengalaman" class="tab-content hidden space-y-4 overflow-y-auto pr-2 scrollbar-thin">
                        <div id="experience-list" class="space-y-4 p-3"></div>
                        <button type="button" onclick="addItem('experience')"
                            class="w-full py-3 border-2 border-dashed border-blue-300 text-blue-600 rounded-lg">
                            + Tambah Pengalaman
                        </button>
                    </div>
                    <div id="pendidikan" class="tab-content hidden space-y-4 overflow-y-auto pr-2 scrollbar-thin">
                        <div id="education-list" class="space-y-4 p-3"></div>
                        <button type="button" onclick="addItem('education')"
                            class="w-full py-3 border-2 border-dashed border-green-300 text-green-600 rounded-lg">
                            + Tambah Pendidikan
                        </button>
                    </div>

                    <!-- Template Kerangka Input (Sembunyi) -->
                    <template id="experience-template">
                        <div
                            class="experience-item p-4 border border-gray-200 rounded-lg bg-white relative mb-4 group hover:border-blue-200 transition-colors shadow-sm">

                            <!-- Perbaikan: Gunakan removeItem dengan parameter 'experience' -->
                            <button onclick="removeItem(this, 'experience')" type="button"
                                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-all duration-200 z-10"
                                title="Hapus Pengalaman">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 gap-3">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Jabatan &
                                        Instansi</label>
                                    <!-- Perbaikan: Gunakan renderPreview('experience') -->
                                    <input type="text" placeholder="Contoh: Web Developer - Freelance"
                                        oninput="renderPreview('experience')"
                                        class="exp-title w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-blue-500 outline-none">
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Periode</label>
                                    <input type="text" placeholder="Contoh: 2024 - Sekarang"
                                        oninput="renderPreview('experience')"
                                        class="exp-year w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-blue-500 outline-none">
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Deskripsi</label>
                                    <textarea placeholder="Ceritakan pencapaian atau tugas Anda..." oninput="renderPreview('experience')"
                                        class="exp-desc w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-blue-500 outline-none"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Template Pendidikan -->
                    <template id="education-template">
                        <div
                            class="education-item p-4 border border-gray-200 rounded-lg bg-white relative mb-4 group hover:border-green-200 transition-all shadow-sm">

                            <!-- Tombol Hapus Universal -->
                            <button onclick="removeItem(this, 'education')" type="button"
                                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-all z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 gap-3">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase">Nama Instansi</label>
                                        <input type="text" placeholder="Contoh: Universitas Tegal"
                                            oninput="renderPreview('education')"
                                            class="edu-school w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-green-500 outline-none">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase">Tahun</label>
                                        <input type="text" placeholder="2020 - 2024"
                                            oninput="renderPreview('education')"
                                            class="edu-year w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-green-500 outline-none">
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase">Jurusan / Gelar</label>
                                    <input type="text" placeholder="S1 Teknik Informatika"
                                        oninput="renderPreview('education')"
                                        class="edu-degree w-full border border-gray-300 p-2 rounded text-sm focus:ring-1 focus:ring-green-500 outline-none">
                                </div>
                            </div>
                        </div>
                    </template>

                    <template id="skill-template">
                        <div
                            class="skill-item p-4 border border-gray-200 rounded-lg bg-white relative mb-4 group hover:border-purple-200 transition-colors shadow-sm">
                            <button onclick="removeItem(this, 'skill')" type="button"
                                class="absolute -top-2 -right-2 bg-red-500 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            <div class="grid grid-cols-1 gap-3">
                                <input type="text" placeholder="Nama Keahlian (Contoh: Web Development)"
                                    oninput="renderPreview('skill')"
                                    class="skill-name w-full border p-2 rounded text-sm focus:ring-1 focus:ring-purple-500 outline-none">
                            </div>
                        </div>
                    </template>



                    <input type="hidden" id="foto_base64">
                    <input type="hidden" name="warna_tema" id="warna_tema" value="#3b82f6">


                </form>
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


            <div id="panzoom-element" class="bg-white shadow-2xl origin-top flex flex-row box-border"
                style="width: 210mm; height: 297mm; min-width: 210mm; min-height: 297mm; font-size: 12pt; font-family: 'Arial'; background-image: url('/img/cv/cv1.jpg'); background-size: cover; background-repeat: no-repeat;">

                <div class="w-[85mm] flex-shrink-0" style="padding: 10mm 0mm 10mm 10mm;">

                    <div class="flex justify-center pr-[5.2mm] pt-[5.2mm]">
                        <!-- Tambahkan class aspect-square dan h-auto -->
                        <img id="preview-avatar" src="" alt="Avatar"
                            class="rounded-full object-cover aspect-square border-4 border-slate-100 shadow-md w-[220px] h-[220px]">
                    </div>

                    <div style="margin-top: 10mm; margin-left: -10mm;"
                        class="rounded-r-xl bg-slate-100 w-[75mm] px-6 py-2 bg-text">
                        <span class="text-[16pt] font-bold tracking-wide uppercase text-primary-dynamic text-[#1d8bbe]">
                            Data Diri
                        </span>
                    </div>

                    <div class="space-y-5 " style="margin-top: 3mm;">
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 text-sidebar-dynamic leading-tight">
                                Tempat/Tanggal Lahir</h3>
                            <span class="text-[12pt] text-slate-100 text-sidebar-dynamic" id="tempat-lahir-text"></span>
                            <span class="text-[12pt] text-slate-100 text-sidebar-dynamic" id="tanggal-lahir-text"></span>
                        </div>
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 text-sidebar-dynamic leading-tight">Jenis
                                Kelamin</h3>
                            <p class="text-[12pt] text-slate-100 text-sidebar-dynamic" id="jenis-kelamin-text"></p>
                        </div>
                        <div>
                            <h3 class="text-[13pt] font-bold text-slate-100 leading-tight text-sidebar-dynamic">
                                Kewarganegaraan</h3>
                            <p class="text-[12pt] text-slate-100 text-sidebar-dynamic" id="kewarganegaraan-text">
                            </p>
                        </div>
                    </div>

                    <div style="margin-top: 10mm; margin-left: -10mm;"
                        class="rounded-r-xl bg-slate-100 w-[75mm] px-6 py-2 bg-text">
                        <span class="text-[16pt] font-bold text-[#1d8bbe] tracking-wide uppercase text-primary-dynamic">
                            KONTAK
                        </span>
                    </div>

                    <div class="space-y-5" style="margin-top: 3mm;">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-[16pt] text-slate-100 text-sidebar-dynamic">
                                &#9743;
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Telepon</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic" id="telp-text"></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-[16pt] text-slate-100 text-sidebar-dynamic">
                                &#9993;
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Email</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic" id="email-text"></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-6 text-[16pt] text-slate-100 text-sidebar-dynamic">
                                &#10148;
                            </div>
                            <div>
                                <h3 class="text-[11pt] font-bold text-slate-100 text-sidebar-dynamic">Alamat</h3>
                                <p class="text-[10pt] text-slate-100 text-sidebar-dynamic" id="alamat-text"></p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 10mm; margin-left: -10mm;"
                        class="rounded-r-xl bg-slate-100 w-[75mm] px-6 py-2 bg-text">
                        <span class="text-[16pt] font-bold text-[#1d8bbe] tracking-wide uppercase text-primary-dynamic">
                            KEAHLIAN
                        </span>
                    </div>
                    <!-- Bagian Keahlian di Sidebar -->
                    <div id="preview-skill-list" class="space-y-3" style="margin-top: 3mm; padding-left: 2mm;">
                        <!-- Data akan dirender otomatis di sini -->
                    </div>
                </div>

                <div class="flex-1" style="padding: 15mm 11mm 10mm 12mm; text-align: justify;">

                    <div class="border-b-4 border-[#1d8bbe] pb-1">
                        <h1 class="text-[32pt] font-bold text-slate-800 leading-none" id="nama-text"></h1>
                        <h2 class="inline-block m-0 pb-[10px] text-[18pt] text-[#1d8bbe] tracking-[3px] uppercase font-medium mt-2"
                            id="profesi-text">
                        </h2>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">Profil
                        </h3>
                        <p class="mt-4 text-[12pt] text-slate-600 leading-relaxed" id="profil-text">

                        </p>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">
                            Pengalaman Kerja</h3>
                        <div class="mt-6 space-y-8">
                            <div id="preview-experience-list" class="space-y-4">
                                <!-- Hasil ketikan akan muncul di sini secara otomatis -->
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-[16pt] font-bold text-slate-800 border-l-4 border-[#1d8bbe] pl-3 uppercase">
                            Pendidikan</h3>
                        <div class="mt-6">
                            <div id="preview-education-list" class="space-y-4">
                                <!-- Hasil ketikan akan muncul di sini secara otomatis -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @include('pekerja.tamplate.print_modal')

@endsection


@push('scripts')
    <script src="/js/gawedokumen.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printBtn = document.getElementById('print');
            const modal = document.getElementById('printAdModal');

            // Pengecekan apakah tombol dan modal ada di DOM
            if (!printBtn || !modal) {
                console.error("Elemen 'print' atau 'printAdModal' tidak ditemukan!");
                return;
            }

            const loadingState = document.getElementById('loadingState');
            const readyState = document.getElementById('readyState');
            const btnRealPrint = document.getElementById('btnRealPrint');
            const adTimerText = document.getElementById('adTimer');
            const adTimerSpan = document.getElementById('adTimerSpan');
            const btnText = document.getElementById('btnText');

            let countdown;
            let preparedData = {};

            printBtn.addEventListener('click', function() {
                console.log("Menyiapkan data untuk preview...");

                // Di dalam printBtn.addEventListener
                const avatarPreview = document.getElementById('preview-avatar');
                let fotoData = null;

                // Cek apakah src isinya base64 (diawali dengan data:image...)
                if (avatarPreview.src.startsWith('data:image')) {
                    fotoData = avatarPreview.src;
                } else {
                    // Jika masih gambar default, kirim null atau biarkan kosong
                    fotoData = null;
                }

                // Jalankan handleSubmit secara manual untuk sinkronisasi data terbaru
                handleSubmit();

                // Susun preparedData untuk kebutuhan AJAX/Preview
                preparedData = {
                    _token: "{{ csrf_token() }}",
                    nama: document.getElementById('nama')?.value || "Nama Lengkap",
                    profesi: document.getElementById('profesi')?.value || "Profesi",
                    tempat_lahir: document.getElementById('tempat-lahir')?.value || "",
                    tanggal_lahir: document.getElementById('tanggal-lahir')?.value || "",
                    jk: document.querySelector('input[name="jk"]:checked')?.value || "Laki-Laki",
                    kewarganegaraan: document.getElementById('kewarganegaraan')?.value || "Indonesia",
                    email: document.getElementById('email')?.value || "email@contoh.com",
                    telepon: document.getElementById('telp')?.value || "08xxxx",
                    alamat: document.getElementById('alamat')?.value || "Alamat Lengkap",
                    profil_singkat: document.getElementById('profile')?.value || "",

                    // Ambil data yang sudah di-stringifikasi oleh handleSubmit
                    pengalaman: document.getElementById('pengalaman').value,
                    pendidikan: document.getElementById('pendidikan').value,
                    keahlian: document.getElementById('keahlian').value,

                    template_id: document.getElementById('template-selector')?.value || "1",
                    warna_tema: document.getElementById('warna_tema').value,
                    // INI KRUSIAL: Ambil value terbaru dari input hidden
                    foto_base64: document.getElementById('foto_base64').value || null
                };

                // Log untuk debugging foto
                console.log("Foto Base64 Length:", preparedData.foto_base64 ? preparedData.foto_base64
                    .length : 0);

                // Tampilkan Modal
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
                loadingState.classList.remove('hidden');
                readyState.classList.add('hidden');
                loadingState.classList.remove('hidden');
                readyState.classList.add('hidden');

                btnRealPrint.disabled = true;
                btnRealPrint.className =
                    "w-full py-4 bg-slate-200 text-slate-400 font-bold rounded-2xl transition-all cursor-not-allowed flex items-center justify-center gap-1";
                btnText.innerText = "Tunggu";
                adTimerSpan.classList.remove('hidden');

                let timeLeft = 5;
                adTimerText.innerText = timeLeft;

                if (countdown) clearInterval(countdown);
                countdown = setInterval(() => {
                    timeLeft--;
                    if (timeLeft >= 0) adTimerText.innerText = timeLeft;

                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        showReadyState();
                    }
                }, 1000);
            });

            function handleSubmit() {
                try {
                    // 1. Sinkronisasi Data Dinamis ke Hidden Input
                    const pengalaman = Array.from(document.querySelectorAll('.experience-item')).map(el => ({
                        jabatan: el.querySelector('.exp-title')?.value || '',
                        perusahaan: el.querySelector('.exp-company')?.value || '',
                        tahun: el.querySelector('.exp-year')?.value || '',
                        deskripsi: el.querySelector('.exp-desc')?.value || ''
                    }));
                    document.getElementById('pengalaman').value = JSON.stringify(pengalaman);

                    const pendidikan = Array.from(document.querySelectorAll('.education-item')).map(el => ({
                        instansi: el.querySelector('.edu-school')?.value || '',
                        tahun: el.querySelector('.edu-year')?.value || '',
                        gelar: el.querySelector('.edu-degree')?.value || ''
                    }));
                    document.getElementById('pendidikan').value = JSON.stringify(pendidikan);

                    const keahlian = Array.from(document.querySelectorAll('.skill-item')).map(el =>
                        el.querySelector('.skill-name')?.value || ''
                    ).filter(skill => skill !== '');
                    document.getElementById('keahlian').value = JSON.stringify(keahlian);

                    // 2. Pastikan Foto Terbawa
                    // Ambil dari input hidden yang menampung base64
                    const fotoInput = document.getElementById('foto_base64');
                    if (!fotoInput || !fotoInput.value) {
                        console.warn("Foto kosong, mengirim tanpa foto.");
                    }

                    // 3. Warna Tema
                    const warnaPicker = document.getElementById('warna_tema_picker');
                    if (warnaPicker) {
                        document.getElementById('warna_tema').value = warnaPicker.value;
                    }

                    return true;
                } catch (error) {
                    console.error("Gagal menyiapkan data:", error);
                    return false;
                }
            }

            function showReadyState() {
                loadingState.classList.add('hidden');
                readyState.classList.remove('hidden');
                adTimerSpan.classList.add('hidden');
                btnText.innerText = "Cetak CV Sekarang";
                btnRealPrint.disabled = false;
                btnRealPrint.className =
                    "w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl transition-all shadow-lg active:scale-95 flex items-center justify-center gap-1 cursor-pointer";
            }

            btnRealPrint.addEventListener('click', function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('cv.pdf.generate') }}";
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
                closeAdModal();
            });
        });

        function closeAdModal() {
            const modal = document.getElementById('printAdModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        function updatePreview(inputId, targetId, defaultText) {
            console.log("Mencoba update:", inputId, "ke", targetId);

            const input = document.getElementById(inputId);
            const target = document.getElementById(targetId);

            if (!input || !target) return;

            let nilaiInput = input.value;

            // 1. Definisikan fungsi pembantu
            const updateElement = (tglId, val, def) => {
                const el = document.getElementById(tglId);
                if (!el) return;

                // Cek apakah input tidak kosong (setelah di-trim)
                if (val && val.trim() !== "") {
                    el.classList.remove('text-red-500', 'opacity-50'); // Bersihkan class error/placeholder

                    // Format khusus untuk input type date, selain itu pakai nilai asli
                    el.textContent = (input.type === 'date') ? getTanggalIndo(new Date(val)) : val;

                    // Simpan ke localStorage agar data tidak hilang saat refresh
                    localStorage.setItem("storage_" + tglId, val);
                } else {
                    // Jika kosong, kembalikan ke teks default (placeholder)
                    el.textContent = def;
                    el.classList.add('text-red-500');
                    localStorage.removeItem("storage_" + tglId);
                }
            };

            // 2. WAJIB DIPANGGIL: Jalankan fungsi pembantu di atas
            updateElement(targetId, nilaiInput, defaultText);
        }

        // 3. Eksekusi Saat Halaman Dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Mengambil data dari PHP dan mengubahnya jadi Array JavaScript
            const fields = @json($dataInputan);


            fields.forEach(field => {
                const targetElem = document.getElementById(field.targetId);
                if (!targetElem) return;

                const savedValue = localStorage.getItem("storage_" + field.targetId);

                if (field.type === 'radio') {
                    // LOGIKA KHUSUS RADIO
                    const valueToUse = savedValue || field.defaultText;

                    // 1. Pilih radio button yang sesuai
                    const radioToSelect = document.querySelector(
                        `input[name="${field.inputId}"][value="${valueToUse}"]`);
                    if (radioToSelect) radioToSelect.checked = true;

                    // 2. Tampilkan di preview
                    targetElem.textContent = valueToUse;
                    targetElem.classList.remove('text-red-500');

                } else {
                    // LOGIKA UNTUK TEXT & DATE (Tetap seperti sebelumnya)
                    const inputElem = document.getElementById(field.inputId);
                    if (savedValue) {
                        if (inputElem) inputElem.value = savedValue;
                        targetElem.textContent = (inputElem && inputElem.type === 'date') ?
                            getTanggalIndo(new Date(savedValue)) :
                            savedValue;
                        targetElem.classList.remove('text-red-500');
                    } else {
                        targetElem.textContent = field.defaultText;
                        targetElem.classList.add('text-red-500');
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

            // Load & Render Lampiran
            renderInputs();
        });

        // Fungsi untuk Radio Button
        function updatePreviewRadio(el, targetId) {
            const target = document.getElementById(targetId);
            if (target) {
                target.textContent = el.value;
                target.classList.remove('text-red-500');
                // Simpan ke localStorage dengan format yang sama dengan fungsi updatePreview Anda
                localStorage.setItem("storage_" + targetId, el.value);
            }
        }
    </script>

    <script>
        // 1. Fungsi Tambah (Universal)
        function addItem(type, data = null) {
            const container = document.getElementById(`${type}-list`);
            const template = document.getElementById(`${type}-template`);

            if (!template || !container) return; // Guard clause jika elemen tidak ditemukan

            const clone = template.content.cloneNode(true);

            if (data) {
                if (type === 'experience') {
                    clone.querySelector('.exp-title').value = data.title || '';
                    clone.querySelector('.exp-year').value = data.year || '';
                    clone.querySelector('.exp-desc').value = data.desc || '';
                } else if (type === 'education') {
                    clone.querySelector('.edu-school').value = data.school || '';
                    clone.querySelector('.edu-year').value = data.year || '';
                    clone.querySelector('.edu-degree').value = data.degree || '';
                } else if (type === 'skill') {
                    clone.querySelector('.skill-name').value = data.name || '';
                }
            }

            container.appendChild(clone);
            renderPreview(type);
        }

        // 2. Fungsi Hapus (Universal)
        function removeItem(button, type) {
            const item = button.closest(`.${type}-item`);
            item.style.opacity = '0';
            item.style.transform = 'scale(0.95)';
            item.style.transition = '0.2s';

            setTimeout(() => {
                item.remove();
                renderPreview(type);
            }, 200);
        }

        // 3. Fungsi Render & Simpan Otomatis
        function renderPreview(type) {
            const previewContainer = document.getElementById(`preview-${type}-list`);
            const items = document.querySelectorAll(`.${type}-item`);

            if (!previewContainer) return;
            previewContainer.innerHTML = '';

            items.forEach((item) => {
                let html = '';
                if (type === 'experience') {
                    const title = item.querySelector('.exp-title').value || 'Jabatan';
                    const year = item.querySelector('.exp-year').value || 'Tahun';
                    const desc = item.querySelector('.exp-desc').value || 'Deskripsi...';
                    html = `
                  <div class="mb-4">
    <div class="flex flex-row justify-between items-start flex-nowrap gap-4 w-full">

        <div class="min-w-0 flex-1 font-bold text-slate-800 text-[12pt] break-words">
            ${title}
        </div>

        <div class="flex-shrink-0 text-right italic text-slate-500 text-[12pt] font-bold whitespace-nowrap">
            ${year}
        </div>
    </div>

    <p class="text-slate-600 mt-1 whitespace-pre-line text-[11pt]">${desc}</p>
</div>`;
                } else if (type === 'education') {
                    const school = item.querySelector('.edu-school').value || 'Nama Instansi';
                    const year = item.querySelector('.edu-year').value || 'Tahun';
                    const degree = item.querySelector('.edu-degree').value || 'Gelar';
                    html = `
                   <div class="mb-4">
    <div class="flex flex-row justify-between items-start flex-nowrap gap-4 w-full">

        <div class="min-w-0 flex-1 font-bold text-slate-800 text-[12pt] break-words">
            ${school}
        </div>

        <div class="flex-shrink-0 text-right italic text-slate-500 text-[12pt] font-bold whitespace-nowrap">
            ${year}
        </div>
    </div>

    <div class="text-slate-700 mt-1 text-[11pt]">${degree}</div>
</div>`;
                } else if (type === 'skill') {
                    const skillName = item.querySelector('.skill-name').value || 'Nama Keahlian';
                    html = `
                        <div class="flex items-start space-x-3 mb-2">
                            <!-- items-start: Memaksa ikon tetap di atas meskipun teks memanjang ke bawah -->
                            <div class="flex-shrink-0 w-2 text-[12pt] text-slate-100 text-sidebar-dynamic mt-1.5">
                                <!-- mt-1.5: Menyesuaikan posisi ikon agar pas di tengah baris pertama teks -->
                                ✔
                            </div>
                            <p class="text-[11pt] text-slate-100 font-medium text-sidebar-dynamic leading-tight break-words">
                                ${skillName}
                            </p>
                        </div>`;
                }
                previewContainer.insertAdjacentHTML('beforeend', html);
            });

            saveToLocal();
        }

        function handleImageUpload(input) {
            const file = input.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(event) {

                const img = new Image();

                img.onload = function() {

                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");

                    // Lebih besar = lebih jernih
                    const MAX_WIDTH = 1200;

                    let width = img.width;
                    let height = img.height;

                    // Resize hanya kalau gambar terlalu besar
                    if (width > MAX_WIDTH) {
                        const scale = MAX_WIDTH / width;
                        width *= scale;
                        height *= scale;
                    }

                    canvas.width = width;
                    canvas.height = height;

                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";

                    ctx.drawImage(img, 0, 0, width, height);

                    // JPEG lebih stabil di DomPDF
                    const compressedBase64 = canvas.toDataURL(
                        "image/jpeg",
                        0.92
                    );

                    console.log(
                        "Ukuran:",
                        (compressedBase64.length / 1024 / 1024).toFixed(2),
                        "MB"
                    );

                    localStorage.setItem(
                        "storage_foto_profil",
                        compressedBase64
                    );

                    // document.getElementById('foto_base64').value = compressedBase64;


                    tampilkanGambar(compressedBase64);
                };

                img.src = event.target.result;
            };

            reader.readAsDataURL(file);
        }

        function tampilkanGambar(base64) {
            const imgPreview = document.getElementById('preview-avatar');
            if (imgPreview) {
                imgPreview.src = base64;
                document.getElementById('foto_base64').value = base64;
                console.log("📸 Preview gambar diperbarui dari storage.");
            }
        }


        // --- 3. FUNGSI SIMPAN DATA TEKS ---
        function saveToLocal() {
            const cvData = {
                experience: [],
                education: [],
                skill: []
            };

            document.querySelectorAll('.experience-item').forEach(item => {
                cvData.experience.push({
                    title: item.querySelector('.exp-title')?.value || '',
                    company: item.querySelector('.exp-company')?.value || '',
                    year: item.querySelector('.exp-year')?.value || '',
                    desc: item.querySelector('.exp-desc')?.value || ''
                });
            });

            document.querySelectorAll('.education-item').forEach(item => {
                cvData.education.push({
                    school: item.querySelector('.edu-school')?.value || '',
                    year: item.querySelector('.edu-year')?.value || '',
                    degree: item.querySelector('.edu-degree')?.value || ''
                });
            });

            document.querySelectorAll('.skill-item').forEach(item => {
                const skillName = item.querySelector('.skill-name')?.value;
                if (skillName) cvData.skill.push({
                    name: skillName
                });
            });

            localStorage.setItem('cv_data_lengkap', JSON.stringify(cvData));
            console.log("📝 Data teks berhasil dicadangkan.");
        }

        // --- 4. MUAT DATA SAAT REFRESH ---
        document.addEventListener('DOMContentLoaded', () => {
            console.log("🔄 Halaman dimuat, mengecek storage...");

            // A. Cek dan Muat Foto Profil
            const savedFoto = localStorage.getItem("storage_foto_profil");
            if (savedFoto) {
                console.log("🖼️ Foto profil ditemukan di storage.");
                tampilkanGambar(savedFoto);
            } else {
                console.log("⚠️ Tidak ada foto profil di storage.");
            }

            // B. Cek dan Muat Data Teks
            const savedData = localStorage.getItem('cv_data_lengkap');
            if (savedData) {
                const data = JSON.parse(savedData);
                console.log("📄 Data teks ditemukan:", data);

                // Isi Field Dasar
                const setVal = (id, val) => {
                    const el = document.getElementById(id);
                    if (el) el.value = val || '';
                };


                // Render Data Dinamis (Pastikan fungsi addItem tersedia)
                if (data.experience?.length) data.experience.forEach(exp => addItem('experience', exp));
                else addItem('experience');

                if (data.education?.length) data.education.forEach(edu => addItem('education', edu));
                else addItem('education');

                if (data.skill?.length) data.skill.forEach(s => addItem('skill', s));
                else addItem('skill');

            } else {
                console.log("🆕 Storage kosong, menyiapkan form baru.");
                addItem('experience');
                addItem('education');
                addItem('skill');
            }
        });
    </script>
@endpush
