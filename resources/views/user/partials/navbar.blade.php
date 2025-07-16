<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo Konter" width="40" height="40" >
            <span class="d-none d-sm-inline">AB Flasher</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list" style="font-size: 1.75rem;"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
                        <i class="bi bi-house-door d-lg-none me-2"></i>Beranda
                        <span class="active-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('user.layanan') ? 'active' : '' }}" href="{{ route('user.layanan') }}">
                        <i class="bi bi-tools d-lg-none me-2"></i>Layanan
                        <span class="active-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('cek.form') ? 'active' : '' }}" href="{{ route('cek.form') }}">
                        <i class="bi bi-search d-lg-none me-2"></i>Cek Status
                        <span class="active-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                        <i class="bi bi-telephone d-lg-none me-2"></i>Kontak
                        <span class="active-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('user.complain') ? 'active' : '' }}" href="{{ route('user.complain') }}">
                        <i class="bi bi-chat-left-text d-lg-none me-2"></i>Komplain
                        <span class="active-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded position-relative {{ request()->routeIs('user.complain.history') ? 'active' : '' }}" href="{{ route('user.complain.history') }}">
                        <i class="bi bi-clock-history d-lg-none me-2"></i>Riwayat
                        <span class="active-indicator"></span>
                    </a>
                </li>
            </ul>

            <div class="d-flex flex-column flex-lg-row gap-2 my-3 my-lg-0">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">
                    <i class="bi bi-box-arrow-in-right d-lg-none me-2"></i>Login Admin
                </a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm px-3 text-primary">
                    <i class="bi bi-person-plus d-lg-none me-2"></i>Daftar Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Styles */
    .navbar {
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    
    .navbar-brand {
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }
    
    .navbar-brand:hover {
        transform: scale(1.02);
    }
    
    .nav-link {
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
    }
    
    .nav-link.active {
        font-weight: 600;
    }
    
    .active-indicator {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background-color: white;
        border-radius: 3px 3px 0 0;
        transition: width 0.3s ease;
    }
    
    .nav-link.active .active-indicator {
        width: 60%;
    }
    
    /* Mobile menu styles */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            padding: 1rem;
            background-color: rgba(13, 110, 253, 0.98);
            border-radius: 0 0 10px 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .nav-item {
            margin-bottom: 0.5rem;
        }
        
        .nav-link {
            padding: 0.75rem 1rem !important;
        }
        
        .active-indicator {
            display: none;
        }
        
        .navbar-brand span {
            display: inline !important;
        }
    }
    
    /* Button hover effects */
    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>