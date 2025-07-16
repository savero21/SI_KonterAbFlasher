@extends('layouts.app')

@section('content')
<div class="card auth-card">
    <div class="card-body p-5">
        <h3 class="text-center mb-4">{{ __('Login') }}</h3>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary py-2">{{ __('Login') }}</button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>
            @endif
             @if (Route::has('register'))
             <div class="text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    @endif
        </form>
        <div class="text-center mt-3">
    <a href="{{ route('beranda') }}" class="text-decoration-none text-muted">
        <i class="bi bi-house-door-fill me-1"></i> Kembali ke Halaman Beranda
    </a>
</div>

    </div>
</div>
@endsection