@extends('admin.layouts.main') {{-- Sesuaikan dengan master layout admin kamu --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Platform Affiliate</h1>
            <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPlatformModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Platform
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="15%">Logo</th>
                                <th>Nama Platform</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($platforms as $key => $platform)
                                <tr class="align-middle">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($platform->logo_platform)
                                            <img src="{{ asset('storage/' . $platform->logo_platform) }}"
                                                class="img-thumbnail"
                                                style="max-height: 40px; max-width: 100px; object-fit: contain;">
                                        @else
                                            <span class="text-muted" style="font-size: 12px;">No Logo</span>
                                        @endif
                                    </td>
                                    <td class="text-left font-weight-bold">{{ $platform->nama_platform }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editPlatformModal{{ $platform->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.platforms.destroy', $platform->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus platform ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editPlatformModal{{ $platform->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Platform</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <form action="{{ route('admin.platforms.update', $platform->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body text-left">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Nama Platform</label>
                                                        <input type="text" name="nama_platform" class="form-control"
                                                            value="{{ $platform->nama_platform }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Ganti Logo Platform</label>
                                                        <input type="file" name="logo_platform"
                                                            class="form-control-file mb-2">
                                                        @if ($platform->logo_platform)
                                                            <small class="text-muted d-block">Logo saat ini:</small>
                                                            <img src="{{ asset('storage/' . $platform->logo_platform) }}"
                                                                class="img-thumbnail mt-1" style="max-height: 50px;">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data platform.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPlatformModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Platform Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('admin.platforms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Platform</label>
                            <input type="text" name="nama_platform" class="form-control"
                                placeholder="Contoh: Shopee, TikTok" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Upload Logo Platform</label>
                            <input type="file" name="logo_platform" class="form-control-file" required>
                            <small class="text-muted">Gunakan file gambar (.png, .jpg) ukuran maks 1MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
