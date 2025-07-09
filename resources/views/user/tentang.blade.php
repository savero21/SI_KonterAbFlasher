@extends('layouts.user')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('asset/images/coba1.avif') }}" alt="AB Flasher" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Tentang AB Flasher</h2>
                <p class="mb-3">AB Flasher adalah pusat servis HP profesional yang berlokasi di Mojokerto. Kami telah beroperasi sejak 2019 dan melayani berbagai jenis perangkat seperti HP, tablet, dan wearable.</p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle text-success me-2"></i> Teknisi berpengalaman dan tersertifikasi</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i> Sparepart original dan bergaransi</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i> Harga bersaing dan proses cepat</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
