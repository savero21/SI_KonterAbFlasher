@extends('layouts.user')

@section('content')
<!-- HERO SECTION -->
<section class="hero-section position-relative text-white d-flex align-items-center">
    <div class="hero-overlay"></div>
    <div class="container py-5 my-5 position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Selamat Datang di AB Flasher</h1>
                <p class="lead mb-5 fs-3 animate__animated animate__fadeIn animate__delay-1s">Pusat servis HP profesional dengan layanan terbaik di Mojokerto</p>
                <div class="d-flex flex-wrap justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                    <a href="{{ route('cek.form') }}" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bi bi-search me-2"></i> Cek Status Perbaikan
                    </a>
                    <!-- <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="bi bi-headset me-2"></i> Hubungi Kami
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: Tentang Kami -->
<section class="py-5 bg-light" id="tentang">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <!-- Image Column -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                    <img src="{{ asset('asset/images/coba1.avif') }}" class="img-fluid" alt="Tentang Kami" style="max-height: 400px; width: 100%; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 rounded-end-4 shadow">
                        <h4 class="mb-0"><i class="bi bi-award-fill me-2"></i> Berpengalaman sejak 2019</h4>
                    </div>
                </div>
            </div>
            
            <!-- Text Content Column -->
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3 fs-6 px-3 py-2">Tentang Kami</span>
                    <h2 class="fw-bold mb-4">Mengapa Memilih AB Flasher?</h2>
                    <p class="lead mb-4 text-muted">Kami memberikan solusi terbaik untuk perangkat Anda dengan teknisi bersertifikat dan komponen berkualitas.</p>
                    
                    <!-- Feature List -->
                    <div class="feature-list">
                        <!-- Feature 1 -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4 flex-shrink-0">
                                <i class="bi bi-check-circle-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Teknisi Profesional</h5>
                                <p class="mb-0 text-muted align-text">Tim teknisi bersertifikat dengan pengalaman luas di bidangnya</p>
                            </div>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4 flex-shrink-0">
                                <i class="bi bi-shield-check fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Sparepart Berkualitas</h5>
                                <p class="mb-0 text-muted align-text">Menggunakan komponen original atau high quality dengan garansi</p>
                            </div>
                        </div>
                        
                        <!-- Feature 3 -->
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-4 flex-shrink-0">
                                <i class="bi bi-speedometer2 fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Proses Cepat</h5>
                                <p class="mb-0 text-muted align-text">Waktu pengerjaan efisien tanpa mengorbankan kualitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: Gallery -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3">Galeri Kami</h2>
                <p class="lead text-muted">Lihat aktivitas dan hasil pekerjaan kami</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <img src="{{ asset('asset/images/repair1.jpg') }}" class="img-fluid rounded-3 shadow-sm gallery-img" alt="Proses Perbaikan">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('asset/images/repair2.jpg') }}" class="img-fluid rounded-3 shadow-sm gallery-img" alt="Teknisi Bekerja">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('asset/images/repair3.jpg') }}" class="img-fluid rounded-3 shadow-sm gallery-img" alt="Perangkat Diperbaiki">
            </div>
        </div>
    </div>
</section>

<!-- SECTION: Tanggapan Cepat -->
<section class="py-5 bg-light" id="tanggapan">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-3 fs-6 px-3 py-2">Layanan Purna Servis</span>
                <h2 class="fw-bold mb-3">Tanggapan Cepat Setelah Perbaikan</h2>
                <p class="lead text-muted">Kami memberikan garansi dan dukungan purna servis untuk kepuasan pelanggan</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 d-inline-block mb-4">
                            <i class="bi bi-chat-square-text-fill fs-2 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Komplain Online</h5>
                        <p class="text-muted">Laporkan masalah setelah perbaikan melalui sistem komplain kami</p>
                        <a href="{{ route('user.complain') }}" class="btn btn-sm btn-outline-primary">Kirim Komplain</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 d-inline-block mb-4">
                            <i class="bi bi-headset fs-2 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Dukungan 24 Jam</h5>
                        <p class="text-muted">Tim support siap membantu kapan saja melalui WhatsApp</p>
                         <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-primary">Hubungi Kami</a>
                        <!-- <a href="{{ route('kontak') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold"> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 d-inline-block mb-4">
                            <i class="bi bi-person-lines-fill fs-2 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Riwayat Complain</h5>
                        <p class="text-muted">Customer dapat melihat riwayat komplain dan tanggapan dari AB Flasher</p>
                        <a href="{{ route('user.complain.history') }}" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
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
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100 d-flex flex-column justify-content-center">
                    <h2 class="display-3 fw-bold text-primary mb-3">5+</h2>
                    <h5 class="fw-bold mb-0">Tahun Pengalaman</h5>
                    <p class="text-muted mt-2">Melayani sejak 2019</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100 d-flex flex-column justify-content-center">
                    <h2 class="display-3 fw-bold text-primary mb-3">1000+</h2>
                    <h5 class="fw-bold mb-0">Pelanggan Puas</h5>
                    <p class="text-muted mt-2">Dari seluruh Mojokerto</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm border border-2 border-primary border-opacity-10 h-100 d-flex flex-column justify-content-center">
                    <h2 class="display-3 fw-bold text-primary mb-3">24</h2>
                    <h5 class="fw-bold mb-0">Jam Support</h5>
                    <p class="text-muted mt-2">Siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: CTA -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 w-100 h-100 bg-pattern opacity-10"></div>
    <div class="container py-5 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Siap Memperbaiki Perangkat Anda?</h2>
                <p class="lead mb-5 opacity-90">Hubungi kami sekarang dan dapatkan solusi terbaik untuk masalah perangkat Anda.</p>
               
                <!-- <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('kontak') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                        <i class="bi bi-whatsapp me-2"></i> Kontak Kami
                    </a> -->
                    <a href="{{ route('user.layanan') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">
                        <i class="bi bi-list-check me-2"></i> Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        min-height: 80vh;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://source.unsplash.com/random/800x600/?repair,phone,technician') no-repeat center;
        background-size: cover;
        background-attachment: fixed;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.5) 0%, rgba(0, 0, 0, 0.8) 100%);
    }

    /* Gallery Section */
    .gallery-img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-img:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Service Cards */
    .service-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .service-card .btn {
        transition: all 0.2s ease;
    }

    /* CTA Pattern */
    .bg-pattern {
        background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* Text Alignment */
    .align-text {
        line-height: 1.6;
        padding-left: 0.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .hero-section {
            min-height: 70vh;
        }
        
        .display-3 {
            font-size: 2.5rem;
        }
        
        .lead.fs-3 {
            font-size: 1.25rem !important;
        }
    }
    
    @media (max-width: 767.98px) {
        .hero-section {
            min-height: 60vh;
            background-attachment: scroll;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                              url('https://source.unsplash.com/random/600x400/?repair,phone,technician');
        }
        
        .ps-lg-4 {
            padding-left: 0 !important;
        }
        
        #tentang img {
            max-height: 300px !important;
        }
        
        .feature-list .d-flex {
            flex-direction: row;
            text-align: left;
        }

        .gallery-img {
            margin-bottom: 1rem;
        }
        .service-card {
            margin-bottom: 1.5rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .display-3 {
            font-size: 2rem;
        }
        
        .display-5 {
            font-size: 1.75rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            width: 100%;
        }
        
        .gap-3 > * {
            margin-bottom: 0.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Animate on scroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
@endpush