@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Edit Profile </h3>
    </div>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Edit profile card-->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="inputName">Nama</label>
                                <input class="form-control" id="inputName" type="text" name="name"
                                    value="{{ auth()->user()->name }}" placeholder="Enter your nama" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                    value="{{ auth()->user()->email }}" placeholder="Enter your email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control" id="username" type="text" name="username"
                                    value="{{ auth()->user()->username }} " placeholder="Enter your username" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="password">Password</label>
                                <div class="d-flex align-items-center justify-content-end">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        type="password" name="password" />
                                    <span class="position-absolute px-1">
                                        <button class="eye btn border-0" type="button" onclick="showPW()">
                                            <i class="fas fa-eye fs-6"></i>
                                        </button>
                                        <button class="eye-slash btn border-0 d-none" type="button" onclick="hidePW()">
                                            <i class="fas fa-eye-slash fs-6"></i>
                                        </button>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-inline-flex">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
