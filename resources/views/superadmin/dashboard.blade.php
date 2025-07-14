@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h3 class="fw-bold">📊 Dashboard Superadmin</h3>
            <p class="text-muted">Selamat datang, {{ auth()->user()->name }}! Anda memiliki akses penuh sebagai Superadmin.</p>
        </div>
    </div>

    {{-- Statistik pengguna --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill fs-2 text-primary"></i>
                    <h5 class="card-title mt-2">Total Pengguna</h5>
                    <p class="card-text display-6">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-hourglass-split fs-2 text-warning"></i>
                    <h5 class="card-title mt-2">Menunggu ACC</h5>
                    <p class="card-text display-6">{{ \App\Models\User::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                    <h5 class="card-title mt-2">Admin Aktif</h5>
                    <p class="card-text display-6">{{ \App\Models\User::where('status', 'active')->where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- {{-- Tambahan --}}
    <div class="row mt-5">
        <div class="col">
            <a href="{{ route('superadmin.users.index') }}" class="btn btn-primary">
                👥 Kelola Pengguna
            </a>
        </div>
    </div>
</div> -->
@endsection
