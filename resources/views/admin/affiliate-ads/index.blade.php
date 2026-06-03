@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Iklan Affiliate</h1>
            <a href="{{ route('admin.affiliate-ads.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Iklan Baru
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="8%">Foto</th>
                                <th>Nama Produk</th>
                                <th width="12%">Harga</th> {{-- Kolom Harga Baru --}}
                                <th width="10%">Platform</th>
                                <th width="10%">Kategori</th>
                                <th>Custom Shortlink</th>
                                <th width="8%">Total Klik</th>
                                <th width="8%">Status</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $key => $ad)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($ad->gambar_produk)
                                            <img src="{{ asset('storage/' . $ad->gambar_produk) }}"
                                                class="rounded shadow-sm"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded text-muted d-flex align-items-center justify-content-center mx-auto"
                                                style="width: 50px; height: 50px; font-size: 10px;">No Img</div>
                                        @endif
                                    </td>
                                    <td class="text-left text-wrap" style="max-width: 200px;">
                                        <span class="font-weight-bold text-dark">{{ $ad->nama_produk }}</span>
                                    </td>
                                    <td class="text-left">
                                        {{-- Render Info Harga --}}
                                        @if ($ad->harga_diskon)
                                            <div class="text-danger font-weight-bold" style="font-size: 13px;">
                                                Rp{{ number_format($ad->harga_diskon, 0, ',', '.') }}
                                            </div>
                                        @endif
                                        @if ($ad->harga_asli && $ad->harga_asli > $ad->harga_diskon)
                                            <small class="text-muted text-strikethrough line-through"
                                                style="font-size: 11px;">
                                                Rp{{ number_format($ad->harga_asli, 0, ',', '.') }}
                                            </small>
                                        @endif
                                        @if (!$ad->harga_diskon && !$ad->harga_asli)
                                            <span class="text-muted italic" style="font-size: 12px;">-</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-info">{{ $ad->platform->nama_platform }}</span></td>
                                    <td><span class="badge badge-dark">{{ $ad->category->nama_kategori }}</span></td>
                                    <td class="text-left text-wrap" style="max-width: 180px;">
                                        {{-- Menampilkan shortlink internal aplikasi kamu, bukan link aslinya --}}
                                        <a href="{{ url('r/' . $ad->custom_slug) }}" target="_blank"
                                            class="font-weight-bold text-primary" style="font-size: 12px;">
                                            /r/{{ $ad->custom_slug }}
                                        </a>
                                        <br>
                                        <small class="text-muted text-truncate d-inline-block" style="max-width: 100%;"
                                            title="{{ $ad->affiliate_url }}">
                                            Target: {{ $ad->affiliate_url }}
                                        </small>
                                    </td>
                                    <td><span class="font-weight-bold text-success">{{ $ad->total_views }} x</span></td>
                                    <td>
                                        <span
                                            class="badge {{ $ad->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $ad->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.affiliate-ads.edit', $ad->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.affiliate-ads.destroy', $ad->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus permanen iklan produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum ada iklan produk affiliate yang
                                        didaftarkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
