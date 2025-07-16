<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- App CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        .min-vh-100 {
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .list-group-item {
            border: none;
            border-radius: 8px !important;
            margin-bottom: 5px;
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 12px 15px;
        }
        
        .list-group-item:hover {
            background-color: #f1f3f5;
            transform: translateX(3px);
        }
        
        .list-group-item.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
        }
        
        .main-content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
        }
        
        .sidebar-header {
            padding: 15px 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .admin-navbar {
            background-color: #ffffff;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        
        .welcome-message {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 10px 15px;
            margin-bottom: 0;
        }

        /* ✅ PERBAIKAN UTAMA: Centering Card Login/Register */
        .auth-container {
            display: flex;
            align-items: center;
            min-height: 100vh;
        }

        .auth-card {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                width: 280px;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .col-md-9, .col-12 {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .sidebar-header {
                padding: 10px 15px;
            }
            
            .admin-navbar {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Layout Wrapper -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar (khusus halaman admin & superadmin) -->
                @auth
                    @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                        <div class="col-md-3 col-lg-2 sidebar min-vh-100 px-0 position-relative">
                            <!-- Sidebar Header with Logo -->
                            <div class="sidebar-header">
                                <a class="navbar-brand fw-bold d-flex align-items-center px-3" 
                                   href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('superadmin.dashboard') }}">
                                    <img src="{{ asset('asset/images/logo.png') }}" alt="Logo Konter" width="40" height="40" class="me-2">
                                    AB Flasher
                                </a>
                            </div>

                            <div class="list-group mb-4 px-3">
                                {{-- Untuk ADMIN --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                    <a href="{{ route('services.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('services.*') ? 'active' : '' }}">
                                        <i class="bi bi-box-seam me-2"></i> Data Servis
                                    </a>
                                    <a href="{{ route('admin.transaksi') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.transaksi') ? 'active' : '' }}">
                                        <i class="bi bi-credit-card me-2"></i> Transaksi
                                    </a>
                                    <a href="{{ route('admin.laporan') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                                        <i class="bi bi-file-earmark-text me-2"></i> Laporan
                                    </a>
                                    <a href="{{ route('admin.komplain') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.komplain') ? 'active' : '' }}">
    <i class="bi bi-chat-dots me-2"></i> Komplain
</a>

                                @endif

                                {{-- Untuk SUPERADMIN --}}
                                @if(auth()->user()->role === 'superadmin')
                                    <a href="{{ route('superadmin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                    <a href="{{ route('superadmin.users.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}">
                                        <i class="bi bi-people-fill me-2"></i> Kelola Pengguna
                                    </a>
                                @endif

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="list-group-item list-group-item-action text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth

                <!-- Main Content -->
                <div class="@auth @if(in_array(auth()->user()->role, ['admin', 'superadmin'])) col-md-9 col-lg-10 @else col-12 @endif @else col-12 @endauth">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="admin-navbar d-flex justify-content-between align-items-center">
                                <h1 class="mb-0">📊 Halaman Admin</h1>
                                <div class="welcome-message">
                                    <h5 class="mb-1">Halo, {{ auth()->user()->name }} 👋</h5>
                                    <p class="mb-0 small">Selamat datang di panel admin <strong>Konter AB Flasher</strong></p>
                                </div>
                            </div>
                        @endif
                    @endauth
                    
                    <!-- ✅ PERBAIKAN UTAMA: Konten yang fleksibel untuk login/register -->
                    <div class="@auth @if(in_array(auth()->user()->role, ['admin', 'superadmin'])) py-4 px-4 @else auth-container @endif @else auth-container @endauth">
                        <div class="@auth @if(in_array(auth()->user()->role, ['admin', 'superadmin'])) w-100 @else auth-card @endif @else auth-card @endauth">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Optional: Add toggle functionality for mobile sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                const toggleBtn = document.createElement('button');
                toggleBtn.className = 'btn btn-primary d-md-none position-fixed';
                toggleBtn.style.bottom = '20px';
                toggleBtn.style.right = '20px';
                toggleBtn.style.zIndex = '1000';
                toggleBtn.innerHTML = '<i class="bi bi-list"></i>';
                toggleBtn.onclick = function() {
                    sidebar.classList.toggle('show');
                };
                document.body.appendChild(toggleBtn);
            }
        });
    </script>

    <!-- Script Tambahan -->
    @stack('scripts')
</body>
</html>x