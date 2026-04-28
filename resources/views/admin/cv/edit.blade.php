@extends('admin.layouts.main')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    {{-- Inisialisasi x-data dengan data dari database --}}
    <div x-data="cvForm({
        primary_text: '{{ $cv->color_primary_text }}',
        nama_template: '{{ $cv->nama_template }}',
        body_text: '{{ $cv->color_body_text }}',
        sidebar_bg: '{{ $cv->color_sidebar_bg }}',
        sidebar_text: '{{ $cv->color_sidebar_text }}',
        existingImage: '{{ asset('storage/' . $cv->cv_image) }}'
    })" class="container py-5">

        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-black text-uppercase tracking-tighter italic">Edit Desain CV</h2>
                <p class="text-muted">Perbarui tampilan visual kustom untuk ID: #{{ $cv->id }}</p>
            </div>
        </div>

        {{-- Gunakan method PUT untuk update --}}
        <form action="{{ route('admin.cv.update', $cv->id) }}" method="POST" enctype="multipart/form-data"
            @submit="loading = true">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Kiri: Background --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary rounded-pill me-2" style="width: 5px; height: 25px;"></div>
                                <h5 class="card-title fw-bold m-0">Background CV</h5>
                            </div>

                            <div class="mb-4">
                                <label for="nama_template"
                                    class="form-label small fw-black text-muted text-uppercase tracking-wider">Nama
                                    Template</label>
                                <input type="text" name="nama_template" x-model="nama_template"
                                    class="form-control form-control-sm rounded-3 shadow-sm"
                                    placeholder="Contoh: CV Profesional Biru" required>
                            </div>
                            <div class="mb-4 text-center">

                                <label
                                    class="form-label small fw-black text-muted text-uppercase tracking-wider d-block mb-3">Preview
                                    Background</label>
                                <div class="rounded-4 border bg-light d-flex align-items-center justify-content-center overflow-hidden p-3"
                                    style="height: 250px; border-style: dashed !important; border-width: 2px !important;">

                                    {{-- Munculkan gambar lama atau gambar baru yang dipilih --}}
                                    <template x-if="imageUrl">
                                        <img :src="imageUrl" class="img-fluid rounded-2 shadow-sm"
                                            style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    </template>

                                    <template x-if="!imageUrl">
                                        <div class="text-muted small px-3">
                                            <i class="bi bi-image d-block fs-2 mb-2"></i>
                                            Belum ada gambar baru
                                        </div>
                                    </template>
                                </div>
                                <p class="extra-small text-muted mt-2">Gambar saat ini tetap digunakan jika tidak memilih
                                    file baru.</p>
                            </div>

                            <div class="mb-0">
                                <label class="form-label small fw-black text-muted text-uppercase tracking-wider">Ganti File
                                    Gambar</label>
                                <input type="file" name="cv_image" class="form-control form-control-sm rounded-3"
                                    @change="fileChosen">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Skema Warna --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success rounded-pill me-2" style="width: 5px; height: 25px;"></div>
                                <h5 class="card-title fw-bold m-0">Skema Warna & Identitas Visual</h5>
                            </div>

                            <div class="row g-4">
                                {{-- Content Colors --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-4 border border-white">
                                        <p class="small fw-black text-primary border-bottom pb-2 mb-3">WARNA TEKS CONTENT
                                        </p>
                                        <div class="mb-3">
                                            <label class="form-label extra-small fw-bold text-muted">TEKS UTAMA</label>
                                            <div class="input-group">
                                                <input type="color" x-model="colors.primary_text"
                                                    name="color_primary_text"
                                                    class="form-control form-control-color border-0 p-1 bg-transparent"
                                                    style="max-width: 60px;">
                                                <input type="text" x-model="colors.primary_text"
                                                    class="form-control form-control-sm font-monospace bg-white border-start-0 text-uppercase">
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label extra-small fw-bold text-muted">TEKS ISI (BODY)</label>
                                            <div class="input-group">
                                                <input type="color" x-model="colors.body_text" name="color_body_text"
                                                    class="form-control form-control-color border-0 p-1 bg-transparent"
                                                    style="max-width: 60px;">
                                                <input type="text" x-model="colors.body_text"
                                                    class="form-control form-control-sm font-monospace bg-white border-start-0 text-uppercase">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sidebar Colors --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-4 border border-white">
                                        <p class="small fw-black text-success border-bottom pb-2 mb-3">WARNA SIDEBAR AREA
                                        </p>
                                        <div class="mb-3">
                                            <label class="form-label extra-small fw-bold text-muted">BG SIDEBAR</label>
                                            <div class="input-group">
                                                <input type="color" x-model="colors.sidebar_bg" name="color_sidebar_bg"
                                                    class="form-control form-control-color border-0 p-1 bg-transparent"
                                                    style="max-width: 60px;">
                                                <input type="text" x-model="colors.sidebar_bg"
                                                    class="form-control form-control-sm font-monospace bg-white border-start-0 text-uppercase">
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label extra-small fw-bold text-muted">TEKS SIDEBAR</label>
                                            <div class="input-group">
                                                <input type="color" x-model="colors.sidebar_text"
                                                    name="color_sidebar_text"
                                                    class="form-control form-control-color border-0 p-1 bg-transparent"
                                                    style="max-width: 60px;">
                                                <input type="text" x-model="colors.sidebar_text"
                                                    class="form-control form-control-sm font-monospace bg-white border-start-0 text-uppercase">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.cv.index') }}"
                                class="btn btn-light w-100 py-3 rounded-4 fw-bold">Batal</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" :disabled="loading"
                                class="btn btn-dark w-100 py-3 rounded-4 shadow-sm fw-black text-uppercase d-flex align-items-center justify-content-center gap-2">
                                <template x-if="loading">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </template>
                                <span x-text="loading ? 'Menyimpan...' : 'Update Desain'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function cvForm(initialData) {
            return {
                loading: false,
                imageUrl: initialData.existingImage || null,
                nama_template: initialData.nama_template,
                colors: {
                    primary_text: initialData.primary_text,
                    body_text: initialData.body_text,
                    sidebar_bg: initialData.sidebar_bg,
                    sidebar_text: initialData.sidebar_text
                },
                fileChosen(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire('Error', 'File terlalu besar (Maks 2MB)', 'error');
                        event.target.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>

    {{-- Re-use styles yang sama --}}
    <style>
        .fw-black {
            font-weight: 900;
        }

        .rounded-4 {
            border-radius: 1.5rem !important;
        }

        .extra-small {
            font-size: 0.65rem;
            letter-spacing: 1px;
        }

        input[type="text"] {
            text-transform: uppercase;
        }
    </style>
@endsection
