@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📩 Daftar Komplain Pelanggan</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>Pickup Code</th>
                <th>Isi Komplain</th>
                <th>Balas Komplain</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($komplain as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->customer }}</td>
                    <td>{{ $item->phone_model }}</td>
                    <td>{{ $item->damage }}</td>
                    <td>{{ $item->pickup_code }}</td>
                    <td>{{ $item->complain }}</td>
                    <td>
                        <form action="{{ route('admin.komplain.balas', $item->id) }}" method="POST">
                            @csrf
                            <textarea name="complain_reply" rows="2" class="form-control mb-2" placeholder="Tulis balasan">{{ $item->complain_reply }}</textarea>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="bi bi-send"></i> Kirim
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.komplain.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komplain ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada komplain yang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
