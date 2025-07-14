<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Deskripsi -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">AB Flasher</h5>
                <p>Pusat servis HP profesional di Mojokerto dengan layanan lengkap dan teknisi berpengalaman.</p>
            </div>

            <!-- Tautan Cepat (Disesuaikan dengan Navbar) -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('beranda') }}" class="text-white-50">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('user.layanan') }}" class="text-white-50">Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('cek.form') }}" class="text-white-50">Cek Status</a></li>
                    <li class="mb-2"><a href="{{ route('kontak') }}" class="text-white-50">Kontak</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i> (0321) 1234567</li>
                    <li class="mb-2"><i class="bi bi-whatsapp me-2"></i> 0821 4690 3077</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@abflasher.com</li>
                    <li><i class="bi bi-geo-alt me-2"></i> Jl. Raya Mojokerto No. 123</li>
                </ul>
            </div>
        </div>

        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; {{ now()->year }} AB Flasher. All rights reserved.</p>
        </div>
    </div>
</footer>
