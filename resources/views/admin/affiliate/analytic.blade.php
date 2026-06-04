@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Analitik Klik Affiliate</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.affiliate.analytic') }}" method="GET" class="form-inline">
                    <label class="mr-2">Dari:</label>
                    <input type="date" name="start_date" class="form-control mr-3"
                        value="{{ request('start_date', date('Y-m-d', strtotime('-30 days'))) }}">

                    <label class="mr-2">Sampai:</label>
                    <input type="date" name="end_date" class="form-control mr-3"
                        value="{{ request('end_date', date('Y-m-d')) }}">

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.affiliate.analytic') }}" class="btn btn-secondary ml-2">Reset</a>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach (['Hari Ini' => 'today', 'Bulan Ini' => 'month', 'Tahun Ini' => 'year'] as $label => $key)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $label }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($statsCard[$key]) }} Klik
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik 30 Hari Terakhir</h6>
            </div>
            <div class="card-body">
                <div class="chart-area"><canvas id="myAreaChart"></canvas></div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top 20 Produk Terpopuler</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Produk</th>
                                <th width="15%">Total Klik</th>
                                <th width="15%">Platform</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top20Products as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a href="{{ url('r/' . $p->custom_slug) }}" target="_blank">
                                            {{ $p->nama_produk }}
                                        </a>
                                    </td>
                                    <td class="font-weight-bold text-success">{{ number_format($p->total_clicks ?? 0) }}
                                    </td>
                                    <td><span class="badge badge-info">{{ $p->platform->nama_platform }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Log Aktivitas Klik Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Produk</th>
                                <th>IP Address</th>
                                <th>Perangkat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestLogs as $log)
                                <tr>
                                    <td style="font-size: 12px;">{{ $log->created_at->format('H:i:s, d M') }}</td>
                                    <td style="font-size: 12px;">{{ $log->affiliateAd->nama_produk ?? 'N/A' }}</td>
                                    <td style="font-size: 12px;">{{ $log->ip_address }}</td>
                                    <td style="font-size: 12px;">{{ $log->user_agent }}</td>
                                    <td>
                                        @if ($log->is_bot)
                                            <span class="badge badge-danger">BOT</span>
                                        @else
                                            <span class="badge badge-success">MANUSIA</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myAreaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $stats->pluck('date')->toJson() !!},
                datasets: [{
                    label: "Jumlah Klik",
                    data: {!! $stats->pluck('total_clicks')->toJson() !!},
                    borderColor: '#4e73df',
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection
