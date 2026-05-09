@extends('admin.layouts.main')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <div class="container-fluid bg-light min-vh-screen px-0 px-md-4 pt-0 pt-md-5 pb-5">
        <div class="row justify-content-center g-0">
            <div class="col-12 col-lg-10">
                <div class="card border-0 shadow-sm rounded-0 rounded-md-4">
                    <div class="card-body p-4 p-md-5">

                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-3 p-3 me-3">
                                <i class="bi bi-briefcase-fill fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">Tambah Lowongan Baru</h4>
                                <small class="text-muted">Gunakan fitur pencarian untuk wilayah Jawa Tengah.</small>
                            </div>
                        </div>

                        <form id="lokerForm" action="{{ route('admin.loker.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-12 mt-2">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Identitas
                                        Perusahaan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Posisi</label>
                                    <input type="text" name="posisi" class="form-control form-control-lg fs-6"
                                        placeholder="Contoh: Admin Gudang" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control form-control-lg fs-6"
                                        placeholder="Nama PT atau Toko" required>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Lokasi
                                        Penempatan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Kota/Kabupaten</label>
                                    <select name="kota" id="select-kota" class="form-select select2-init" required>
                                        <option value="">Cari Kota/Kabupaten...</option>

                                        <optgroup label="Wilayah Utama">
                                            <option value="Kabupaten Tegal" data-id="3328" selected>Kabupaten Tegal</option>
                                            <option value="Kota Tegal" data-id="3376">Kota Tegal</option>
                                            <option value="Kabupaten Brebes" data-id="3329">Kabupaten Brebes</option>
                                            <option value="Kabupaten Pemalang" data-id="3327">Kabupaten Pemalang</option>
                                        </optgroup>

                                        <optgroup label="Jawa Tengah Lainnya">
                                            <option value="Kabupaten Banjarnegara" data-id="3304">Kabupaten Banjarnegara
                                            </option>
                                            <option value="Kabupaten Banyumas" data-id="3302">Kabupaten Banyumas</option>
                                            <option value="Kabupaten Batang" data-id="3325">Kabupaten Batang</option>
                                            <option value="Kabupaten Blora" data-id="3316">Kabupaten Blora</option>
                                            <option value="Kabupaten Boyolali" data-id="3309">Kabupaten Boyolali</option>
                                            <option value="Kabupaten Cilacap" data-id="3301">Kabupaten Cilacap</option>
                                            <option value="Kabupaten Demak" data-id="3315">Kabupaten Demak</option>
                                            <option value="Kabupaten Grobogan" data-id="3315">Kabupaten Grobogan</option>
                                            <option value="Kabupaten Jepara" data-id="3320">Kabupaten Jepara</option>
                                            <option value="Kabupaten Karanganyar" data-id="3313">Kabupaten Karanganyar
                                            </option>
                                            <option value="Kabupaten Kebumen" data-id="3305">Kabupaten Kebumen</option>
                                            <option value="Kabupaten Kendal" data-id="3324">Kabupaten Kendal</option>
                                            <option value="Kabupaten Klaten" data-id="3310">Kabupaten Klaten</option>
                                            <option value="Kabupaten Kudus" data-id="3319">Kabupaten Kudus</option>
                                            <option value="Kabupaten Magelang" data-id="3308">Kabupaten Magelang</option>
                                            <option value="Kabupaten Pati" data-id="3318">Kabupaten Pati</option>
                                            <option value="Kabupaten Pekalongan" data-id="3326">Kabupaten Pekalongan
                                            </option>
                                            <option value="Kabupaten Purbalingga" data-id="3303">Kabupaten Purbalingga
                                            </option>
                                            <option value="Kabupaten Purworejo" data-id="3306">Kabupaten Purworejo</option>
                                            <option value="Kabupaten Rembang" data-id="3317">Kabupaten Rembang</option>
                                            <option value="Kabupaten Semarang" data-id="3322">Kabupaten Semarang</option>
                                            <option value="Kabupaten Sragen" data-id="3314">Kabupaten Sragen</option>
                                            <option value="Kabupaten Sukoharjo" data-id="3311">Kabupaten Sukoharjo</option>
                                            <option value="Kabupaten Temanggung" data-id="3323">Kabupaten Temanggung
                                            </option>
                                            <option value="Kabupaten Wonogiri" data-id="3312">Kabupaten Wonogiri</option>
                                            <option value="Kabupaten Wonosobo" data-id="3307">Kabupaten Wonosobo</option>
                                            <option value="Kota Magelang" data-id="3371">Kota Magelang</option>
                                            <option value="Kota Pekalongan" data-id="3375">Kota Pekalongan</option>
                                            <option value="Kota Salatiga" data-id="3373">Kota Salatiga</option>
                                            <option value="Kota Semarang" data-id="3374">Kota Semarang</option>
                                            <option value="Kota Surakarta" data-id="3372">Kota Surakarta</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <select name="kecamatan" id="select-kecamatan" class="form-select select2-init"
                                        required disabled>
                                        <option value="">Pilih Kota Dahulu</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Jl. Raya No. 123..."></textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Detail
                                        Lowongan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Gaji (Range)</label>
                                    <input type="text" name="gaji" class="form-control"
                                        placeholder="Contoh: Rp 2.1jt - 2.5jt">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Batas Pendaftaran (Deadline)</label>
                                    <input type="date" name="deadline" class="form-control" required>
                                </div>
                                <div class="col-12 mt-4">
                                    <label
                                        class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        Benefit / Fasilitas
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-benefit">
                                            <i class="bi bi-plus-circle me-1"></i>Tambah Baris
                                        </button>
                                    </label>

                                    <div id="benefit-container">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text bg-light"><i
                                                    class="bi bi-gift text-primary"></i></span>
                                            <input type="text" name="benefit[]" class="form-control"
                                                placeholder="Contoh: Gaji Pokok" required>
                                            <button class="btn btn-outline-danger remove-benefit" type="button">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted">Klik tombol "Tambah Baris" untuk menambah fasilitas
                                        lainnya.</small>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">4. Isi
                                        Lowongan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                {{-- Tambahan Minimal Pendidikan & Pengalaman --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Minimal Pendidikan</label>
                                    <select name="minimal_pendidikan" class="form-select select2-init">
                                        <option value="">Pilih Pendidikan...</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK (Sederajat)</option>
                                        <option value="D3">D3</option>
                                        <option value="S1/S2">S1/S2</option>
                                        <option value="Semua Jenjang">Semua Jenjang (Tanpa Minimal)</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Pengalaman Kerja</label>
                                    <select name="pengalaman" class="form-select select2-init">
                                        <option value="">Pilih Kategori...</option>
                                        <option value="Fresh Graduate">Fresh Graduate</option>
                                        <option value="Minimal 1 Tahun">Minimal 1 Tahun</option>
                                        <option value="Minimal 2 Tahun">Minimal 2 Tahun</option>
                                        <option value="Minimal 3 Tahun">Minimal 3 Tahun</option>
                                        <option value="Lebih dari 5 Tahun">Lebih dari 5 Tahun</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Ringkasan / Deskripsi Pekerjaan</label>
                                    <textarea name="deskripsi" class="form-control" rows="4"
                                        placeholder="Jelaskan secara singkat mengenai perusahaan dan posisi ini..."></textarea>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label
                                        class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        Tugas & Tanggung Jawab
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-tugas">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </label>
                                    <div id="tugas-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="tugas[]" class="form-control"
                                                placeholder="Contoh: Menginput data barang" required>
                                            <button class="btn btn-outline-danger remove-item" type="button"><i
                                                    class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <label
                                        class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        Persyaratan / Kualifikasi
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            id="add-persyaratan">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </label>
                                    <div id="persyaratan-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="persyaratan[]" class="form-control"
                                                placeholder="Contoh: Pria/Wanita maks 25th" required>
                                            <button class="btn btn-outline-danger remove-item" type="button"><i
                                                    class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">5. Kontak &
                                        Publikasi</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">WhatsApp (Format: 628xxx)</label>
                                    <input type="text" name="no_wa" class="form-control" placeholder="62857xxxx">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Email HRD</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="hrd@perusahaan.com">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Status Tayang</label>
                                    <select name="status" class="form-select text-success fw-bold">
                                        <option value="Aktif">Aktif / Terbitkan</option>
                                        <option value="Arsip">Simpan Draft</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label fw-semibold">Pilih Artikel Blog Terkait (Opsional)</label>
                                    <select name="blog_ids[]" class="form-control select2-multiple" multiple="multiple">
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}">{{ $blog->judul }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Kamu bisa memilih lebih dari satu artikel tips yang
                                        relevan.</small>
                                </div>
                                <div class="col-12 mt-5">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg w-100 rounded-3 fw-bold shadow-sm py-3">
                                        Tayangkan Lowongan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* CSS Tambahan agar Select2 tidak hancur tampilannya */
        .select2-container--bootstrap-5 .select2-selection {
            height: calc(3.5rem + 2px) !important;
            /* Menyamakan dengan form-control-lg jika perlu */
            line-height: 1.5 !important;
            padding: 0.75rem 1rem !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.5rem !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            padding-left: 0 !important;
            color: #212529 !important;
        }

        /* Responsive Fix */
        @media (min-width: 768px) {
            .rounded-md-4 {
                border-radius: 1.5rem !important;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi inisialisasi Select2 agar konsisten
            function initSelect2(element, placeholder) {
                $(element).select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: placeholder,
                    allowClear: true,
                    dropdownParent: $(element).parent()
                });
            }

            // Inisialisasi Awal
            initSelect2('#select-kota', 'Cari Kota/Kabupaten...');
            initSelect2('#select-kecamatan', 'Pilih Kota Dahulu...');

            // Jalankan otomatis untuk Kabupaten Tegal saat halaman pertama dimuat
            // ID Kab Tegal di API ini adalah 3328
            loadKecamatan("3328");

            $('#select-kota').on('change', function() {
                // Mengambil data-id dari atribut option
                let idKota = $(this).find(':selected').data('id');

                if (idKota) {
                    loadKecamatan(idKota);
                } else {
                    $('#select-kecamatan').val(null).trigger('change').prop('disabled', true);
                }
            });

            function loadKecamatan(idKota) {
                let selectKec = $('#select-kecamatan');

                // Set loading state
                selectKec.prop('disabled', true);
                selectKec.html('<option value="">Sedang memuat data...</option>');

                // Menggunakan API dari emsifa (lebih stabil untuk wilayah Indonesia)
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${idKota}.json`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        let options = '<option value="">Cari Kecamatan...</option>';

                        // Sort data berdasarkan abjad agar rapi
                        data.sort((a, b) => a.name.localeCompare(b.name));

                        data.forEach(item => {
                            // API ini menggunakan "name", bukan "nama"
                            options += `<option value="${item.name}">${item.name}</option>`;
                        });

                        selectKec.html(options).prop('disabled', false);

                        // Re-inisialisasi Select2 agar data baru terbaca
                        initSelect2('#select-kecamatan', 'Pilih Kecamatan...');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Fallback jika API down: izinkan input manual atau beri pesan
                        selectKec.html('<option value="">Gagal memuat. Silahkan coba lagi</option>').prop(
                            'disabled', false);
                        alert('Gagal mengambil data wilayah. Pastikan Anda terkoneksi internet.');
                    });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            const formId = 'lokerForm';
            const storageKey = 'draft_loker_data';

            // 1. Inisialisasi Select2
            $('.select2-multiple').select2({
                placeholder: "Cari judul blog...",
                allowClear: true,
                width: '100%'
            }).on('change', function() {
                saveAllData(); // Simpan saat pilihan blog berubah
            });

            $('.select2-init').select2({
                width: '100%'
            }).on('change', function() {
                saveAllData();
            });

            // 2. Fungsi Pembantu: Tambah Baris Dinamis
            function createDynamicRow(containerId, name, value = '') {
                let html = '';
                if (containerId === 'benefit-container') {
                    html = `
                <div class="input-group mb-2">
                    <span class="input-group-text bg-light"><i class="bi bi-gift text-primary"></i></span>
                    <input type="text" name="benefit[]" class="form-control" value="${value}" required>
                    <button class="btn btn-outline-danger remove-benefit" type="button"><i class="bi bi-trash"></i></button>
                </div>`;
                } else if (containerId === 'tugas-container') {
                    html = `
                <div class="input-group mb-2">
                    <input type="text" name="tugas[]" class="form-control" value="${value}" required>
                    <button class="btn btn-outline-danger remove-item" type="button"><i class="bi bi-trash"></i></button>
                </div>`;
                } else if (containerId === 'persyaratan-container') {
                    html = `
                <div class="input-group mb-2">
                    <input type="text" name="persyaratan[]" class="form-control" value="${value}" required>
                    <button class="btn btn-outline-danger remove-item" type="button"><i class="bi bi-trash"></i></button>
                </div>`;
                }
                $(`#${containerId}`).append(html);
            }

            // 3. Fungsi Utama: Simpan Data ke LocalStorage
            function saveAllData() {
                const formData = {};
                const rawData = $('#' + formId).serializeArray();

                rawData.forEach(item => {
                    if (item.name === '_token') return;

                    if (item.name.includes('[]')) {
                        if (!formData[item.name]) formData[item.name] = [];
                        formData[item.name].push(item.value);
                    } else {
                        formData[item.name] = item.value;
                    }
                });

                localStorage.setItem(storageKey, JSON.stringify(formData));
            }

            // 4. Fungsi Utama: Muat Data dari LocalStorage
            function loadFormData() {
                const savedData = localStorage.getItem(storageKey);
                if (!savedData) return;

                const data = JSON.parse(savedData);

                // Reset kontainer dinamis agar tidak double saat load
                $('#benefit-container, #tugas-container, #persyaratan-container').empty();

                Object.keys(data).forEach(key => {
                    // A. Logika untuk Select2 Multiple (blog_ids[])
                    if (key === 'blog_ids[]' && Array.isArray(data[key])) {
                        $('.select2-multiple').val(data[key]).trigger('change.select2');
                    }
                    // B. Logika untuk Input Dinamis (Array)
                    else if (key.includes('[]') && Array.isArray(data[key])) {
                        const containerMap = {
                            'benefit[]': 'benefit-container',
                            'tugas[]': 'tugas-container',
                            'persyaratan[]': 'persyaratan-container'
                        };
                        if (containerMap[key]) {
                            data[key].forEach(val => createDynamicRow(containerMap[key], key, val));
                        }
                    }
                    // C. Logika untuk Input Biasa & Select2 Single
                    else {
                        const input = $(`[name="${key}"]`);
                        if (input.length) {
                            if (input.hasClass('select2-init')) {
                                input.val(data[key]).trigger('change.select2');
                            } else {
                                input.val(data[key]);
                            }
                        }
                    }
                });
            }

            // --- EVENT LISTENERS ---

            // Deteksi ketikan dan perubahan input
            $('#' + formId).on('input change', function(e) {
                // Jangan simpan jika yang berubah adalah file upload (opsional)
                if (e.target.type !== 'file') {
                    saveAllData();
                }
            });

            // Hapus draft saat berhasil submit
            $('#' + formId).on('submit', function() {
                localStorage.removeItem(storageKey);
            });

            // Tombol Tambah Baris
            $('#add-benefit').click(function() {
                createDynamicRow('benefit-container', 'benefit[]');
                saveAllData();
            });
            $('#add-tugas').click(function() {
                createDynamicRow('tugas-container', 'tugas[]');
                saveAllData();
            });
            $('#add-persyaratan').click(function() {
                createDynamicRow('persyaratan-container', 'persyaratan[]');
                saveAllData();
            });

            // Tombol Hapus Baris
            $(document).on('click', '.remove-benefit, .remove-item', function() {
                $(this).closest('.input-group').remove();
                saveAllData();
            });

            // Jalankan Load Data saat halaman siap
            loadFormData();
        });
    </script>
@endpush
