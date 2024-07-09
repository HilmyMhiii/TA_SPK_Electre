@extends('layouts.custom')

@section('title', 'Reset Password')

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo_polinema.png') }}" alt="logo" width="50">
        </div>
        <h4 class="mb-3">Register</h4>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="text" name="token" id="token" value="{{ $request->token }}" hidden>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email"
                    class="form-control
                @error('email')
                is-invalid
                @enderror"
                    value="{{ $request->email }}" name="email" tabindex="1" required readonly>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password"
                    class="form-control
                @error('password')
                is-invalid
                @enderror"
                    name="password" tabindex="2" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password"
                    class="form-control
                @error('password_confirmation')
                is-invalid
                @enderror"
                    name="password_confirmation" tabindex="2" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
    </form>
    </div>
@endsection
