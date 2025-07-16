@extends('layouts.user')

@section('title', 'Form Komplain')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h3 class="mb-4 text-center">📝 Kirim Komplain Servis Anda</h3>
            <p class="text-center text-muted mb-4">
                Kami sangat menghargai masukan Anda. Silakan isi form di bawah jika ada kendala setelah proses servis.
            </p>

            {{-- ✅ Alert sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            {{-- ✅ Alert error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            {{-- ✅ Form Komplain --}}
            <form action="{{ route('user.complain.submit') }}" method="POST" class="card shadow-sm p-4 mb-5 bg-white border-0">
                @csrf

                <div class="mb-3">
                    <label for="pickup_code" class="form-label">🔢 Nomor Pengambilan</label>
                    <input type="text"
                           class="form-control @error('pickup_code') is-invalid @enderror"
                           name="pickup_code"
                           id="pickup_code"
                           value="{{ old('pickup_code') }}"
                           required
                           placeholder="Contoh: PK-20250702-XXXX">
                    @error('pickup_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="complain" class="form-label">💬 Isi Komplain</label>
                    <textarea class="form-control @error('complain') is-invalid @enderror"
                              name="complain"
                              id="complain"
                              rows="4"
                              placeholder="Jelaskan permasalahan yang Anda alami setelah servis..."
                              required>{{ old('complain') }}</textarea>
                    @error('complain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-send-fill me-1"></i> Kirim Komplain
                    </button>
                </div>
            </form>

            {{-- ✅ Riwayat Komplain --}}
            @isset($service)
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">📋 Status Komplain Anda</h5>

                    <ul class="list-unstyled">
                        <li><strong>Nomor Pengambilan:</strong> {{ $service->pickup_code }}</li>
                        <li><strong>Nama:</strong> {{ $service->customer }}</li>
                        <li><strong>Model HP:</strong> {{ $service->phone_model }}</li>
                        <li><strong>Kerusakan:</strong> {{ $service->damage }}</li>
                    </ul>

                    <div class="alert alert-warning mt-3">
                        <strong>Keluhan Anda:</strong><br>
                        {{ $service->complain }}
                    </div>

                    @if($service->complain_reply)
                        <div class="alert alert-success">
                            <strong>Balasan Admin:</strong><br>
                            {{ $service->complain_reply }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            Komplain Anda sedang diproses. Mohon tunggu balasan dari admin kami.
                        </div>
                    @endif

                    <p class="text-muted mt-4 text-center">🙏 Terima kasih telah menggunakan layanan AB Flasher.</p>
                </div>
            @endisset

        </div>
    </div>
</div>
@endsection
