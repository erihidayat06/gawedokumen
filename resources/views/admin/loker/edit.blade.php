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

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-info text-white rounded-3 p-3 me-3">
                                    <i class="bi bi-pencil-square fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">Edit Lowongan</h4>
                                    <small class="text-muted">Memperbarui data: {{ $loker->posisi }}</small>
                                </div>
                            </div>
                            <a href="{{ route('admin.loker.index') }}" class="btn btn-light border btn-sm px-3">Kembali</a>
                        </div>

                        <form id="editLokerForm" action="{{ route('admin.loker.update', $loker->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                {{-- Identitas Perusahaan --}}
                                <div class="col-12 mt-2">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Identitas
                                        Perusahaan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Posisi</label>
                                    <input type="text" name="posisi" class="form-control form-control-lg fs-6"
                                        value="{{ old('posisi', $loker->posisi) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control form-control-lg fs-6"
                                        value="{{ old('perusahaan', $loker->perusahaan) }}" required>
                                </div>

                                {{-- Lokasi --}}
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Lokasi
                                        Penempatan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Kota/Kabupaten</label>
                                    <select name="kota" id="select-kota" class="form-select select2-init" required>
                                        <option value="{{ $loker->kota }}" selected>{{ $loker->kota }}</option>
                                        {{-- Tambahkan list kota lainnya seperti di create --}}
                                        <optgroup label="Wilayah Utama">
                                            <option value="Kabupaten Tegal" data-id="3328">Kabupaten Tegal</option>
                                            <option value="Kota Tegal" data-id="3376">Kota Tegal</option>
                                            <option value="Kabupaten Brebes" data-id="3329">Kabupaten Brebes</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <select name="kecamatan" id="select-kecamatan" class="form-select select2-init"
                                        required>
                                        <option value="{{ $loker->kecamatan }}" selected>{{ $loker->kecamatan }}</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $loker->alamat) }}</textarea>
                                </div>

                                {{-- Detail --}}
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Detail & Gaji
                                    </h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Gaji (Range)</label>
                                    <input type="text" name="gaji" class="form-control"
                                        value="{{ old('gaji', $loker->gaji) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Batas Pendaftaran</label>
                                    <input type="date" name="deadline" class="form-control"
                                        value="{{ old('deadline', $loker->deadline ? \Carbon\Carbon::parse($loker->deadline)->format('Y-m-d') : '') }}">
                                    <small class="text-muted">Kosongkan jika pendaftaran dibuka sampai kuota
                                        terpenuhi.</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Status Tayang</label>
                                    <select name="status"
                                        class="form-select fw-bold {{ $loker->status == 'Aktif' ? 'text-success' : 'text-secondary' }}">
                                        <option value="Aktif" {{ $loker->status == 'Aktif' ? 'selected' : '' }}>Aktif /
                                            Terbitkan</option>
                                        <option value="Arsip" {{ $loker->status == 'Arsip' ? 'selected' : '' }}>Simpan
                                            Draft</option>
                                    </select>
                                </div>

                                {{-- Benefit Dinamis --}}
                                <div class="col-12 mt-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        Benefit / Fasilitas
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-benefit"><i
                                                class="bi bi-plus-circle me-1"></i>Tambah Baris</button>
                                    </label>
                                    <div id="benefit-container">
                                        @foreach ($loker->benefit as $b)
                                            <div class="input-group mb-2">
                                                <span class="input-group-text bg-light"><i
                                                        class="bi bi-gift text-primary"></i></span>
                                                <input type="text" name="benefit[]" class="form-control"
                                                    value="{{ $b }}" required>
                                                <button class="btn btn-outline-danger remove-row" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-12 mt-4">
                                    <label class="form-label fw-semibold">Ringkasan / Deskripsi Pekerjaan</label>
                                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $loker->deskripsi) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Jl. Raya No. 123...">{{ old('alamat', $loker->alamat) }}</textarea>
                                </div>

                                {{-- Tambahan Minimal Pendidikan & Pengalaman untuk Edit --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Minimal Pendidikan</label>
                                    <select name="minimal_pendidikan" class="form-select select2-init">
                                        <option value="">Pilih Pendidikan...</option>
                                        @php
                                            $pendidikans = ['SMP', 'SMA/SMK', 'D3', 'S1/S2', 'Semua Jenjang'];
                                        @endphp
                                        @foreach ($pendidikans as $p)
                                            <option value="{{ $p }}"
                                                {{ old('minimal_pendidikan', $loker->minimal_pendidikan) == $p ? 'selected' : '' }}>
                                                {{ $p == 'SMA/SMK' ? 'SMA/SMK (Sederajat)' : $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-semibold">Pengalaman Kerja</label>
                                    <select name="pengalaman" class="form-select select2-init">
                                        <option value="">Pilih Kategori...</option>
                                        @php
                                            $pengalamans = [
                                                'Fresh Graduate',
                                                'Minimal 1 Tahun',
                                                'Minimal 2 Tahun',
                                                'Minimal 3 Tahun',
                                                'Lebih dari 5 Tahun',
                                            ];
                                        @endphp
                                        @foreach ($pengalamans as $exp)
                                            <option value="{{ $exp }}"
                                                {{ old('pengalaman', $loker->pengalaman) == $exp ? 'selected' : '' }}>
                                                {{ $exp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary fw-bold text-uppercase small tracking-wider mb-2">Detail
                                        Lowongan</h6>
                                    <hr class="mt-0 mb-3 opacity-10">
                                </div>

                                {{-- Tugas Dinamis --}}
                                <div class="col-md-6 mt-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        Tanggung Jawab
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-tugas"><i
                                                class="bi bi-plus-circle"></i></button>
                                    </label>
                                    <div id="tugas-container">
                                        @foreach ($loker->tugas as $t)
                                            <div class="input-group mb-2">
                                                <input type="text" name="tugas[]" class="form-control"
                                                    value="{{ $t }}" required>
                                                <button class="btn btn-outline-danger remove-row" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Persyaratan Dinamis --}}
                                <div class="col-md-6 mt-4">
                                    <label class="form-label fw-semibold d-flex justify-content-between">
                                        Persyaratan
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            id="add-persyaratan"><i class="bi bi-plus-circle"></i></button>
                                    </label>
                                    <div id="persyaratan-container">
                                        @foreach ($loker->persyaratan as $p)
                                            <div class="input-group mb-2">
                                                <input type="text" name="persyaratan[]" class="form-control"
                                                    value="{{ $p }}" required>
                                                <button class="btn btn-outline-danger remove-row" type="button"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">WhatsApp (Format: 628xxx)</label>
                                    <input type="text" name="no_wa" class="form-control" placeholder="62857xxxx"
                                        value="{{ old('no_wa', $loker->no_wa) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Email HRD</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="hrd@perusahaan.com" value="{{ old('email', $loker->email) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">WhatsApp (Format: 628xxx)</label>
                                    <input type="text" name="link_pendaftaran" class="form-control"
                                        placeholder="62857xxxx"
                                        value="{{ old('link_pendaftaran', $loker->link_pendaftaran) }}">
                                </div>

                                {{-- Blog --}}
                                <div class="col-12 mt-4">
                                    <label class="form-label fw-semibold">Pilih Artikel Blog Terkait (Opsional)</label>
                                    <select name="blog_ids[]" class="form-control select2-multiple" multiple="multiple">
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}"
                                                {{ in_array($blog->id, $loker->blogs->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $blog->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg w-100 rounded-3 fw-bold shadow-sm py-3">
                                        Simpan Perubahan Loker
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2-init').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
            $('.select2-multiple').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: "Cari judul blog..."
            });

            // Fungsi Tambah Baris Dinamis (Sama dengan Create)
            function addRow(containerId, name, icon = '') {
                let iconHtml = icon ?
                    `<span class="input-group-text bg-light"><i class="bi bi-${icon} text-primary"></i></span>` :
                    '';
                let html = `
                    <div class="input-group mb-2">
                        ${iconHtml}
                        <input type="text" name="${name}[]" class="form-control" required>
                        <button class="btn btn-outline-danger remove-row" type="button"><i class="bi bi-trash"></i></button>
                    </div>`;
                $(`#${containerId}`).append(html);
            }

            $('#add-benefit').click(() => addRow('benefit-container', 'benefit', 'gift'));
            $('#add-tugas').click(() => addRow('tugas-container', 'tugas'));
            $('#add-persyaratan').click(() => addRow('persyaratan-container', 'persyaratan'));

            $(document).on('click', '.remove-row', function() {
                $(this).closest('.input-group').remove();
            });

            // Logika Wilayah (Sama dengan Create)
            $('#select-kota').on('change', function() {
                let idKota = $(this).find(':selected').data('id');
                if (idKota) {
                    let selectKec = $('#select-kecamatan');
                    selectKec.prop('disabled', true).html('<option value="">Memuat...</option>');
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${idKota}.json`)
                        .then(r => r.json())
                        .then(data => {
                            let options = '<option value="">Pilih Kecamatan...</option>';
                            data.forEach(i => options +=
                                `<option value="${i.name}">${i.name}</option>`);
                            selectKec.html(options).prop('disabled', false);
                        });
                }
            });
        });
    </script>
@endpush
