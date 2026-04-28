@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Cv</h1>
        <a href="{{ route('admin.cv.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Artikel
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Artikel GaweDokumen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablecv" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Template</th>
                            <th>Gambar</th>
                            <th>Color Primary</th>
                            <th>Color Body</th>
                            <th>Color Sidebar</th>
                            <th>Color Sidebar BG</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cvs as $key => $cv)
                            <tr>
                                <td>{{ $cv->key + 1 }}</td>
                                <td>{{ $cv->nama_template }}</td>
                                <td>
                                    @if ($cv->cv_image)
                                        <div class="rounded-3 overflow-hidden" style="width: 200px;">
                                            <img src="{{ asset('storage/' . $cv->cv_image) }}" alt="Background"
                                                class="w-100 h-100" style="object-fit: contain; background-color: #f8f9fa;">
                                        </div>
                                    @else
                                        <span class="badge bg-light text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $cv->color_primary_text }}</td>
                                <td>{{ $cv->color_body_text }}</td>
                                <td>{{ $cv->color_sidebar_text }}</td>
                                <td>{{ $cv->color_sidebar_bg }}</td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.cv.edit', ['cv' => $cv->id]) }}"
                                            class="btn btn-warning btn-circle btn-sm shadow-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.cv.destroy', $cv->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm shadow-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
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


    @push('scripts')
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#dataTablecv').DataTable({
                    "language": {
                        "search": "Cari Artikel:",
                        "lengthMenu": "Tampilkan _MENU_ baris per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Lanjut",
                            "previous": "Kembali"
                        },
                    }
                });
            });
        </script>
    @endpush
@endsection
