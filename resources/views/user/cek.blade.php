
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>AB Flasher - Cek Status Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light justify-content-between px-4">
        <span class="navbar-brand mb-0 h1">🔧 AB Flasher</span>
        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login Admin</a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Daftar Admin</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-dark text-white text-center py-5" style="background: url('https://your-image-url') no-repeat center; background-size: cover;">
        <div class="container">
            <h1 class="display-4">Pusat Servis HP Mojokerto</h1>
            <p class="lead">Kami melayani servis HP, tablet, dan wearable terpercaya di Mojokerto dan sekitarnya.</p>
        </div>
    </section>

    <!-- Form Cek Status -->
    <section class="container py-5">
        <h2 class="text-center mb-4">🔍 Cek Status Perbaikan Anda</h2>

        <form method="POST" action="{{ route('cek.proses') }}" class="row justify-content-center">
            @csrf
            <div class="col-md-6">
                <input type="text" name="pickup_code" class="form-control form-control-lg mb-3"
                       placeholder="Masukkan Nomor Pengambilan Anda" required value="{{ old('pickup_code') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-lg btn-primary w-100">Cek</button>
            </div>
        </form>
    {{-- ✅ Tampilkan pesan error dari session jika ada --}}
 @if(session('error'))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>❌ Oops!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif


 @isset($service)
    @if($service)
        {{-- ✅ Data ditemukan, tampilkan status --}}
        <div class="card mt-4 mx-auto" style="max-width: 700px;">
            <div class="card-header bg-light">
                🔧 <strong>Detail Status Servis</strong>
            </div>
            <div class="card-body p-4">
                <table class="table table-bordered mb-4">
                    <tr>
                        <th>Nama:</th>
                        <td>{{ $service->customer }}</td>
                    </tr>
                    <tr>
                        <th>Model HP:</th>
                        <td>{{ $service->phone_model }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>{{ ucfirst($service->status) }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk:</th>
                        <td>{{ $service->received_at }}</td>
                    </tr>
                    <tr>
                        <th>Catatan:</th>
                        <td>{{ $service->notes ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Pengambilan:</th>
                        <td>{{ $service->pickup_code ?? '-' }}</td>
                    </tr>
                    @if($service->status === 'selesai')
                    <tr>
                        <th>Total Harga:</th>
                        <td>Rp{{ number_format($service->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </table>

                {{-- ✅ Pesan status --}}
                @if($service->status === 'selesai')
                    <div class="alert alert-success text-center">
                        ✅ Servis Anda <strong>sudah selesai</strong> dan <strong>bisa diambil</strong><br>
                        Gunakan nomor pengambilan <strong>{{ $service->pickup_code }}</strong>.
                    </div>
                @elseif($service->status === 'diperbaiki')
                    <div class="alert alert-warning text-center">
                        ⚙️ Device Anda <strong>masih dalam proses perbaikan</strong>.<br>
                        Silakan cek kembali nanti atau hubungi admin.
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        ℹ️ Status servis Anda masih diproses.
                    </div>
                @endif
            </div>
        </div>
    @else
        {{-- ❌ Nomor pengambilan tidak ditemukan --}}
        <div class="alert alert-danger mt-4 text-center">
            ❌ Nomor pengambilan tidak ditemukan.<br>
            Pastikan Anda memasukkan kode yang benar sesuai yang diberikan admin.
        </div>
    @endif
@endisset




    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light mt-5">
        <small>&copy; {{ date('Y') }} AB Flasher. All rights reserved.</small>
    </footer>
</body>
</html>
