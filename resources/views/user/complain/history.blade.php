@extends('layouts.user')

@section('title', 'Riwayat Komplain')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="mb-4 text-center">📜 Riwayat Komplain Anda</h3>

            @if($riwayat->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>Belum ada data komplain yang pernah dikirim.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle shadow-sm">
                        <thead class="table-light text-center">
                            <tr>
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
                                    <td>
                                        <span class="badge bg-primary">{{ $item->pickup_code }}</span>
                                    </td>
                                    <td>{{ $item->complain }}</td>
                                    <td>
                                        @if($item->complain_reply)
                                            <span class="text-success fw-semibold">
                                                {{ $item->complain_reply }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Belum dibalas</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ route('user.complain') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Form Komplain
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
