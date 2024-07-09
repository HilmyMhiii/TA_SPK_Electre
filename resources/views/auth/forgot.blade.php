@extends('layouts.custom')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo_polinema.png') }}" alt="logo" width="50">
        </div>
        <h4>Forgot Password</h4>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email"
                    class="form-control
                            @error('email')
                            is-invalid
                            @enderror"
                    value="{{ old('email') }}" name="email" tabindex="1" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Forgot Password
                </button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="auth-link text-black">Already have an account? Login</a>
    </div>
    </form>
    </div>
@endsection
