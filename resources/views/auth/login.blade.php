@extends('layouts.custom')

@section('title', 'Login')

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo_polinema.png') }}" alt="logo" width="50">
        </div>
        <h4>Sistem Pendukung Keputusan Deteksi Dini Penyakit Stroke</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1"
                    required placeholder="Masukkan Email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" tabindex="2" required placeholder="Masukkan Password">
                <span class="position-absolute px-1">
                    <button class="eye btn border-0" type="button" onclick="showPW()">
                        <i class="fas fa-eye fs-6"></i>
                    </button>
                    <button class="eye-slash btn border-0 d-none" type="button" onclick="hidePW()">
                        <i class="fas fa-eye-slash fs-6"></i>
                    </button>
                </span>
                @error('password')
                    <div class="invalid-feedback d-inline-flex">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-3">
                <button class="btn d-grid btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN
                    IN</button>
            </div>
        </form>
        <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
    </div>
    </form>
    </div>
@endsection
