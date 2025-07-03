@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Dashboard Admin</h1>

    <!-- Sambutan Ditaruh di Atas -->
    <div class="alert alert-info">
        <h5>Halo, {{ auth()->user()->name }} 👋</h5>
        <p>Selamat datang di panel admin <strong>Konter AB Flasher</strong>. Kelola data servis, transaksi, dan laporan melalui menu di samping.</p>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group mb-4">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">📊 Dashboard</a>
                <a href="{{ route('services.index') }}" class="list-group-item list-group-item-action">📦 Data Servis</a>
                <a href="{{ route('admin.transaksi') }}" class="list-group-item list-group-item-action">💳 Transaksi</a>
                <a href="{{ route('admin.laporan') }}" class="list-group-item list-group-item-action">📄 Laporan</a>
                <a href="#" class="list-group-item list-group-item-action">⚙️ Kelola Pengguna</a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="list-group-item list-group-item-action text-danger">
                    🔓 Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <h5>Total Servis</h5>
                            <h3>{{ $totalServis ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning text-center">
                        <div class="card-body">
                            <h5>Masuk</h5>
                            <h3>{{ $servisMasuk ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info text-center">
                        <div class="card-body">
                            <h5>Diperbaiki</h5>
                            <h3>{{ $servisProses ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success text-center">
                        <div class="card-body">
                            <h5>Selesai</h5>
                            <h3>{{ $servisSelesai ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pendapatan -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">📈 Pendapatan Mingguan</h5>
                            <canvas id="weeklyChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">📊 Pendapatan Bulanan</h5>
                            <canvas id="monthlyChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function formatRupiah(value) {
    return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
}

const weeklyCtx = document.getElementById('weeklyChart')?.getContext('2d');
if (weeklyCtx) {
    new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weeklyLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($weeklyData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'blue',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return formatRupiah(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

const monthlyCtx = document.getElementById('monthlyChart')?.getContext('2d');
if (monthlyCtx) {
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'teal',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return formatRupiah(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}
</script>
@endpush
