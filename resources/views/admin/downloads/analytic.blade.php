@extends('admin.layouts.main')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-fluid">
        <h1 class="h3 mb-4">Analitik Unduhan Dokumen</h1>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.downloads.analytic') }}" method="GET" class="form-inline">
                    <input type="date" name="start_date" class="form-control mr-2" value="{{ request('start_date') }}">
                    <input type="date" name="end_date" class="form-control mr-2" value="{{ request('end_date') }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach (['Hari Ini' => 'today', 'Bulan Ini' => 'month', 'Tahun Ini' => 'year'] as $label => $key)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $label }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($statsCard[$key]) }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Total Unduhan Berdasarkan Filter Tanggal</h6>
                    </div>
                    <div class="card-body">
                        <h3>{{ number_format($topDocuments->sum('total')) }} Unduhan</h3>
                        <p class="text-muted">Total dari {{ request('start_date', 'awal') }} sampai
                            {{ request('end_date', 'sekarang') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Unduhan Harian</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 300px;">
                    <canvas id="myDownloadChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('myDownloadChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line', // Bisa diganti 'bar'
                data: {
                    labels: {!! json_encode($stats->pluck('date')) !!}, // Tanggal dari database
                    datasets: [{
                        label: 'Jumlah Unduhan',
                        data: {!! json_encode($stats->pluck('total_downloads')) !!}, // Data angka
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top Dokumen Paling Sering Diunduh</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Jumlah Unduhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topDocuments as $doc)
                                <tr>
                                    <td>{{ ucwords(str_replace('_', ' ', $doc->document_name)) }}</td>
                                    <td class="font-weight-bold text-success">{{ number_format($doc->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
