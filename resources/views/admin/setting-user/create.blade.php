@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Daftar User </h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="form-id" action="{{ route('setting-users.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nama User<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan Nama User"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Masukkan Username" />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Masukkan Email" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role"
                                    name="role">
                                    <option value="">Pilih Role</option>
                                    <option value="admin" @if (old('role') == 'admin') selected @endif>
                                        Admin</option>
                                    {{-- <option value="survey_officer" @if (old('role') == 'survey_officer') selected @endif>Petugas
                                                Survei</option> --}}
                                    <option value="user" @if (old('role') == 'user') selected @endif>User
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('setting-users.index') }}" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
