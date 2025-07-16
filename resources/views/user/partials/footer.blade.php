<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <!-- Deskripsi -->
            <div class="col-lg-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('asset/images/logo.png') }}" alt="Logo AB Flasher" width="40" height="40" >
                    <h5 class="fw-bold mb-0">AB Flasher</h5>
                </div>
                <p class="text-white-50">Pusat servis HP profesional di Mojokerto dengan layanan lengkap dan teknisi berpengalaman.</p>
                <div class="social-icons mt-3">
                    <!-- <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-whatsapp fs-5"></i></a> -->
                </div>
            </div>

            <!-- Tautan Cepat (Updated to match navbar) -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2 border-secondary">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('beranda') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Beranda
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('user.layanan') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Layanan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cek.form') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Cek Status
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('kontak') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Kontak
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('user.complain') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Komplain
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.complain.history') }}" class="text-white-50 d-flex align-items-center hover-white">
                            <i class="bi bi-arrow-right-short me-2 text-primary"></i>Riwayat Komplain
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2 border-secondary">Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-telephone me-3 fs-5 text-primary"></i>
                        <div>
                            <h6 class="mb-0">Telepon</h6>
                            <a href="tel:03211234567" class="text-white-50 hover-white">(0321) 1234567</a>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-whatsapp me-3 fs-5 text-primary"></i>
                        <div>
                            <h6 class="mb-0">WhatsApp</h6>
                            <a href="https://wa.me/6282146903077" class="text-white-50 hover-white">0821 4690 3077</a>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope me-3 fs-5 text-primary"></i>
                        <div>
                            <h6 class="mb-0">Email</h6>
                            <a href="mailto:info@abflasher.com" class="text-white-50 hover-white">info@abflasher.com</a>
                        </div>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-geo-alt me-3 fs-5 mt-1 text-primary"></i>
                        <div>
                            <h6 class="mb-0">Alamat</h6>
                            <p class="text-white-50 mb-0">Jl. Raya Mojokerto No. 123</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-secondary">
        <div class="text-center pt-2">
            <p class="mb-0 text-white-50">&copy; {{ now()->year }} AB Flasher. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    /* Footer Styles */
    .hover-white:hover {
        color: white !important;
        transform: translateX(5px);
    }
    
    .social-icons a {
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        transform: translateY(-3px);
        color: var(--bs-primary) !important;
    }
    
    .text-white-50 {
        color: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }
    
    @media (max-width: 767.98px) {
        .footer-col {
            margin-bottom: 2rem;
        }
        
        .footer-col:last-child {
            margin-bottom: 0;
        }
    }
</style>