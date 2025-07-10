<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo Konter" width="40" height="40" class="me-2">
            AB Flasher
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.layanan') }}">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cek.form') }}">Cek Status</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>

            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login Admin</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Admin</a>
            </div>
        </div>
    </div>
</nav>
