@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📄 Laporan Pemasukan Servis</h3>

    <!-- 🔘 Navigasi dan Filter Export Excel -->
    <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-2">

        <!-- Tombol Kembali -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ⬅ Kembali ke Dashboard
        </a>

        <!-- Form Filter Export Excel -->
        <form action="{{ route('admin.laporan.excel') }}" method="GET" class="row g-2">
            <div class="col-auto">
                <label for="start_date" class="form-label mb-0">Dari</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-auto">
                <label for="end_date" class="form-label mb-0">Sampai</label>
                <input type="date" name="end_date" id="end_date" class="form-control"
                    value="{{ request('end_date') }}">
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-success">
                    ⬇️ Export Excel
                </button>
            </div>
        </form>
    </div>

    <!-- 💰 Rekap Total -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-body">
                    <h5>Total Minggu Ini</h5>
                    <h3 class="text-success">Rp{{ number_format($weeklyTotal, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-body">
                    <h5>Total Bulan Ini</h5>
                    <h3 class="text-primary">Rp{{ number_format($monthlyTotal, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- 🧾 Tabel Riwayat -->
    <h5>🧾 Riwayat Transaksi (Sudah Dihapus)</h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>HP</th>
                <th>Status</th>
                <th>Total</th>
                <th>Waktu Dihapus</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $item->customer }}</td>
                <td>{{ $item->phone_model }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>Rp{{ number_format($item->total_price, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->deleted_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data yang dihapus.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
