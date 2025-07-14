@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📄 Laporan Pemasukan Servis</h3>

    <!-- 🔘 Navigasi dan Filter Export Excel -->
    <div class="row align-items-end mb-4">
        <div class="col-md-6 col-12 mb-2 mb-md-0">
            <h5 class="mb-0">🧾 Riwayat Transaksi (Sudah Dihapus)</h5>
        </div>
        <div class="col-md-6 col-12">
            <form action="{{ route('admin.laporan.excel') }}" method="GET" class="row g-2 justify-content-md-end">
                <div class="col-auto">
                    <label for="start_date" class="form-label mb-0 small">Dari</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-auto">
                    <label for="end_date" class="form-label mb-0 small">Sampai</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-auto align-self-end">
                    <button type="submit" class="btn btn-success btn-sm">
                        ⬇️ Export Excel
                    </button>
                </div>
            </form>
        </div>
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

    <!-- 📋 Tabel Riwayat -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>Complain</th> <!-- Kolom baru -->
                <th>Status</th>
                <th>Nomor Pengambilan</th>
                <th>Total</th>
                <th>Waktu Dihapus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $item->customer }}</td>
                <td>{{ $item->phone_model }}</td>
                <td>{{ $item->damage }}</td>
                <td>{{ $item->complain ?? '-' }}</td> <!-- Kolom baru -->
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->pickup_code ?? '-' }}</td>
                <td>Rp{{ number_format($item->total_price, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->deleted_at)->format('d-m-Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus permanen data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑 Hapus Permanen</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data yang dihapus.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">
        {{ $data->withQueryString()->links() }}
    </div>

</div>
@endsection
