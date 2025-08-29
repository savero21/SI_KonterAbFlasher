@extends('layouts.app')

@section('content')
<div class="container">
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
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Model HP</th>
                    <th>Kerusakan</th>
                    <th>Total Harga</th>
                    <th>Nomor Pengambilan</th>
                    <th>Tanggal Masuk</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $s)
                <tr>
                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td>{{ $s->customer }}</td>
                    <td>{{ $s->phone_model }}</td>
                    <td>{{ $s->damage }}</td>
                    <td>Rp{{ number_format($s->total_price ?? 0, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-light text-dark px-3 py-2 shadow-sm">
                            {{ $s->pickup_code ?? '-' }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>
                    <td>
                        <div class="d-flex gap-2 flex-wrap">
                            <form action="{{ route('services.destroy', $s->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-success">✅ Sudah Terbayar</button>
                            </form>

                            {{-- Detail Transaksi --}}
                            <button type="button" class="btn btn-info btn-sm text-white" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailModal{{ $s->id }}">
                                <i class="bi bi-eye"></i> Detail Transaksi
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Detail Transaksi -->
                <div class="modal fade" id="detailModal{{ $s->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Detail Transaksi - {{ $s->customer }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <p><strong>Pelanggan:</strong> {{ $s->customer }}</p>
                                        <p><strong>HP:</strong> {{ $s->phone_model }}</p>
                                        <p><strong>Kerusakan:</strong> {{ $s->damage }}</p>
                                        <p><strong>Status:</strong> 
                                            <span class="badge bg-success">Selesai</span>
                                        </p>
                                        <p><strong>Nomor Pengambilan:</strong> {{ $s->pickup_code ?? '-' }}</p>
                                        <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</p>
                                        <p><strong>Catatan:</strong> {{ $s->notes ?? '-' }}</p>

                                        {{-- Sparepart / Item --}}
                                        <h6 class="mt-3">🔧 Sparepart / Item Diganti:</h6>
                                        @if($s->items && $s->items->count() > 0)
                                            <ul class="list-group">
                                                @foreach($s->items as $item)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $item->item_name }}
                                                        <span>Rp{{ number_format($item->item_price, 0, ',', '.') }}</span>
                                                    </li>
                                                @endforeach
                                                <li class="list-group-item d-flex justify-content-between fw-bold">
                                                    Total
                                                    <span>Rp{{ number_format($s->items->sum('item_price'), 0, ',', '.') }}</span>
                                                </li>
                                            </ul>
                                        @else
                                            <div class="alert alert-secondary">Tidak ada sparepart / item diganti.</div>
                                        @endif
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <p><strong>Foto Kerusakan:</strong></p>
                                        @if($s->photo_path)
                                            <img src="{{ asset('storage/' . $s->photo_path) }}" class="img-fluid rounded shadow-sm" style="max-height:250px; object-fit:cover;">
                                        @else
                                            <small class="text-muted">Tidak ada foto</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $data->links() }}
    </div>
</div>
@endsection
