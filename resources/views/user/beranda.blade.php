@extends('layouts.user')

@section('content')
<!-- HERO SECTION -->
<section class="hero-section position-relative text-white d-flex align-items-center">
    <div class="hero-overlay"></div>
    <div class="container py-5 my-5 position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Selamat Datang di AB Flasher</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeIn animate__delay-1s">Pusat servis HP profesional dengan layanan terbaik di Mojokerto</p>
                <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                  <a href="{{ route('cek.form') }}" class="btn btn-outline-light btn-lg px-4">🔍 Cek Status Perbaikan</a>

                    <!-- <a href="https://wa.me/6282146903077" class="btn btn-success btn-lg px-4 py-3" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i> Konsultasi Sekarang -->
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: Tentang -->
<section class="py-5 bg-light" id="tentang">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative">
                    <img src="{{ asset('asset/images/coba1.avif') }}" class="img-fluid rounded-4 shadow-lg" alt="Tentang Kami">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 rounded-end-4 shadow">
                        <h4 class="mb-0"><i class="bi bi-award-fill me-2"></i> Berpengalaman sejak 2019</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3 fs-6">Tentang Kami</span>
                    <h2 class="fw-bold mb-4 display-5">Mengapa Memilih AB Flasher?</h2>
                    <p class="lead mb-4">AB Flasher telah menjadi mitra terpercaya bagi ribuan pelanggan dengan komitmen pada kualitas, kecepatan, dan kejujuran dalam setiap servis perangkat.</p>
                    
                    <div class="feature-list">
                        <div class="d-flex mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4">
                                <i class="bi bi-check-circle-fill fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Teknisi Profesional</h5>
                                <p class="mb-0 text-muted">Tim teknisi bersertifikat dengan pengalaman luas di bidangnya</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4">
                                <i class="bi bi-shield-check fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Sparepart Berkualitas</h5>
                                <p class="mb-0 text-muted">Menggunakan komponen original atau high quality dengan garansi</p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4">
                                <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Proses Cepat</h5>
                                <p class="mb-0 text-muted">Waktu pengerjaan efisien tanpa mengorbankan kualitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: Statistik -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100">
                    <h2 class="display-4 fw-bold text-primary mb-3">5+</h2>
                    <h5 class="fw-bold mb-0">Tahun Pengalaman</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100">
                    <h2 class="display-4 fw-bold text-primary mb-3">1000+</h2>
                    <h5 class="fw-bold mb-0">Pelanggan Puas</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100">
                    <h2 class="display-4 fw-bold text-primary mb-3">24</h2>
                    <h5 class="fw-bold mb-0">Jam Support</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: CTA -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Siap Memperbaiki Perangkat Anda?</h2>
                <p class="lead mb-5">Hubungi kami sekarang dan dapatkan solusi terbaik untuk masalah perangkat Anda.</p>
               
                <a href="{{ route('kontak') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                     <i class="bi bi-whatsapp me-2"></i> Menu Kontak
                </a>

            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        min-height: 90vh;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://source.unsplash.com/random/1600x800/?repair,phone,technician') no-repeat center;
        background-size: cover;
        background-attachment: fixed;
    }
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);
    }
    
    /* Animasi */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .hero-section {
            min-height: 70vh;
            background-attachment: scroll;
        }
        .display-4 {
            font-size: 2.5rem;
        }
        .feature-list .d-flex {
            flex-direction: column;
            text-align: center;
        }
        .feature-list .me-4 {
            margin-right: 0 !important;
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .display-4 {
            font-size: 2rem;
        }
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Animate on scroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
@endpush