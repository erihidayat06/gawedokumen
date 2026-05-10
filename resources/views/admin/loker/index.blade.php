@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white rounded-4 shadow-sm p-4">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="fw-bold mb-0">Manajemen Lowongan Kerja</h4>
                            <p class="text-muted small">Menampilkan {{ $lokers->total() }} postingan loker.</p>
                        </div>
                        <a href="{{ route('admin.loker.create') }}" class="btn btn-primary rounded-3 fw-bold px-4">
                            <i class="bi bi-plus-lg me-2"></i>Tambah Loker
                        </a>
                    </div>

                    {{-- Form Filter --}}
                    <form action="{{ route('admin.loker.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0"
                                    placeholder="Cari Posisi / Perusahaan / Kota..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Arsip" {{ request('status') == 'Arsip' ? 'selected' : '' }}>Arsip</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4 fw-bold">Filter</button>
                            @if (request()->has('search') || request()->has('status'))
                                <a href="{{ route('admin.loker.index') }}" class="btn btn-outline-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th class="border-0 px-3 py-3" style="width: 50px;">No</th>
                                    <th class="border-0 py-3">Lowongan & Tips</th>
                                    <th class="border-0 py-3">Lokasi</th>
                                    <th class="border-0 py-3 text-center">Status</th>
                                    <th class="border-0 py-3 text-end px-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lokers as $index => $loker)
                                    <tr>
                                        <td class="px-3 text-muted">{{ $lokers->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-soft-primary rounded-3 d-flex align-items-center justify-content-center fw-bold text-primary me-3"
                                                    style="width: 45px; height: 45px; flex-shrink: 0;">
                                                    {{ strtoupper(substr($loker->perusahaan, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold mb-0 text-dark">{{ $loker->posisi }}</div>
                                                    <div class="small text-muted mb-1">{{ $loker->perusahaan }}</div>
                                                    @if ($loker->blogs->count() > 0)
                                                        <span
                                                            class="badge bg-soft-info text-info border-info-subtle small-badge">
                                                            <i
                                                                class="bi bi-link-45deg me-1"></i>{{ $loker->blogs->count() }}
                                                            Tips
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small fw-semibold">{{ $loker->kecamatan }}</div>
                                            <div class="text-muted" style="font-size: 11px;">{{ $loker->kota }}</div>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill {{ $loker->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }} px-3">
                                                {{ $loker->status }}
                                            </span>
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="d-flex justify-content-end gap-2">
                                                {{-- Tombol Lihat - Memicu Modal Unik --}}
                                                <button type="button" class="btn btn-sm btn-light border shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail{{ $loker->id }}">
                                                    <i class="bi bi-eye text-primary"></i>
                                                </button>

                                                <a href="{{ route('admin.loker.edit', $loker->id) }}"
                                                    class="btn btn-sm btn-light border shadow-sm" title="Edit Data">
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>

                                                <form action="{{ route('admin.loker.destroy', $loker->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus loker ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light border shadow-sm">
                                                        <i class="bi bi-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- MODAL DETAIL (Looping) --}}
                                    <div class="modal fade" id="modalDetail{{ $loker->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered text-start">
                                            <div class="modal-content rounded-4 border-0 shadow-lg">
                                                <div class="modal-header border-0 bg-light rounded-top-4 px-4 py-3">
                                                    <h5 class="modal-title fw-bold text-dark">Detail Pekerjaan:
                                                        {{ $loker->posisi }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row g-4">
                                                        {{-- Kolom Kiri --}}
                                                        <div class="col-lg-8">
                                                            <div class="mb-4">
                                                                <h4 class="fw-black text-primary mb-1">
                                                                    {{ $loker->perusahaan }}</h4>
                                                                <p class="text-muted"><i
                                                                        class="bi bi-geo-alt me-1"></i>{{ $loker->alamat }},
                                                                    {{ $loker->kecamatan }}, {{ $loker->kota }}</p>
                                                            </div>

                                                            {{-- TAMBAHAN: Card Info Utama (Pendidikan & Pengalaman) --}}
                                                            <div class="row g-3 mb-4">
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="p-3 border rounded-3 bg-white shadow-sm d-flex align-items-center">
                                                                        <div class="bg-soft-primary p-2 rounded-2 me-3">
                                                                            <i
                                                                                class="bi bi-mortarboard-fill text-primary fs-5"></i>
                                                                        </div>
                                                                        <div>
                                                                            <small
                                                                                class="text-muted d-block text-uppercase fw-bold"
                                                                                style="font-size: 10px;">Min.
                                                                                Pendidikan</small>
                                                                            <span
                                                                                class="fw-bold text-dark">{{ $loker->minimal_pendidikan ?? 'Semua Jenjang' }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="p-3 border rounded-3 bg-white shadow-sm d-flex align-items-center">
                                                                        <div class="bg-soft-info p-2 rounded-2 me-3">
                                                                            <i
                                                                                class="bi bi-briefcase-fill text-info fs-5"></i>
                                                                        </div>
                                                                        <div>
                                                                            <small
                                                                                class="text-muted d-block text-uppercase fw-bold"
                                                                                style="font-size: 10px;">Pengalaman</small>
                                                                            <span
                                                                                class="fw-bold text-dark">{{ $loker->pengalaman ?? 'Fresh Graduate' }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label
                                                                    class="fw-bold text-dark border-bottom pb-2 d-block mb-2">Deskripsi
                                                                    & Ringkasan</label>
                                                                <div class="bg-light p-3 rounded-3"
                                                                    style="white-space: pre-line;">
                                                                    {{ $loker->deskripsi ?? 'Tidak ada deskripsi.' }}
                                                                </div>
                                                            </div>

                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="card card-body border-0 bg-light rounded-3">
                                                                        <small
                                                                            class="text-muted fw-bold text-uppercase">Range
                                                                            Gaji</small>
                                                                        <span
                                                                            class="fs-5 fw-bold text-success">{{ $loker->gaji ?? 'Tidak disebutkan' }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="card card-body border-0 bg-light rounded-3">
                                                                        <small
                                                                            class="text-muted fw-bold text-uppercase">Batas
                                                                            Pendaftaran</small>
                                                                        @if ($loker->deadline)
                                                                            <span class="fs-5 fw-bold text-danger d-block">
                                                                                {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d F Y') }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="fs-5 fw-bold text-primary d-block">
                                                                                Sampai Kuota Terpenuhi
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Kolom Kanan --}}
                                                        <div class="col-lg-4 border-start">
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold text-dark mb-2"><i
                                                                        class="bi bi-check2-circle text-primary me-2"></i>Persyaratan
                                                                    Khusus</h6>
                                                                <ul class="list-unstyled small ps-1">
                                                                    @foreach ($loker->persyaratan as $syarat)
                                                                        <li class="mb-2 d-flex"><i
                                                                                class="bi bi-dot text-primary fs-4 mt-n2"></i>
                                                                            {{ $syarat }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold text-dark mb-2"><i
                                                                        class="bi bi-gift text-primary me-2"></i>Benefit
                                                                </h6>
                                                                <ul class="list-unstyled small ps-1">
                                                                    @foreach ($loker->benefit as $b)
                                                                        <li class="mb-2 d-flex"><i
                                                                                class="bi bi-dot text-primary fs-4 mt-n2"></i>
                                                                            {{ $b }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="mb-4">
                                                                <h6 class="fw-bold text-dark mb-2"><i
                                                                        class="bi bi-link-45deg text-primary me-2"></i>Artikel
                                                                    Tips Terkait</h6>
                                                                @forelse($loker->blogs as $blog)
                                                                    <a href="{{ url('blog/' . $blog->slug) }}"
                                                                        target="_blank"
                                                                        class="d-block p-2 bg-light rounded-2 text-decoration-none mb-2 small border-start border-primary border-4">
                                                                        {{ $blog->judul }}
                                                                    </a>
                                                                @empty
                                                                    <p class="text-muted small italic">Belum ada artikel
                                                                        blog.</p>
                                                                @endforelse
                                                            </div>
                                                            <div class="card card-body bg-soft-primary border-0 small">
                                                                <p class="mb-1"><strong>WhatsApp:</strong>
                                                                    {{ $loker->no_wa ?? '-' }}</p>
                                                                <p class="mb-0"><strong>Email:</strong>
                                                                    {{ $loker->email ?? '-' }}</p>
                                                                <p class="mb-0"><strong>Link Pendaftaran:</strong>
                                                                    {{ $loker->link_pendaftaran ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary px-4 fw-bold"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="{{ route('admin.loker.edit', $loker->id) }}"
                                                        class="btn btn-primary px-4 fw-bold">Edit Loker</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png"
                                                width="80" class="opacity-25 mb-3">
                                            <p class="text-muted italic">Oops! Data loker tidak ditemukan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $lokers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-soft-primary {
            background-color: #eef4ff;
            color: #0052cc;
        }

        .bg-soft-info {
            background-color: #e0f7fa;
            color: #00838f;
            border: 1px solid #b2ebf2;
        }

        .small-badge {
            font-size: 10px;
            padding: 2px 8px;
            font-weight: 600;
        }

        .table thead th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #f8f9fa;
        }

        .btn-sm {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .fw-black {
            font-weight: 900;
        }
    </style>
@endsection
