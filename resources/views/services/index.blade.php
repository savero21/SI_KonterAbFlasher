@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="fw-bold mb-0">📦 Data Servis</h3>
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Servis
        </a>
    </div>

    {{-- Info --}}
    <div class="alert alert-info mb-4">
        <i class="bi bi-info-circle me-2"></i>
        Menampilkan hanya servis yang <strong>belum selesai</strong>
    </div>

    <form method="GET">
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Pelanggan</th>
                        <th>HP</th>
                        <th>Kerusakan</th>

                        {{-- Dropdown Status --}}
                        <th>
                            Status
                            <div class="dropdown d-inline">
                                <a href="#" class="text-dark ms-1" data-bs-toggle="dropdown">
                                    <i class="bi bi-caret-down-fill"></i>
                                </a>
                                <ul class="dropdown-menu p-2">
                                    <li>
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="">Semua</option>
                                            @foreach(['masuk','diperbaiki'] as $stat)
                                                <option value="{{ $stat }}" {{ request('status')==$stat ? 'selected' : '' }}>
                                                    {{ ucfirst($stat) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </th>

                        <th class="text-center">No. Pengambilan</th>
                        <th class="text-center">Bukti Foto</th>
                        <th>Timeline</th>

                        {{-- Dropdown Tanggal Masuk --}}
                        <th>
                            Tanggal Masuk
                            <div class="dropdown d-inline">
                                <a href="#" class="text-dark ms-1" data-bs-toggle="dropdown">
                                    <i class="bi bi-caret-down-fill"></i>
                                </a>
                                <ul class="dropdown-menu p-2">
                                    <li>
                                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="desc" {{ request('sort')=='desc' ? 'selected':'' }}>Terbaru</option>
                                            <option value="asc" {{ request('sort')=='asc' ? 'selected':'' }}>Terlama</option>
                                        </select>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a href="{{ route('services.index') }}" class="dropdown-item text-danger">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </th>

                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $s)
                    <tr>
                        <td>{{ $s->customer }}</td>
                        <td>{{ $s->phone_model }}</td>
                        <td>{{ $s->damage }}</td>

                        {{-- Status --}}
                        <td>
                            <span class="badge bg-{{ $s->status=='selesai'?'success':($s->status=='diperbaiki'?'warning':'secondary') }}">
                                {{ ucfirst($s->status) }}
                            </span>
                        </td>

                        {{-- Pickup --}}
                        <td class="text-center">
                            @if($s->pickup_code)
                                <span class="badge bg-light text-dark px-3 py-2 shadow-sm">
                                    {{ $s->pickup_code }}
                                </span>
                            @else
                                <small class="text-muted">-</small>
                            @endif
                        </td>

                        {{-- Foto --}}
                        <td class="text-center">
                            @if($s->status === 'diperbaiki' && $s->photo_path)
                                <img src="{{ asset('storage/' . $s->photo_path) }}" 
                                     class="img-thumbnail rounded shadow-sm" 
                                     style="width:60px; height:60px; object-fit:cover;">
                            @else
                                <small class="text-muted">-</small>
                            @endif
                        </td>

                        {{-- Timeline --}}
                        <td>{{ $s->timeline ?? '-' }}</td>

                        {{-- Tanggal --}}
                        <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('services.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('services.destroy', $s->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <!-- <a href="{{ route('services.show', $s->id) }}" class="btn btn-info btn-sm text-white">
                                    <i class="bi bi-eye"></i> Detail
                                </a> -->
                                {{-- Tombol Detail --}}
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $s->id }}">
    <i class="bi bi-eye"></i> Detail
</button>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="detailModal{{ $s->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $s->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $s->id }}">
                                        📄 Detail Servis - {{ $s->customer }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><strong>Pelanggan:</strong> {{ $s->customer }}</p>
                                            <p><strong>HP:</strong> {{ $s->phone_model }}</p>
                                            <p><strong>Kerusakan:</strong> {{ $s->damage }}</p>
                                            <p><strong>Status:</strong> 
                                                <span class="badge bg-{{ $s->status=='selesai'?'success':($s->status=='diperbaiki'?'warning':'secondary') }}">
                                                    {{ ucfirst($s->status) }}
                                                </span>
                                            </p>
                                            <p><strong>Timeline:</strong> {{ $s->timeline ?? '-' }}</p>
                                            <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>No. Pengambilan:</strong> {{ $s->pickup_code ?? '-' }}</p>
                                            <p><strong>Total Harga:</strong> Rp{{ number_format($s->total_price ?? 0, 0, ',', '.') }}</p>
                                            <p><strong>Bukti Foto Perbaikan:</strong></p>
                                            @if($s->photo_path)
                                                <img src="{{ asset('storage/' . $s->photo_path) }}" class="img-fluid rounded shadow-sm" alt="Bukti Foto">
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
    </form>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $services->withQueryString()->links() }}
    </div>
</div>
@endsection
