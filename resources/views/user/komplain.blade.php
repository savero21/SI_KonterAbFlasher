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

 {{-- ✅ Modal untuk Komplain Berhasil --}}
   @if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4 border-0">
      <div class="modal-body text-center py-5">
        <i class="bi bi-check-circle-fill text-success display-3 mb-3"></i>
        <h4 class="fw-bold text-success mb-3">Komplain Berhasil Dikirim!</h4>
        <p class="text-muted">{{ session('success') }}</p>
        <button type="button" class="btn btn-success mt-3 px-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif


{{-- ✅ Modal untuk Komplain Gagal --}}
@if(session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4 border-0">
      <div class="modal-body text-center py-5">
        <i class="bi bi-x-circle-fill text-danger display-3 mb-3"></i>
        <h4 class="fw-bold text-danger mb-3">Terjadi Kesalahan</h4>
        <p class="text-muted">{{ session('error') }}</p>
        <button type="button" class="btn btn-danger mt-3 px-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif


<!-- {{-- ✅ Script untuk menampilkan modal --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            new bootstrap.Modal(document.getElementById('successModal')).show();
        @endif

        @if(session('error'))
            new bootstrap.Modal(document.getElementById('errorModal')).show();
        @endif
    });
</script>
@endpush -->


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

