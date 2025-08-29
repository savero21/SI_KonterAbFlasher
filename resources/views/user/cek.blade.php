@extends('layouts.user')

@section('title', 'Cek Status Servis')

@section('content')
<section id="cek" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-4">
                    <i class="bi bi-search me-2"></i>
                    Cek Status Perbaikan
                </h2>
                <p class="lead mb-5">Masukkan nomor pengambilan untuk mengetahui status perangkat Anda</p>

                <form method="POST" action="{{ route('cek.proses') }}" class="row g-3 justify-content-center">
                    @csrf
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" name="pickup_code" class="form-control form-control-lg"
                                   placeholder="Contoh: PK-20250702-ABCD" required value="{{ old('pickup_code') }}">
                            <button class="btn btn-primary btn-lg px-4" type="submit">Cek</button>
                        </div>
                    </div>
                </form>

                {{-- Error --}}
                @if(session('error'))
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Gagal!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    </div>
                @endif

                @isset($service)
                    @if($service)
                        {{-- Detail Status --}}
                        <div class="card mt-5 shadow-sm border-0 text-start">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-tools me-2"></i>
                                    Detail Status Servis
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr><th width="30%">Nama Pelanggan</th><td>{{ $service->customer }}</td></tr>
                                            <tr><th>Model HP</th><td>{{ $service->phone_model }}</td></tr>
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
                                            <tr><th>Tanggal Masuk</th><td>{{ $service->received_at }}</td></tr>
                                            <tr><th>Nomor Pengambilan</th><td><strong>{{ $service->pickup_code }}</strong></td></tr>

                                            {{-- Sparepart / Item --}}
                                            @if($service->status === 'selesai' && $service->items && $service->items->count() > 0)
                                                <tr>
                                                    <th>Sparepart Diganti</th>
                                                    <td>
                                                        <ul class="list-group">
                                                            @foreach($service->items as $item)
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    {{ $item->item_name }}
                                                                    <span>Rp{{ number_format($item->item_price, 0, ',', '.') }}</span>
                                                                </li>
                                                            @endforeach
                                                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                                                Total
                                                                <span>Rp{{ number_format($service->items->sum('item_price'), 0, ',', '.') }}</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if($service->status !== 'selesai')
                                                <tr>
                                                    <th>Catatan Teknisi</th>
                                                    <td>{{ $service->notes ?: '—' }}</td>
                                                </tr>
                                            @endif

                                            @if($service->status === 'selesai')
                                                <tr>
                                                    <th>Total Biaya</th>
                                                    <td class="fw-bold text-success">Rp{{ number_format($service->total_price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Foto Bukti --}}
                                @if($service->photo_path && $service->status === 'diperbaiki')
                                    <div class="mt-4">
                                        <h5><i class="bi bi-image me-2"></i>Foto Bukti Servis</h5>
                                        <img src="{{ asset('storage/' . $service->photo_path) }}" alt="Bukti Servis"
                                             class="img-fluid rounded shadow border mb-3" style="max-width:300px;">
                                    </div>
                                @endif

                                {{-- Timeline --}}
                                @if($service->timeline && $service->status !== 'selesai')
                                    <div class="mt-4">
                                        <h5><i class="bi bi-clock-history me-2"></i>Timeline Perbaikan</h5>
                                        <div class="alert alert-secondary">{{ $service->timeline }}</div>
                                    </div>
                                @endif

                                {{-- Notifikasi --}}
                                @if($service->status === 'selesai')
                                    <div class="alert alert-success mt-3">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <strong>Perangkat sudah siap diambil!</strong> Silakan datang ke lokasi kami dengan membawa nomor pengambilan.
                                    </div>
                                @elseif($service->status === 'diperbaiki')
                                    <div class="alert alert-warning mt-3">
                                        <i class="bi bi-gear-fill me-2"></i>
                                        Perangkat dalam proses perbaikan.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mt-5">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Nomor pengambilan tidak ditemukan.
                        </div>
                    @endif
                @endisset
            </div>
        </div>
    </div>
</section>
@endsection
