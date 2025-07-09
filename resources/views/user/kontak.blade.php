@extends('layouts.user')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Hubungi Kami</h2>
            <p class="text-muted">Jangan ragu menghubungi kami via WhatsApp untuk pertanyaan, reservasi, atau informasi lebih lanjut.</p>
            
            <!-- CTA Utama WhatsApp
            <a href="https://wa.me/6282146903077" class="btn btn-success btn-lg px-4 py-3 mt-3" target="_blank">
                <i class="bi bi-whatsapp me-2"></i> Hubungi via WhatsApp Sekarang
            </a>
        </div> -->

        <div class="row g-4 justify-content-center">
            <!-- Alamat -->
            <div class="col-lg-5 col-md-6">
                <div class="bg-white p-4 rounded shadow-sm h-100 border-start border-4 border-primary">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-geo-alt fs-4 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Alamat</h5>
                    </div>
                    <p class="mb-2 text-secondary"><i class="bi bi-building me-2"></i>Jl. Raya Mojokerto No.123, Magersari, Mojokerto</p>
                    <p class="text-secondary"><i class="bi bi-clock me-2"></i>Buka setiap hari 08.00 - 20.00 WIB</p>
                    <div class="mt-4">
                        <a href="https://maps.google.com/?q=Jl. Raya Mojokerto No.123" target="_blank" class="btn btn-primary">
                            <i class="bi bi-map me-2"></i> Lihat di Peta
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-lg-5 col-md-6">
                <div class="bg-white p-4 rounded shadow-sm h-100 border-start border-4 border-primary">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-telephone fs-4 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Kontak Kami</h5>
                    </div>
                    
                    <!-- WhatsApp Utama -->
                    <div class="mb-4 p-3 bg-success bg-opacity-10 rounded">
                        <p class="mb-2 fw-semibold text-success"><i class="bi bi-whatsapp me-2"></i>WhatsApp Utama</p>
                        <a href="https://wa.me/6282146903077" class="btn btn-success w-100 py-2" target="_blank">
                            <i class="bi bi-whatsapp me-2"></i> 0821-4690-3077
                        </a>
                    </div>
                    
                    <!-- Alternatif Kontak
                    <div class="mb-3">
                        <p class="mb-1 text-secondary"><i class="bi bi-telephone me-2 text-primary"></i>Telepon:</p>
                        <a href="tel:082146903077" class="btn btn-outline-primary w-100 py-2">
                            <i class="bi bi-telephone-outbound me-2"></i> 0821-4690-3077
                        </a>
                    </div> -->
                    <div class="mb-3">
                        <p class="mb-1 text-secondary"><i class="bi bi-envelope me-2 text-info"></i>Email:</p>
                        <a href="mailto:info@abflasher.com" class="btn btn-outline-info w-100 py-2">
                            <i class="bi bi-envelope me-2"></i> info@abflasher.com
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner WhatsApp -->
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body p-4 text-center">
                        <h4 class="card-title text-success mb-3"><i class="bi bi-whatsapp me-2"></i>Lebih Cepat Respon via WhatsApp!</h4>
                        <p class="mb-4">Dapatkan respon lebih cepat dengan menghubungi kami langsung melalui WhatsApp. Klik tombol di bawah ini untuk memulai chat.</p>
                        <a href="https://wa.me/6282146903077" class="btn btn-success btn-lg px-5 py-3" target="_blank">
                            <i class="bi bi-whatsapp me-2"></i> Chat Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection