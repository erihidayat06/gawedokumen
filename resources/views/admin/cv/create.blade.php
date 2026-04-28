@extends('admin.layouts.main')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Mantap, Lur!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Oke Sip',
            border: 'none',
            customClass: {
                popup: 'rounded-4 shadow'
            }
        });
    </script>
@endif
@section('content')
    <div x-data="cvForm()" class="container py-5">

        @if (session('success'))
            <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4 animate__animated animate__fadeIn">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-black text-uppercase tracking-tighter italic">Desain CV</h2>
                <p class="text-muted">Buat dan atur tampilan visual CV secara kustom.</p>
            </div>
        </div>




        <form action="{{ route('admin.cv.store') }}" method="POST" enctype="multipart/form-data" @submit="loading = true">
            @csrf
            <div class="row g-4">

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
                                    class="form-control form-control-sm rounded-3" placeholder="Misal: Modern Elegant Blue"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label
                                    class="form-label small fw-black text-muted text-uppercase tracking-wider d-block mb-3">Preview
                                    Background</label>
                                <div class="rounded-4 border bg-light d-flex align-items-center justify-content-center overflow-hidden p-3"
                                    style="height: 250px; border-style: dashed !important; border-width: 2px !important;">

                                    <template x-if="imageUrl">
                                        <img :src="imageUrl" class="img-fluid rounded-2 shadow-sm"
                                            style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    </template>

                                    <template x-if="!imageUrl">
                                        <div class="text-muted small px-3 text-center">
                                            <i class="bi bi-image d-block fs-2 mb-2"></i>
                                            Belum ada gambar dipilih
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-black text-muted text-uppercase tracking-wider">Pilih File
                                    Gambar</label>
                                <input type="file" name="cv_image" class="form-control form-control-sm rounded-3"
                                    @change="fileChosen">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success rounded-pill me-2" style="width: 5px; height: 25px;"></div>
                                <h5 class="card-title fw-bold m-0">Skema Warna & Identitas Visual</h5>
                            </div>

                            <div class="row g-4">
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

                    <div class="col-lg-8">
                        <button type="submit" :disabled="loading"
                            class="btn btn-dark w-100 py-3 rounded-4 shadow-sm fw-black text-uppercase letter-spacing-2 d-flex align-items-center justify-content-center gap-2">

                            <template x-if="loading">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                            </template>

                            <span x-text="loading ? 'Sedang Memproses...' : 'Simpan Desain CV'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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

        .letter-spacing-2 {
            letter-spacing: 3px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }

        /* Styling tambahan agar input HEX terlihat rapi */
        input[type="text"] {
            text-transform: uppercase;
        }
    </style>

    <script>
        function cvForm() {
            return {
                loading: false, // State untuk tombol
                full_name: '',
                imageUrl: null,
                colors: {
                    primary_text: '#1E293B',
                    body_text: '#475569',
                    sidebar_bg: '#F8FAFC',
                    sidebar_text: '#334155'
                },
                fileChosen(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Feedback: Cek ukuran file sebelum upload (Client-side validation)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar, Lur! Maksimal 2MB.');
                        event.target.value = ''; // Reset input
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
@endsection
