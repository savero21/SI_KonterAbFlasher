@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 fw-bold">🛠️ Kelola Pengguna (Superadmin)</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Wewenang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->status === 'active')
                            <span class="badge bg-success text-white">Aktif</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if($user->status === 'pending')
                            <form action="{{ route('superadmin.users.approve', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">✔️ ACC</button>
                            </form>
                        @endif
                        <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
