@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white rounded-4 shadow-sm p-4">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="fw-bold mb-0">Manajemen Lowongan Kerja</h4>
                            <p class="text-muted small">Total {{ $lokers->count() }} postingan aktif bulan ini.</p>
                        </div>
                        <a href="{{ route('admin.loker.create') }}" class="btn btn-primary rounded-3 fw-bold px-4">
                            <i class="bi bi-plus-lg me-2"></i>Tambah Loker
                        </a>
                    </div>

                    <form action="{{ route('admin.loker.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" name="q" class="form-control"
                                placeholder="Cari Posisi / Perusahaan..." value="{{ request('q') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tutup">Tutup</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-light w-100 fw-bold border">Filter</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-3 py-3" style="width: 50px;">No</th>
                                    <th class="border-0 py-3">Lowongan</th>
                                    <th class="border-0 py-3">Lokasi</th>
                                    <th class="border-0 py-3">Deadline</th>
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
                                                    style="width: 45px; height: 45px;">
                                                    {{ substr($loker->perusahaan, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold mb-0">{{ $loker->posisi }}</div>
                                                    <small class="text-muted">{{ $loker->perusahaan }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small fw-semibold">{{ $loker->kecamatan }}</div>
                                            <div class="text-muted" style="font-size: 11px;">{{ $loker->kota }}</div>
                                        </td>
                                        <td>
                                            <div
                                                class="small fw-bold {{ \Carbon\Carbon::parse($loker->deadline)->isPast() ? 'text-danger' : '' }}">
                                                {{ \Carbon\Carbon::parse($loker->deadline)->translatedFormat('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill {{ $loker->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }} px-3">
                                                {{ $loker->status }}
                                            </span>
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="/loker/{{ $loker->slug }}" target="_blank"
                                                    class="btn btn-sm btn-light border" title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.loker.edit', $loker->id) }}"
                                                    class="btn btn-sm btn-info text-white" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.loker.destroy', $loker->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus loker ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted italic">Data loker tidak
                                            ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $lokers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-soft-primary {
            background-color: #eef4ff;
        }

        .table thead th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
        }

        .table tbody td {
            font-size: 14px;
        }

        .btn-sm {
            padding: 0.4rem 0.6rem;
            border-radius: 8px;
        }
    </style>
@endsection
