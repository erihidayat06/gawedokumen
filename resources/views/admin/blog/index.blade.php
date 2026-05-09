@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    {{-- Header --}}
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">Manajemen Artikel Blog</h4>
                                <p class="text-muted small mb-0">Total {{ $blogs->total() }} artikel aktif.</p>
                            </div>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary rounded-3 fw-bold px-4">
                                <i class="bi bi-plus-lg me-2"></i>Tambah Artikel
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- Form Filter --}}
                        <form action="{{ route('admin.blog.index') }}" method="GET" class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="input-group bg-light rounded-3 overflow-hidden border">
                                    <span class="input-group-text bg-transparent border-0"><i
                                            class="bi bi-search text-muted"></i></span>
                                    <input type="text" name="search"
                                        class="form-control border-0 bg-transparent shadow-none"
                                        placeholder="Cari judul artikel..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-2 justify-content-md-end">
                                <button type="submit" class="btn btn-dark px-4 fw-bold shadow-sm">Filter</button>
                                @if (request()->has('search'))
                                    <a href="{{ route('admin.blog.index') }}"
                                        class="btn btn-outline-secondary px-3 shadow-sm">Reset</a>
                                @endif
                            </div>
                        </form>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle border-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-3 py-3 text-muted" style="width: 50px;">No</th>
                                        <th class="border-0 py-3 text-muted">Informasi Artikel</th>
                                        <th class="border-0 py-3 text-muted">Kategori</th>
                                        <th class="border-0 py-3 text-muted">Penulis</th>
                                        <th class="border-0 py-3 text-muted">Terbit</th>
                                        <th class="border-0 py-3 text-end px-3 text-muted">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogs as $index => $blog)
                                        <tr>
                                            <td class="px-3 text-muted">{{ $blogs->firstItem() + $index }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-soft-warning rounded-3 d-flex align-items-center justify-content-center fw-bold text-warning me-3"
                                                        style="width: 48px; height: 48px; flex-shrink: 0;">
                                                        <i class="bi bi-file-earmark-richtext fs-5"></i>
                                                    </div>
                                                    <div style="max-width: 300px;">
                                                        <div class="fw-bold mb-0 text-dark text-truncate">
                                                            {{ $blog->judul }}</div>
                                                        <small class="text-muted text-xs d-block">slug:
                                                            {{ $blog->slug }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-soft-primary text-primary px-3 rounded-pill fw-bold"
                                                    style="font-size: 11px;">
                                                    {{ $blog->kategori }}
                                                </span>
                                            </td>
                                            <td class="small fw-semibold text-dark">{{ $blog->penulis }}</td>
                                            <td class="small text-muted">{{ $blog->created_at->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="text-end px-3">
                                                <div class="d-flex justify-content-end gap-2">
                                                    {{-- Tombol View --}}
                                                    <button type="button"
                                                        class="btn btn-sm btn-light border shadow-sm btn-action text-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalBlog{{ $blog->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                        class="btn btn-sm btn-light border shadow-sm btn-action text-info">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('admin.blog.destroy', $blog->id) }}"
                                                        method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-light border shadow-sm btn-action text-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">Data tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PINDAHKAN LOOP MODAL KE SINI (DI LUAR CARD/TABEL) --}}
    @foreach ($blogs as $blog)
        <div class="modal fade" id="modalBlog{{ $blog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered text-start">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header border-0 bg-light rounded-top-4 px-4 py-3">
                        <h5 class="modal-title fw-bold text-dark">Detail Artikel</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <div>
                                <img src="{{ asset('storage/uploads/blog/' . $blog->gambar) }}" alt="{{ $blog->judul }}"
                                    class="col-12 mb-3 rounded-3 shadow-sm">
                            </div>
                            <span
                                class="badge bg-primary px-3 py-2 rounded-pill mb-2 shadow-sm">{{ $blog->kategori }}</span>
                            <h3 class="fw-bold text-dark mb-1">{{ $blog->judul }}</h3>
                            <p class="text-muted small">Ditulis oleh <strong>{{ $blog->penulis }}</strong> |
                                {{ $blog->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <hr class="opacity-10">
                        <div class="blog-content text-dark p-2"
                            style="max-height: 400px; overflow-y: auto; font-size: 14px; line-height: 1.7;">
                            {!! $blog->konten !!}
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-3 px-4 fw-bold"
                            data-bs-dismiss="modal">Tutup</button>
                        <a href="{{ url('blog/' . $blog->slug) }}" target="_blank"
                            class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                            <i class="bi bi-box-arrow-up-right me-2"></i>Lihat Live
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .bg-soft-warning {
            background-color: #fff9db;
            color: #f59f00;
        }

        .bg-soft-primary {
            background-color: #eef4ff;
            color: #0052cc;
        }

        .table thead th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            background-color: #fff !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .blog-content::-webkit-scrollbar {
            width: 4px;
        }

        .blog-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>
@endsection
