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

                        <form action="{{ route('admin.loker.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="form-label fw-semibold">Deadline</label>
                                    <input type="date" name="deadline" class="form-control" required>
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
                                <div class="col-12">
                                    <label class="form-label fw-semibold">URL Artikel Blog Terkait (Opsional)</label>
                                    <input type="url" name="url_blog" class="form-control"
                                        placeholder="https://gawedokumen.com/blog/tips-posisi-ini">
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


        $(document).ready(function() {
            /**
             * Fungsi Universal untuk Tambah Baris
             * @param {string} containerId - ID elemen pembungkus
             * @param {string} name - Nama atribut name untuk input (tanpa [])
             * @param {string} placeholder - Teks placeholder
             * @param {string} icon - Ikon Bootstrap (opsional)
             */
            function addRow(containerId, name, placeholder, icon = '') {
                const iconHtml = icon ?
                    `<span class="input-group-text bg-light"><i class="bi ${icon} text-primary"></i></span>` : '';
                const html = `
            <div class="input-group mb-2 animate__animated animate__fadeIn">
                ${iconHtml}
                <input type="text" name="${name}[]" class="form-control" placeholder="${placeholder}" required>
                <button class="btn btn-outline-danger remove-row" type="button" data-container="#${containerId}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
                $(`#${containerId}`).append(html);
            }

            // Event Listener Klik Tambah (Delegasi ke ID masing-masing tombol)
            $('#add-benefit').on('click', () => addRow('benefit-container', 'benefit', 'Benefit lainnya...',
                'bi-gift'));
            $('#add-tugas').on('click', () => addRow('tugas-container', 'tugas', 'Tugas lainnya...'));
            $('#add-persyaratan').on('click', () => addRow('persyaratan-container', 'persyaratan',
                'Syarat lainnya...'));

            // Fungsi Hapus Universal
            $(document).on('click', '.remove-row', function() {
                const container = $($(this).data('container'));
                if (container.find('.input-group').length > 1) {
                    $(this).closest('.input-group').remove();
                } else {
                    alert("Minimal harus ada satu data yang terisi.");
                }
            });
        });
    </script>
@endpush
