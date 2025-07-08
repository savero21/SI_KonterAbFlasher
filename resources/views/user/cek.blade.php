@include('user.partials.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AB Flasher - Pusat Servis HP Mojokerto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/random/1600x900/?mobile,repair') no-repeat center;
            background-size: cover;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        .service-card {
            transition: transform 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>


    
    <!-- Form Cek Status -->
    <section id="cek" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4"><i class="bi bi-search me-2"></i>Cek Status Perbaikan</h2>
                    <p class="lead mb-5">Masukkan nomor pengambilan untuk mengetahui status perangkat Anda</p>
                    
                    <form method="POST" action="{{ route('cek.proses') }}" class="row g-3 justify-content-center">
                        @csrf
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" name="pickup_code" class="form-control form-control-lg" 
                                       placeholder="Contoh: ABF123456" required value="{{ old('pickup_code') }}">
                                <button class="btn btn-primary btn-lg px-4" type="submit">Cek</button>
                            </div>
                        </div>
                    </form>

                    @if(session('error'))
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Gagal!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif

                    @isset($service)
                        @if($service)
                            <!-- Status Card -->
                            <div class="card mt-5 shadow-sm border-0">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-tools me-2"></i>Detail Status Servis</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th width="30%">Nama Pelanggan</th>
                                                    <td>{{ $service->customer }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Model HP</th>
                                                    <td>{{ $service->phone_model }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        @if($service->status === 'selesai')
                                                            <span class="badge bg-success">Selesai</span>
                                                        @elseif($service->status === 'diperbaiki')
                                                            <span class="badge bg-warning text-dark">Dalam Perbaikan</span>
                                                        @else
                                                            <span class="badge bg-info">Diproses</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Masuk</th>
                                                    <td>{{ $service->received_at }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor Pengambilan</th>
                                                    <td><strong>{{ $service->pickup_code }}</strong></td>
                                                </tr>
                                                @if($service->status === 'selesai')
                                                <tr>
                                                    <th>Total Biaya</th>
                                                    <td class="fw-bold">Rp{{ number_format($service->total_price, 0, ',', '.') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($service->status === 'selesai')
                                        <div class="alert alert-success mt-3">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            <strong>Perangkat sudah siap diambil!</strong> Silakan datang ke lokasi kami dengan membawa nomor pengambilan.
                                        </div>
                                    @elseif($service->status === 'diperbaiki')
                                        <div class="alert alert-warning mt-3">
                                            <i class="bi bi-gear-fill me-2"></i>
                                            <strong>Perangkat sedang dalam proses perbaikan.</strong> Kami akan menginformasikan ketika selesai.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning mt-5">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Nomor pengambilan tidak ditemukan. Pastikan Anda memasukkan kode dengan benar.
                            </div>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </section>

    
          <div class="row mt-5 g-4">
    

@include('user.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>