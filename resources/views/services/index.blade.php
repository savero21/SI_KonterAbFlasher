@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Servis</h3>

    <!-- <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Dashboard
    </a> -->

    <form method="GET" class="row align-items-end mb-4">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                @foreach(['masuk', 'diperbaiki'] as $stat)
                    <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>
                        {{ ucfirst($stat) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('services.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>

        <div class="col-md-5 text-end">
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                + Tambah Servis
            </a>
        </div>
    </form>

    <div class="alert alert-info">
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

                {{-- Foto jika diperbaiki --}}
                <td>
                    @if($s->status === 'diperbaiki' && $s->photo_path)
                        <img src="{{ asset('storage/' . $s->photo_path) }}" width="60" class="img-thumbnail">
                    @else
                        <small class="text-muted">-</small>
                    @endif
                </td>

                {{-- Timeline jika diperbaiki --}}
                <td>
                    @if($s->status === 'diperbaiki' && $s->timeline)
                        {{ $s->timeline }}
                    @else
                        <small class="text-muted">-</small>
                    @endif
                </td>

                <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('services.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('services.destroy', $s->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data servis ini secara permanen?')">
    🗑️ Hapus Permanen
</button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data servis ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
    {{ $services->withQueryString()->links() }}
</div>

</div>
@endsection
