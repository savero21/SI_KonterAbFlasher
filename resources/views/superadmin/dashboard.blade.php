@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <span class="dashboard-icon">📊</span>
                </div>
                <div>
                    <h3 class="fw-bold mb-1">Dashboard Superadmin</h3>
                    <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->name }}! Anda memiliki akses penuh sebagai Superadmin.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- User Statistics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper bg-primary-light mb-3">
                        <i class="bi bi-people-fill text-primary fs-3"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-muted">Total Pengguna</h5>
                    <p class="card-text fs-3">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper bg-warning-light mb-3">
                        <i class="bi bi-hourglass-split text-warning fs-3"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-muted">Menunggu ACC</h5>
                    <p class="card-text fs-3">{{ \App\Models\User::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper bg-success-light mb-3">
                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-muted">Admin Aktif</h5>
                    <p class="card-text fs-3">{{ \App\Models\User::where('status', 'active')->where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Service Statistics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-primary bg-opacity-10 h-100 border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div>
                            <h5 class="card-title mb-2 text-muted">Total Servis</h5>
                            <p class="fs-3 mb-0">{{ $totalServis ?? 0 }}</p>
                        </div>
                        <div class="stat-icon text-primary">
                            <i class="bi bi-box-seam fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-warning bg-opacity-10 h-100 border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div>
                            <h5 class="card-title mb-2 text-muted">Masuk</h5>
                            <p class="fs-3 mb-0">{{ $servisMasuk ?? 0 }}</p>
                        </div>
                        <div class="stat-icon text-warning">
                            <i class="bi bi-arrow-down-circle fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-info bg-opacity-10 h-100 border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div>
                            <h5 class="card-title mb-2 text-muted">Diperbaiki</h5>
                            <p class="fs-3 mb-0">{{ $servisProses ?? 0 }}</p>
                        </div>
                        <div class="stat-icon text-info">
                            <i class="bi bi-tools fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-success bg-opacity-10 h-100 border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div>
                            <h5 class="card-title mb-2 text-muted">Selesai</h5>
                            <p class="fs-3 mb-0">{{ $servisSelesai ?? 0 }}</p>
                        </div>
                        <div class="stat-icon text-success">
                            <i class="bi bi-check-circle fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row g-3">
        <div class="col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-graph-up text-primary me-2 fs-5"></i>
                        <h5 class="mb-0 fw-semibold">Pendapatan Mingguan</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <canvas id="weeklyChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bar-chart text-primary me-2 fs-5"></i>
                        <h5 class="mb-0 fw-semibold">Pendapatan Bulanan</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <canvas id="monthlyChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-icon {
        font-size: 2rem;
        line-height: 1;
    }
    
    .icon-wrapper {
        display: inline-flex;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }
    
    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }
    
    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }
    
    .stat-card {
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .card-body {
            padding: 1.25rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const weeklyLabels = @json($weeklyLabels);
        const weeklyData = @json($weeklyData);
        const monthlyLabels = @json($monthlyLabels);
        const monthlyData = @json($monthlyData);

        // Weekly Income Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: weeklyData,
                    backgroundColor: 'rgba(67, 97, 238, 0.2)',
                    borderColor: '#4361ee',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#4361ee',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp' + value.toLocaleString('id-ID')
                        },
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Monthly Income Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: monthlyData,
                    backgroundColor: '#3a56d4',
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp' + value.toLocaleString('id-ID')
                        },
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush