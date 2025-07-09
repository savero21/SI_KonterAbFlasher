@extends('layouts.app')
@extends('layouts.user')
@section('content')


<section id="layanan" class="py-5" style="background-color: #f8f9fa; padding-top: 90px;">

    <div class="container">
        <!-- Header Section dengan Animasi -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold display-5 mb-3 text-primary">Solusi Lengkap untuk Perangkat Anda</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Kami menyediakan berbagai layanan perbaikan dengan teknisi bersertifikat dan menggunakan sparepart berkualitas.
            </p>
        </div>

        <!-- Grid Layanan -->
        <div class="row g-4">
            @php
                $services = [
                    [
                        'icon' => 'bi-phone', 
                        'title' => 'Ganti LCD', 
                        'desc' => 'Penggantian layar LCD & touchscreen dengan kualitas terbaik',
                        'features' => ['Garansi 3 bulan', 'Original/High Copy', 'Pengerjaan 1-2 jam'],
                        'color' => 'primary'
                    ],
                    [
                        'icon' => 'bi-unlock', 
                        'title' => 'Unlock Pola/Akun', 
                        'desc' => 'Membuka kunci pola, PIN, fingerprint dan akun Google',
                        'features' => ['Tanpa kehilangan data', 'Support semua merk', 'Garansi 100%'],
                        'color' => 'primary'
                    ],
                    [
                        'icon' => 'bi-lightning', 
                        'title' => 'Flash Ulang', 
                        'desc' => 'Install ulang sistem operasi untuk semua merk smartphone',
                        'features' => ['Software original', 'Include driver', 'Optimasi performa'],
                        'color' => 'primary'
                    ],
                    [
                        'icon' => 'bi-battery-half', 
                        'title' => 'Ganti Baterai', 
                        'desc' => 'Penggantian baterai & perbaikan port charging',
                        'features' => ['Kapasitas asli', 'Daya tahan lama', 'Pengecekan gratis'],
                        'color' => 'primary'
                    ],
                    [
                        'icon' => 'bi-droplet-half', 
                        'title' => 'Perbaikan Air', 
                        'desc' => 'Servis komprehensif untuk perangkat terkena air',
                        'features' => ['Pembersihan korosi', 'Diagnosa menyeluruh', 'Garansi 1 bulan'],
                        'color' => 'primary'
                    ],
                    [
                        'icon' => 'bi-shield-lock', 
                        'title' => 'Proteksi Data', 
                        'desc' => 'Servis dengan prioritas keamanan data pelanggan',
                        'features' => ['Backup data', 'Enkripsi aman', 'Privacy guaranteed'],
                        'color' => 'primary'
                    ],
                ];
            @endphp

            @foreach($services as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 border-0 shadow-sm service-card overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi {{ $item['icon'] }} fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-0">{{ $item['title'] }}</h5>
                        </div>
                        <p class="text-muted mb-4">{{ $item['desc'] }}</p>
                        
                        <ul class="list-unstyled mb-4">
                            @foreach($item['features'] as $feature)
                            <li class="mb-2 d-flex">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="https://wa.me/6282146903077?text=Saya%20tertarik%20dengan%20layanan%20{{ urlencode($item['title']) }}%20di%20ABFlasher" 
                               class="btn btn-sm btn-primary" 
                               target="_blank">
                               Konsultasi
                            </a>
                            <span class="badge bg-primary bg-opacity-10 text-primary small">
                                <i class="bi bi-clock me-1"></i> 1-3 Jam
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="bg-primary bg-opacity-5 rounded-4 p-5 mt-5" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <h4 class="fw-bold mb-2">Butuh Layanan Lain?</h4>
                    <p class="mb-0 text-muted">Kami siap membantu permasalahan perangkat Anda dengan solusi terbaik.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="https://wa.me/6282146903077" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-whatsapp me-2"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.partials.footer')
@endsection

@push('styles')
<style>
    /* Tambahkan padding untuk menghindari tertutup navbar */
    /* Animasi */
    [data-aos] {
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    [data-aos="fade-up"] {
        transform: translateY(20px);
        opacity: 0;
    }
    [data-aos].aos-animate {
        transform: translateY(0);
        opacity: 1;
    }
    
    /* Card Layanan */
    .service-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        border-left: 4px solid var(--bs-primary);
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.5rem;
        }
        .display-5 {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .col-md-6 {
            padding-left: 8px;
            padding-right: 8px;
        }
        .card-body {
            padding: 1.25rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Simple AOS implementation for demo
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('[data-aos]');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                }
            });
        }, { threshold: 0.1 });
        
        elements.forEach(el => observer.observe(el));
    });
</script>
@endpush