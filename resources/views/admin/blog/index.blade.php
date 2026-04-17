@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Blog</h1>
        <a href="{{ route('admin.blog.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Artikel
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Artikel GaweDokumen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableBlog" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $blog->judul }}</td>
                                <td>{{ $blog->kategori }}</td>
                                <td>{{ $blog->penulis }}</td>
                                <td>{{ $blog->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.blog.edit', ['blog' => $blog->id]) }}"
                                            class="btn btn-warning btn-circle btn-sm shadow-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.blog.show', ['blog' => $blog->slug]) }}"
                                            class="btn btn-primary btn-circle btn-sm shadow-sm mr-2">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
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
                $('#dataTableBlog').DataTable({
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
