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

                        <div class="mb-4 p-3 bg-light-subtle border border-primary-subtle rounded-3">
                            <label class="form-label fw-bold text-primary mb-1">
                                <i class="bi bi-cpu-fill me-1"></i> Auto-Fill Loker Pakai AI (Scan Gambar)
                            </label>
                            <div class="input-group">
                                <input type="file" id="ai-image-input" class="form-control" accept="image/*">
                                <button class="btn btn-primary" type="button" id="btn-scan-ai">
                                    <span class="spinner-border spinner-border-sm d-none me-1" id="loading-scan"
                                        role="status"></span>
                                    <i class="bi bi-magic me-1" id="icon-magic"></i> Mulai Scan Lokermu
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1">Upload pamflet/brosur loker, AI akan otomatis mengisi
                                form di bawah.</small>
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
                                        placeholder="Contoh: Admin Gudang" value="{{ old('posisi') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control form-control-lg fs-6"
                                        placeholder="Nama PT atau Toko" value="{{ old('perusahaan') }}" required>
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
                                            <option value="Kabupaten Tegal" data-id="3328"
                                                {{ old('kota', 'Kabupaten Tegal') == 'Kabupaten Tegal' ? 'selected' : '' }}>
                                                Kabupaten Tegal</option>
                                            <option value="Kota Tegal" data-id="3376"
                                                {{ old('kota') == 'Kota Tegal' ? 'selected' : '' }}>Kota Tegal</option>
                                            <option value="Kabupaten Brebes" data-id="3329"
                                                {{ old('kota') == 'Kabupaten Brebes' ? 'selected' : '' }}>Kabupaten Brebes
                                            </option>
                                            <option value="Kabupaten Pemalang" data-id="3327"
                                                {{ old('kota') == 'Kabupaten Pemalang' ? 'selected' : '' }}>Kabupaten
                                                Pemalang</option>
                                        </optgroup>
                                        {{-- ... (opsi lainnya tetap sama, tinggal tambahkan logika ternary selected) --}}
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <select name="kecamatan" id="select-kecamatan" class="form-select select2-init"
                                        required>
                                        @if (old('kecamatan'))
                                            <option value="{{ old('kecamatan') }}" selected>{{ old('kecamatan') }}</option>
                                        @else
                                            <option value="">Pilih Kota Dahulu</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Jl. Raya No. 123...">{{ old('alamat') }}</textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Detail
                                        Lowongan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Gaji (Range)</label>
                                    <input type="text" name="gaji" class="form-control"
                                        placeholder="Contoh: Rp 2.1jt - 2.5jt" value="{{ old('gaji') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Batas Pendaftaran (Deadline)</label>
                                    <input type="date" name="deadline" class="form-control"
                                        value="{{ old('deadline') }}">
                                    <small class="text-muted">Biarkan kosong jika pendaftaran hingga kuota
                                        terpenuhi.</small>
                                </div>

                                {{-- Section Benefit dengan Re-populate --}}
                                <div class="col-12 mt-4">
                                    <label
                                        class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        Benefit / Fasilitas
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-benefit">
                                            <i class="bi bi-plus-circle me-1"></i>Tambah Baris
                                        </button>
                                    </label>
                                    <div id="benefit-container">
                                        @if (old('benefit'))
                                            @foreach (old('benefit') as $index => $val)
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text bg-light"><i
                                                            class="bi bi-gift text-primary"></i></span>
                                                    <input type="text" name="benefit[]" class="form-control"
                                                        value="{{ $val }}">
                                                    <button class="btn btn-outline-danger remove-benefit"
                                                        type="button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <span class="input-group-text bg-light"><i
                                                        class="bi bi-gift text-primary"></i></span>
                                                <input type="text" name="benefit[]" class="form-control"
                                                    placeholder="Contoh: Gaji Pokok">
                                                <button class="btn btn-outline-danger remove-benefit" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">4. Isi
                                        Lowongan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Minimal Pendidikan</label>
                                    <select name="minimal_pendidikan" class="form-select select2-init">
                                        <option value="">Pilih Pendidikan...</option>
                                        @foreach (['SMP', 'SMA/SMK', 'D3', 'S1/S2', 'Semua Jenjang'] as $pend)
                                            <option value="{{ $pend }}"
                                                {{ old('minimal_pendidikan') == $pend ? 'selected' : '' }}>
                                                {{ $pend }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Pengalaman Kerja</label>
                                    <select name="pengalaman" class="form-select select2-init">
                                        <option value="">Pilih Kategori...</option>
                                        @foreach (['Fresh Graduate', 'Minimal 1 Tahun', 'Minimal 2 Tahun', 'Minimal 3 Tahun', 'Lebih dari 5 Tahun'] as $exp)
                                            <option value="{{ $exp }}"
                                                {{ old('pengalaman') == $exp ? 'selected' : '' }}>{{ $exp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Ringkasan / Deskripsi Pekerjaan</label>
                                    <textarea name="deskripsi" class="form-control" rows="4"
                                        placeholder="Jelaskan secara singkat mengenai perusahaan dan posisi ini...">{{ old('deskripsi') }}</textarea>
                                </div>

                                {{-- Section Tugas dengan Re-populate --}}
                                <div class="col-md-6 mt-4">
                                    <label
                                        class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        Tugas & Tanggung Jawab
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-tugas">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </label>
                                    <div id="tugas-container">
                                        @if (old('tugas'))
                                            @foreach (old('tugas') as $val)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="tugas[]" class="form-control"
                                                        value="{{ $val }}" required>
                                                    <button class="btn btn-outline-danger remove-item" type="button"><i
                                                            class="bi bi-trash"></i></button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" name="tugas[]" class="form-control"
                                                    placeholder="Contoh: Menginput data barang" required>
                                                <button class="btn btn-outline-danger remove-item" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Section Persyaratan dengan Re-populate --}}
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
                                        @if (old('persyaratan'))
                                            @foreach (old('persyaratan') as $val)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="persyaratan[]" class="form-control"
                                                        value="{{ $val }}" required>
                                                    <button class="btn btn-outline-danger remove-item" type="button"><i
                                                            class="bi bi-trash"></i></button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" name="persyaratan[]" class="form-control"
                                                    placeholder="Contoh: Pria/Wanita maks 25th" required>
                                                <button class="btn btn-outline-danger remove-item" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">5. Kontak &
                                        Publikasi</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">WhatsApp (Format: 628xxx)</label>
                                    <input type="text" name="no_wa" class="form-control" placeholder="62857xxxx"
                                        value="{{ old('no_wa') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Email HRD</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="hrd@perusahaan.com" value="{{ old('email') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Link Pendaftaran</label>
                                    <input type="text" name="link_pendaftaran" class="form-control"
                                        placeholder="https://" value="{{ old('link_pendaftaran') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Status Tayang</label>
                                    <select name="status" class="form-select text-success fw-bold">
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif /
                                            Terbitkan</option>
                                        <option value="Arsip" {{ old('status') == 'Arsip' ? 'selected' : '' }}>Simpan
                                            Draft</option>
                                    </select>
                                </div>

                                {{-- Pilih Artikel Blog Terkait --}}
                                <div class="col-12 mt-3">
                                    <label class="form-label fw-semibold">Pilih Artikel Blog Terkait (Opsional)</label>
                                    <select name="blog_ids[]" class="form-control select2-multiple" multiple="multiple">
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}"
                                                {{ is_array(old('blog_ids')) && in_array($blog->id, old('blog_ids')) ? 'selected' : '' }}>
                                                {{ $blog->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Rekomendasi Produk Affiliate --}}
                                <div class="col-12 mt-3"> {{-- mt-3 disamakan agar jarak spacing-nya konsisten --}}
                                    <label class="form-label fw-semibold">Rekomendasi Produk Affiliate (Bisa Pilih
                                        Banyak)</label>
                                    <select name="product_ids[]" class="form-control select2-multiple"
                                        multiple="multiple">
                                        @foreach ($affiliateAds as $ad)
                                            <option value="{{ $ad->id }}"
                                                {{ is_array(old('product_ids')) && in_array($ad->id, old('product_ids')) ? 'selected' : '' }}>
                                                {{ $ad->nama_produk }} ({{ $ad->platform->nama_platform }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

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
        document.getElementById('btn-scan-ai').addEventListener('click', function() {
            const fileInput = document.getElementById('ai-image-input');
            const file = fileInput.files[0];

            if (!file) {
                alert('Pilih gambar brosur loker terlebih dahulu, Mas!');
                return;
            }

            const btn = this;
            const spinner = document.getElementById('loading-scan');
            const icon = document.getElementById('icon-magic');

            btn.disabled = true;
            spinner.classList.remove('d-none');
            icon.classList.add('d-none');

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('admin.loker.scan_ai') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const isJson = response.headers.get('content-type')?.includes('application/json');
                    const textData = await response.text();

                    if (!response.ok) {
                        if (!isJson) {
                            const match = textData.match(/<title>(.*?)<\/title>/);
                            const errorTitle = match ? match[1] : 'Internal Server Error';
                            throw new Error(`[Laravel Error] ${errorTitle}`);
                        }
                        const jsonErr = JSON.parse(textData);
                        throw new Error(jsonErr.message || 'Terjadi kesalahan validasi.');
                    }

                    return JSON.parse(textData);
                })
                .then(res => {
                    if (res.success) {
                        const data = res.data;

                        // Isi input text & textarea standar
                        document.querySelector('input[name="posisi"]').value = data.posisi || '';
                        document.querySelector('input[name="perusahaan"]').value = data.perusahaan || '';
                        document.querySelector('input[name="deadline"]').value = data.deadline || '';
                        document.querySelector('textarea[name="alamat"]').value = data.alamat || '';
                        document.querySelector('input[name="gaji"]').value = data.gaji || '';
                        document.querySelector('textarea[name="deskripsi"]').value = data.deskripsi || '';
                        document.querySelector('input[name="no_wa"]').value = data.no_wa || '';
                        document.querySelector('input[name="email"]').value = data.email || '';

                        // Isi Dropdown Pendidikan & Pengalaman
                        const selectPendidikan = document.querySelector('select[name="minimal_pendidikan"]');
                        if (selectPendidikan) {
                            selectPendidikan.value = data.minimal_pendidikan;
                            selectPendidikan.dispatchEvent(new Event('change'));
                        }

                        const selectPengalaman = document.querySelector('select[name="pengalaman"]');
                        if (selectPengalaman) {
                            selectPengalaman.value = data.pengalaman;
                            selectPengalaman.dispatchEvent(new Event('change'));
                        }

                        // ISI DATA SELECT2 MULTIPLE PRODUK AFFILIATE (PILIHAN AI)
                        // Cek apakah data dari AI ada dan tipenya berupa Array
                        const selectProduk = $('select[name="product_ids[]"]');
                        if (selectProduk.length && Array.isArray(data.product_ids)) {
                            // Konversikan item array ke string / integer yang sesuai dengan value option kamu
                            selectProduk.val(data.product_ids).trigger('change');
                        }

                        // Loop Isi Array Benefit Dinamis
                        if (data.benefit && data.benefit.length > 0) {
                            const container = document.getElementById('benefit-container');
                            container.innerHTML = '';
                            data.benefit.forEach((itemText) => {
                                const html = `<div class="input-group mb-2">
                            <input type="text" name="benefit[]" class="form-control" value="${itemText}" required>
                            <button class="btn btn-outline-danger remove-item" type="button"><i class="bi bi-trash"></i></button>
                        </div>`;
                                container.insertAdjacentHTML('beforeend', html);
                            });
                        }

                        // Loop Isi Array Tugas Dinamis
                        if (data.tugas && data.tugas.length > 0) {
                            const container = document.getElementById('tugas-container');
                            container.innerHTML = '';
                            data.tugas.forEach((itemText) => {
                                const html = `<div class="input-group mb-2">
                            <input type="text" name="tugas[]" class="form-control" value="${itemText}" required>
                            <button class="btn btn-outline-danger remove-item" type="button"><i class="bi bi-trash"></i></button>
                        </div>`;
                                container.insertAdjacentHTML('beforeend', html);
                            });
                        }

                        // Loop Isi Array Persyaratan Dinamis
                        if (data.persyaratan && data.persyaratan.length > 0) {
                            const container = document.getElementById('persyaratan-container');
                            container.innerHTML = '';
                            data.persyaratan.forEach((itemText) => {
                                const html = `<div class="input-group mb-2">
                            <input type="text" name="persyaratan[]" class="form-control" value="${itemText}" required>
                            <button class="btn btn-outline-danger remove-item" type="button"><i class="bi bi-trash"></i></button>
                        </div>`;
                                container.insertAdjacentHTML('beforeend', html);
                            });
                        }

                        alert('Mantap! Form berhasil terisi otomatis oleh AI beserta rekomendasi produknya.');
                    } else {
                        alert('Gagal: ' + res.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert(err.message);
                })
                .finally(() => {
                    btn.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                });
        });

        // Listener hapus item
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-item')) {
                const group = e.target.closest('.input-group');
                if (group) group.remove();
            }
        });
    </script>
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
                    <input type="text" name="benefit[]" class="form-control" value="${value}">
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
                    // A. Logika Baru untuk SEMUA Select2 Multiple (blog_ids[] dan product_ids[])
                    if ((key === 'blog_ids[]' || key === 'product_ids[]') && Array.isArray(data[key])) {
                        // Menembak elemen spesifik menggunakan atribut name agar tidak tertukar
                        $(`select[name="${key}"]`).val(data[key]).trigger('change.select2');
                    }
                    // B. Logika untuk Input Dinamis (Array Teks: Benefit, Tugas, Persyaratan)
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
                            if (input.hasClass('select2-init') || input.hasClass('select2-multiple')) {
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
