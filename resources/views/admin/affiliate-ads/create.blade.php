@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Iklan Affiliate Baru</h1>
            <a href="{{ route('admin.affiliate-ads.index') }}" class="btn btn-sm btn-secondary shadow-sm">Kembali</a>
        </div>

        {{-- Validasi Error Bawaan Laravel --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.affiliate-ads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Nama Produk <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_produk"
                                    class="form-control @error('nama_produk') is-invalid @enderror"
                                    value="{{ old('nama_produk') }}"
                                    placeholder="Contoh: Kabel Data Baseus Type C Fast Charge" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Platform <span
                                        class="text-danger">*</span></label>
                                <select name="platform_id" class="form-control @error('platform_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Platform --</option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}"
                                            {{ old('platform_id') == $platform->id ? 'selected' : '' }}>
                                            {{ $platform->nama_platform }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Kategori <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Deskripsi Pendek / Catatan Caption</label>
                        <textarea name="deskripsi_pendek" class="form-control @error('deskripsi_pendek') is-invalid @enderror" rows="3"
                            placeholder="Tulis catatan promosi atau review singkat di sini...">{{ old('deskripsi_pendek') }}</textarea>
                    </div>

                    {{-- Baris Baru: Link Affiliate, Harga Diskon, dan Harga Asli --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Link Affiliate Unik <span
                                        class="text-danger">*</span></label>
                                <input type="url" name="affiliate_url"
                                    class="form-control @error('affiliate_url') is-invalid @enderror"
                                    value="{{ old('affiliate_url') }}" placeholder="Contoh: https://shope.ee/8A9xyz123"
                                    required>
                                <small class="text-muted">Masukkan link affiliate dari Shopee/TikTok/Tokopedia.</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Harga Diskon (Harga Jual)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" name="harga_diskon"
                                        class="form-control @error('harga_diskon') is-invalid @enderror"
                                        value="{{ old('harga_diskon') }}" placeholder="Contoh: 45000" min="0">
                                </div>
                                <small class="text-muted">Harga aktif saat ini.</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Harga Asli (Harga Coret)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" name="harga_asli"
                                        class="form-control @error('harga_asli') is-invalid @enderror"
                                        value="{{ old('harga_asli') }}" placeholder="Contoh: 120000" min="0">
                                </div>
                                <small class="text-muted">Kosongkan jika tidak ada coretan.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Custom Slug (Shortlink Internal)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">/r/</span>
                                    </div>
                                    <input type="text" name="custom_slug"
                                        class="form-control @error('custom_slug') is-invalid @enderror"
                                        value="{{ old('custom_slug') }}" placeholder="charger-baseus">
                                </div>
                                <small class="text-muted">Kosongkan jika ingin dibuat otomatis dari nama produk.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Foto / Gambar Produk</label>
                                <input type="file" name="gambar_produk"
                                    class="form-control-file @error('gambar_produk') is-invalid @enderror">
                                <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maks: 2MB.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Status Tayang</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif
                                        (Tampilkan)</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif
                                        (Sembunyikan)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan Data Iklan</button>
                        <a href="{{ route('admin.affiliate-ads.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
