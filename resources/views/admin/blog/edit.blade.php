@extends('admin.layouts.main')

@section('content')
    <style>
        /* Paksa alignment gambar jika Tailwind prose belum menghandle */
        .prose .image-style-side {
            float: right;
            margin-left: 1.5rem;
            max-width: 50%;
        }

        .prose .image {
            display: table;
            clear: both;
            text-align: center;
            margin: 1em auto;
        }
    </style>
    <div class="card shadow fixed-height-card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Artikel: {{ $blog->judul }}</h6>
            <button type="submit" form="editBlogForm" class="btn btn-primary btn-sm">Simpan Perubahan</button>
        </div>

        <div class="card-body">
            <form id="editBlogForm" action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- PENTING: Untuk Update di Laravel --}}

                <div class="form-group">
                    <label class="font-weight-bold">Judul Artikel</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ $blog->judul }}"
                        required>
                </div>

                {{-- INPUT SLUG UNTUK EDIT --}}
                <div class="form-group">
                    <label class="font-weight-bold">Slug URL (SEO)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light text-muted"
                                style="font-size: 0.8rem;">gawedokumen.com/blog/</span>
                        </div>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ $blog->slug }}"
                            required>
                    </div>
                    <small class="text-info">
                        <i class="fas fa-exclamation-triangle"></i> Hati-hati: Mengubah slug akan mengubah URL artikel.
                    </small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="Tips Karir" {{ $blog->kategori == 'Tips Karir' ? 'selected' : '' }}>Tips
                                    Karir</option>
                                <option value="Tutorial" {{ $blog->kategori == 'Tutorial' ? 'selected' : '' }}>Tutorial
                                </option>
                                <option value="Update" {{ $blog->kategori == 'Update' ? 'selected' : '' }}>Update</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Ganti Thumbnail (Opsional)</label>
                            <input type="file" name="gambar" class="form-control-file" id="gambarInput"
                                onchange="previewImage()">

                            <div class="mt-3">
                                @if ($blog->gambar)
                                    <img id="imgPreview" src="{{ asset('uploads/blog/' . $blog->gambar) }}"
                                        alt="Preview Gambar" class="img-fluid img-thumbnail shadow-sm"
                                        style="max-height: 200px; display: block;">
                                    <small class="text-muted d-block mt-1" id="fileOldName">Gambar saat ini:
                                        {{ $blog->gambar }}</small>
                                @else
                                    <img id="imgPreview" src="#" alt="Preview Gambar"
                                        class="img-fluid img-thumbnail shadow-sm" style="max-height: 200px; display: none;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Isi Konten</label>
                    <textarea name="konten" id="editor">{{ $blog->konten }}</textarea>
                </div>

                <div class="mt-4 mb-5">
                    <button type="submit" class="btn btn-primary">Update Artikel</button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');

        // Kita hanya aktifkan auto-slug jika user mengosongkan input slug
        judul.addEventListener('keyup', function() {
            // Hapus baris if di bawah ini jika ingin slug SELALU mengikuti judul
            if (slug.value == '') {
                let text = judul.value;
                text = text.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slug.value = text;
            }
        });

        slug.addEventListener('input', function() {
            this.value = this.value.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-');
        });
    </script>
    <script>
        function previewImage() {
            const image = document.querySelector('#gambarInput');
            const imgPreview = document.querySelector('#imgPreview');
            const oldText = document.querySelector('#fileOldName');

            // Munculkan preview
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                // Sembunyikan teks "Gambar saat ini" karena sudah diganti preview baru
                if (oldText) oldText.style.display = 'none';
            };
        }
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
