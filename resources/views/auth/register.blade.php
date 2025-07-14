@extends('layouts.app')

@section('content')
<div class="card auth-card">
    <div class="card-body p-5">
        <h3 class="text-center mb-4">{{ __('Register') }}</h3>

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-3 form-check">
                <!-- <input class="form-check-input" type="checkbox" name="terms" id="terms" required> -->
                <label class="form-check-label" for="terms">
                    <!-- Saya menyetujui <a href="#">Syarat dan Ketentuan</a> -->
                </label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary py-2">{{ __('Register') }}</button>
            </div>

            <div class="text-center">
                <span class="text-muted">Sudah punya akun?</span>
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection