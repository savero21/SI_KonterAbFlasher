@extends('layouts.user')

@section('title', 'Riwayat Komplain')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h3 class="mb-0"><i class="bi bi-chat-square-text text-primary me-2"></i>Riwayat Komplain Customer AB Flasher</h3>
                </div>
                
                <div class="card-body">
                    {{-- 🔍 Form pencarian --}}
                    <form method="GET" action="{{ route('user.complain.history') }}" class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" name="pickup_code" value="{{ request('pickup_code') }}" 
                                       class="form-control" placeholder="Cari berdasarkan kode pickup...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i> Cari
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('user.complain.history') }}" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        </div>
                    </form>

                    @if($riwayat->isEmpty())
                        <div class="alert alert-info text-center py-4">
                            <i class="bi bi-info-circle-fill me-2"></i> Belum ada data komplain yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th>Nama</th>
                                        <th>HP</th>
                                        <th>Kerusakan</th>
                                        <th>No. Pickup</th>
                                        <th>Komplain</th>
                                        <th>Balasan Admin</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $item)
                                        <tr>
                                            <td>{{ $item->customer }}</td>
                                            <td>{{ $item->phone_model }}</td>
                                            <td>{{ $item->damage }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10">
                                                    {{ $item->pickup_code }}
                                                </span>
                                            </td>
                                            <td class="small">{{ $item->complain }}</td>
                                            <td>
                                                @if($item->complain_reply)
                                                    <div class="alert alert-success py-1 px-2 mb-0 small">
                                                        <i class="bi bi-check-circle-fill me-1"></i>
                                                        {{ $item->complain_reply }}
                                                    </div>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                        Belum dibalas
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center small text-muted">
                                                {{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y, H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-4 text-center">
                        <a href="{{ route('user.complain') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Form Komplain
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .card-header {
        padding: 1.25rem 1.5rem;
    }
    
    .alert-success {
        --bs-alert-padding-y: 0.25rem;
        --bs-alert-padding-x: 0.5rem;
    }
</style>
@endsection