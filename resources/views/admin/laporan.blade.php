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
                <th>No</th>
                <th>Nama</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>Status</th>
                <th>Nomor Pengambilan</th>
                <th>Total</th>
                <th>Waktu Dibayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->customer }}</td>
                <td>{{ $item->phone_model }}</td>
                <td>{{ $item->damage }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->pickup_code ?? '-' }}</td>
                <td>Rp{{ number_format($item->total_price, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->deleted_at)->format('d-m-Y H:i') }}</td>
                <td class="d-flex gap-1 flex-wrap">
                    <!-- Detail Sparepart -->
                    <button type="button" class="btn btn-info btn-sm text-white" 
                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                        🔍 Detail
                    </button>

                    <!-- Hapus Permanen -->
                    <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus permanen data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑 Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Detail Transaksi -->
            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Detail Transaksi - {{ $item->customer }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Pelanggan:</strong> {{ $item->customer }}</p>
                            <p><strong>Model HP:</strong> {{ $item->phone_model }}</p>
                            <p><strong>Kerusakan:</strong> {{ $item->damage }}</p>
                            <p><strong>Nomor Pengambilan:</strong> {{ $item->pickup_code ?? '-' }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
                            <hr>
                            <h6 class="fw-bold">Sparepart Diganti:</h6>
                            @if($item->items && $item->items->count() > 0)
                                <ul class="list-group mb-3">
                                    @foreach($item->items as $i)
                                        <li class="list-group-item d-flex justify-content-between">
                                            {{ $i->item_name }}
                                            <span>Rp{{ number_format($i->item_price, 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item d-flex justify-content-between fw-bold">
                                        Total
                                        <span>Rp{{ number_format($item->items->sum('item_price'), 0, ',', '.') }}</span>
                                    </li>
                                </ul>
                            @else
                                <p class="text-muted">Tidak ada sparepart dicatat.</p>
                            @endif
                            <p><strong>Total Biaya:</strong> Rp{{ number_format($item->total_price, 0, ',', '.') }}</p>
                            <p><strong>Waktu Dibayar:</strong> {{ \Carbon\Carbon::parse($item->deleted_at)->format('d-m-Y H:i') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data yang dihapus.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $data->withQueryString()->links() }}
    </div>
</div>
@endsection
