@extends('layouts.custom')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="{{ asset('assets/img/logo_polinema.png') }}" alt="logo" width="100"
                    class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Please Check Your Email For Verification</h4>
                </div>

                <div class="card-body">
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @else
                        <div class="mb-4 font-medium text-sm text-green-600">
                            Thanks for signing up! Before getting started, could you verify your email address by clicking
                            on the link we just emailed to you? If you didn't receive the email, we will gladly send you
                            another.
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}" class="needs-validation" novalidate="">
                        @csrf

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                Copyright &copy; 2023
                <div class="bullet"></div>
                Developed By <a href="">Akuntansi Polinema</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('assets/images/logo_polinema.png') }}" alt="logo" width="50">
        </div>
        <h4>Verify Email</h4>
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @else
            <div class="mb-4 font-medium text-sm text-green-600">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}" class="needs-validation" novalidate="">
            @csrf

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Resend Verification Email
                </button>
            </div>
        </form>
    </div>
    </form>
    </div>
@endsection
