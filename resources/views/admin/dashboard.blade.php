@extends('layouts.app')

@section('content')
<div class="dashboard-content">
    <!-- Stats Cards Row -->
    <div class="row stats-row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Servis</h5>
                            <h2 class="mb-0">{{ $totalServis ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Masuk</h5>
                            <h2 class="mb-0">{{ $servisMasuk ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-arrow-down-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Diperbaiki</h5>
                            <h2 class="mb-0">{{ $servisProses ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Selesai</h5>
                            <h2 class="mb-0">{{ $servisSelesai ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row charts-row">
        <div class="col-xl-6 mb-4">
            <div class="card chart-card h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Pendapatan Mingguan</h5>
                </div>
                <div class="card-body">
                    <canvas id="weeklyChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6 mb-4">
            <div class="card chart-card h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Pendapatan Bulanan</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-content {
        padding: 0;
        width: 100%;
        max-width: 100%;
    }
    
    .stats-row {
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card .card-title {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
    }
    
    .stat-card h2 {
        font-weight: 700;
        font-size: 1.75rem;
    }
    
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.2;
    }
    
    .chart-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .chart-card .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .chart-card .card-body {
        padding: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .stats-row > div {
            padding-right: 5px;
            padding-left: 5px;
        }
        
        .stat-card h2 {
            font-size: 1.5rem;
        }
        
        .stat-icon {
            font-size: 2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
function formatRupiah(value) {
    return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
}

// Weekly Chart
const weeklyCtx = document.getElementById('weeklyChart')?.getContext('2d');
if (weeklyCtx) {
    new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weeklyLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($weeklyData) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: 'rgba(13, 110, 253, 1)',
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return formatRupiah(context.parsed.y);
                        }
                    },
                    displayColors: false,
                    backgroundColor: '#212529',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString();
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            }
        }
    });
}

// Monthly Chart
const monthlyCtx = document.getElementById('monthlyChart')?.getContext('2d');
if (monthlyCtx) {
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return formatRupiah(context.parsed.y);
                        }
                    },
                    displayColors: false,
                    backgroundColor: '#212529',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString();
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            }
        }
    });
}
</script>
@endpush