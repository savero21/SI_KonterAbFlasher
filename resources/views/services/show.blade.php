@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Servis</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Pelanggan:</strong> {{ $service->customer }}</p>
            <p><strong>HP:</strong> {{ $service->phone_model }}</p>
            <p><strong>Kerusakan:</strong> {{ $service->damage }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $service->status == 'selesai' ? 'success' : ($service->status == 'diperbaiki' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($service->status) }}
                </span>
            </p>
            <p><strong>Nomor Pengambilan:</strong> {{ $service->pickup_code ?? '-' }}</p>
            <p><strong>Timeline:</strong> {{ $service->timeline ?? '-' }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($service->received_at)->format('d-m-Y') }}</p>
            
            @if($service->photo_path)
                <p><strong>Foto Bukti:</strong></p>
                <img src="{{ asset('storage/' . $service->photo_path) }}" width="200" class="img-thumbnail">
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('services.index') }}" class="btn btn-secondary">⬅ Kembali</a>
    </div>
</div>
@endsection
