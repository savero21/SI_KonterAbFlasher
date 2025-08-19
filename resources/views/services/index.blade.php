@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="fw-bold mb-0">📦 Data Servis</h3>
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Servis
        </a>
    </div>

    {{-- Filter + Sorting --}}
    <form method="GET" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                @foreach(['masuk', 'diperbaiki','selesai'] as $stat)
                    <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>
                        {{ ucfirst($stat) }}
                    </option>
                @endforeach
            </select>
        </div>

           <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('services.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-clockwise me-1"></i> Reset
            </a>
        </div>
        

        <div class="col-md-3">
            <label class="form-label">Urutan berdasarkan</label>
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Tanggal Masuk Terbaru</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Tanggal Masuk Terlama</option>
            </select>
        </div>

     
    </form>

    {{-- Info --}}
    <div class="alert alert-info mb-4">
        <i class="bi bi-info-circle me-2"></i>
        Menampilkan hanya servis yang <strong>belum selesai</strong>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>Status</th>
                <th>Nomor Pengambilan</th>
                <th>Bukti Foto Perbaikan</th>
                <th>Timeline</th>
                <th>Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $s)
            <tr>
                <td>{{ $s->customer }}</td>
                <td>{{ $s->phone_model }}</td>
                <td>{{ $s->damage }}</td>
                <td>
                    <span class="badge bg-{{ $s->status == 'selesai' ? 'success' : ($s->status == 'diperbaiki' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($s->status) }}
                    </span>
                </td>
                <td>{{ $s->pickup_code ?? '-' }}</td>

                    {{-- Foto --}}
                    <td>
                        @if($s->status === 'diperbaiki' && $s->photo_path)
                            <img src="{{ asset('storage/' . $s->photo_path) }}" width="60" class="img-thumbnail rounded">
                        @else
                            <small class="text-muted">-</small>
                        @endif
                    </td>

                    {{-- Timeline --}}
                    <td>
                        @if($s->status === 'diperbaiki' && $s->timeline)
                            {{ $s->timeline }}
                        @else
                            <small class="text-muted">-</small>
                        @endif
                    </td>

                    <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>
                    
                    {{-- Aksi --}}
                    <td>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('services.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('services.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data servis ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('services.show', $s->id) }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">Tidak ada data servis ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $services->withQueryString()->links() }}
    </div>
</div>
@endsection
