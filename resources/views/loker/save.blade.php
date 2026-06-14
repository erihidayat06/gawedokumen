@extends('admin.layouts.main')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Loker yang Disimpan</h2>

        @if ($savedJobs->isEmpty())
            <div class="alert alert-info">Anda belum menyimpan loker apa pun.</div>
        @else
            {{-- 1. Tampilan TABLE (Hanya muncul di Desktop: d-md-block) --}}
            <div class="card shadow-sm d-none d-md-block">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Posisi</th>
                                    <th>Perusahaan</th>
                                    <th>Lokasi</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savedJobs as $saved)
                                    <tr>
                                        <td class="fw-bold">{{ $saved->loker->posisi }}</td>
                                        <td>{{ $saved->loker->perusahaan }}</td>
                                        <td>{{ $saved->loker->kecamatan }}, {{ $saved->loker->kota }}</td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end align-items-center">
                                                {{-- Tombol Detail --}}
                                                <a href="{{ route('loker.show', $saved->loker->slug) }}"
                                                    class="btn btn-sm btn-outline-primary me-2">Detail</a>

                                                {{-- Form Hapus --}}
                                                <form action="{{ route('dashboard.saved-jobs.destroy', $saved->id) }}"
                                                    method="POST" class="m-0">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Hapus?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 2. Tampilan CARD (Hanya muncul di Mobile: d-md-none) --}}
            <div class="d-md-none">
                @foreach ($savedJobs as $saved)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $saved->loker->posisi }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $saved->loker->perusahaan }}</h6>
                            <p class="card-text small text-muted mb-3">{{ $saved->loker->kecamatan }},
                                {{ $saved->loker->kota }}</p>

                            <div class="d-flex gap-2">
                                <a href="{{ route('loker.show', $saved->loker->slug) }}"
                                    class="btn btn-sm btn-outline-primary flex-fill">Detail</a>
                                <form action="{{ route('dashboard.saved-jobs.destroy', $saved->id) }}" method="POST"
                                    class="flex-fill">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                        onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
