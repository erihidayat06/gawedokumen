@extends('admin.layouts.main')

@section('content')
    <style>
        /* 1. Pastikan area konten dashboard tidak scroll keluar layar */
        .container-fluid {
            height: calc(100vh - 100px);
            display: flex;
            flex-direction: column;
        }

        /* 2. Card dibuat setinggi sisa layar */
        .card.fixed-height-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
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

        /* Memaksa tabel mengambil ruang penuh dan memberi jarak bawah */
        .cke_editable table {
            display: table !important;
            width: 100% !important;
            margin-bottom: 20px !important;
            clear: both;
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
                    <label class="font-weight-bold">Link Membuat</label>
                    @include('admin.blog.select_link')
                    <div class="mt-3">
                        <input type="text" name="text" id="text"
                            class="form-control @error('text') is-invalid @enderror" value="{{ old('text') }}"
                            placeholder="Contoh: posisi=Admin&nama=Budi">
                    </div>

                    <button type="button" id="tambah-link" class="btn btn-sm btn-warning mt-3 text-black">Tambahkan
                        Link</button>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Isi Konten</label>
                    <textarea name="konten" id="editor" class="@error('konten') is-invalid @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4 mb-5">
                    <button type="submit" class="btn btn-primary">Terbitkan</button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @stack('scriptsLink')

    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('editor', {
                versionCheck: false,
                extraPlugins: 'justify',
                filebrowserImageUploadUrl: "{{ route('admin.blog.upload_image') . '?_token=' . csrf_token() }}",
                toolbar: [{
                        name: 'mode',
                        items: ['Source']
                    },
                    {
                        name: 'clipboard',
                        items: ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord']
                    },
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                            'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink', 'Anchor']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe']
                    },
                    {
                        name: 'styles',
                        items: ['Format', 'FontSize', 'TextColor', 'BGColor']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize', 'ShowBlocks']
                    }
                ],
                removePlugins: 'easyimage',
                allowedContent: true
            });
        </script>
    @endpush
@endsection
