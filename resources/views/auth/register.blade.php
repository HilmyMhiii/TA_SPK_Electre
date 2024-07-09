@extends('layouts.custom')

@section('title', 'Register')

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo_polinema.png') }}" alt="logo" width="50">
        </div>
        <h4 class="mb-3">Register</h4>
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text"
                    class="form-control
                @error('name')
                is-invalid
                @enderror"
                    name="name" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email"
                    class="form-control
                @error('email')
                is-invalid
                @enderror"
                    name="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password"
                        class="form-control
                    @error('password')
                    is-invalid
                    @enderror"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                </button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="auth-link text-black">Already have an account? Login</a>
    </div>
    </form>
    </div>
@endsection
