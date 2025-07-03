@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Servis</h3>

    <!-- 🔙 Tombol Kembali ke Dashboard -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Dashboard
    </a>

    <!-- 🔍 Form Filter Status + Tombol Tambah -->
    <form method="GET" class="row align-items-end mb-4">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                @foreach(['masuk', 'diperbaiki', 'selesai'] as $stat)
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

    <!-- ℹ️ Info -->
    <div class="alert alert-info">
        Menampilkan hanya servis yang <strong>belum selesai</strong>
    </div>

    <!-- 📋 Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>Status</th>
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
                <td>{{ \Carbon\Carbon::parse($s->received_at)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('services.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('services.destroy', $s->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data servis ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
