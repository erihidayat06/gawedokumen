@extends('admin.layouts.main')

@section('content')
    <style>
        /* 1. Pastikan area konten dashboard tidak scroll keluar layar */
        .container-fluid {
            height: calc(100vh - 100px);
            /* Sesuaikan dengan tinggi header dashboard */
            display: flex;
            flex-direction: column;
        }

        /* 2. Card dibuat setinggi sisa layar */
        .card.fixed-height-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            /* Mencegah card nembus keluar */
            margin-bottom: 0 !important;
        }

        /* 3. Hanya body yang boleh scroll */
        .card.fixed-height-card .card-body {
            overflow-y: auto;
            flex: 1;
        }

        /* 4. Fix untuk CKEditor agar tidak melebar sembarangan */
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
    <div class="card shadow fixed-height-card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tulis Artikel Baru</h6>
            <div class="header-actions">
                <button type="submit" form="blogForm" class="btn btn-primary btn-sm">Terbitkan</button>
            </div>
        </div>

        <div class="card-body">
            <form id="blogForm" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="font-weight-bold">Judul Artikel</label>
                    <input type="text" name="judul" id="judul"
                        class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}"
                        placeholder="Masukkan judul..." required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Slug URL (SEO)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light text-muted"
                                style="font-size: 0.8rem;">gawedokumen.com/blog/</span>
                        </div>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                            placeholder="nama-slug-artikel" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Kategori</label>
                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                <option value="Tips Karir" {{ old('kategori') == 'Tips Karir' ? 'selected' : '' }}>Tips
                                    Karir</option>
                                <option value="Tutorial" {{ old('kategori') == 'Tutorial' ? 'selected' : '' }}>Tutorial
                                </option>
                                <option value="Update" {{ old('kategori') == 'Update' ? 'selected' : '' }}>Update</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Thumbnail Gambar</label>
                            <input type="file" name="gambar" id="gambarInput"
                                class="form-control-file @error('gambar') is-invalid @enderror" onchange="previewImage()">
                            @error('gambar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            <div class="mt-3">
                                <img id="imgPreview" src="#" alt="Preview Gambar"
                                    class="img-fluid img-thumbnail shadow-sm" style="display: none; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Isi Konten</label>
                    <textarea name="konten" id="editor" class="@error('konten') is-invalid @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            function previewImage() {
                const image = document.querySelector('#gambarInput');
                const imgPreview = document.querySelector('#imgPreview');

                // Pastikan ada file yang dipilih
                if (image.files && image.files[0]) {
                    imgPreview.style.display = 'block'; // Munculkan elemen img

                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.src = oFREvent.target.result;
                    };
                }
            }
        </script>

        <script>
            const judul = document.querySelector('#judul');
            const slug = document.querySelector('#slug');

            judul.addEventListener('keyup', function() {
                // Hanya auto-generate jika slug masih kosong atau belum pernah diedit manual
                // Jika ingin selalu sinkron, hapus pengecekan kondisi ini
                let text = judul.value;
                text = text.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '') // hapus karakter aneh
                    .replace(/\s+/g, '-') // ganti spasi jadi -
                    .replace(/-+/g, '-'); // hapus - yang dobel

                slug.value = text;
            });

            // Validasi saat input slug manual (mencegah spasi dan karakter aneh)
            slug.addEventListener('input', function() {
                this.value = this.value.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-');
            });
        </script>

        {{-- Copy script CKEditor yang sama dengan create.blade.php --}}
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('editor', {
                // --- HILANGKAN PERINGATAN UPGRADE ---
                versionCheck: false,

                filebrowserImageUploadUrl: "{{ route('admin.blog.upload_image') . '?_token=' . csrf_token() }}",

                toolbar: [{
                        name: 'clipboard',
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule']
                    },
                    {
                        name: 'styles',
                        items: ['Format', 'FontSize', 'TextColor']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    }
                ],

                removePlugins: 'easyimage',
                allowedContent: true,
                uploadUrl: "{{ route('admin.blog.upload_image') . '?_token=' . csrf_token() }}"
            });
        </script>
    @endpush
@endsection
