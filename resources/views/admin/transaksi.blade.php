@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 🔙 Tombol Kembali -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Dashboard
    </a>

    <h3>Daftar Transaksi Servis (Selesai)</h3>

    <!-- 🔍 Form Filter -->
    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}" placeholder="Tanggal Masuk">
        </div>
        <div class="col-md-4">
            <input type="text" name="pickup_code" class="form-control" value="{{ request('pickup_code') }}" placeholder="Nomor Pengambilan">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.transaksi') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    <!-- 📋 Tabel Transaksi -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Model HP</th>
                <th>Kerusakan</th>
                <th>Total Harga</th>
                <th>Nomor Pengambilan</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th> {{-- Kolom tambahan --}}
            </tr>
        </thead>
        <tbody>
            @forelse($data as $s)
            <tr>
                <td>{{ $s->customer }}</td>
                <td>{{ $s->phone_model }}</td>
                <td>{{ $s->damage }}</td>
                <td>Rp{{ number_format($s->total_price ?? 0, 0, ',', '.') }}</td>
                <td><strong>{{ $s->pickup_code ?? '-' }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>
                <td>
                    {{-- Tombol Hapus --}}
                    <form action="{{ route('services.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">🗑 Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
