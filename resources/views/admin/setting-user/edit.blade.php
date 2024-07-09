@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Edit User </h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="form-id" action="{{ route('setting-users.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nama User<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan Nama User"
                                    value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Masukkan Username"
                                    value="{{ old('username', $user->username) }}" />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Masukkan Email"
                                    value="{{ old('email', $user->email) }}" />
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
                                    <option value="admin" @if (old('role', $user->role) == 'admin') selected @endif>
                                        Admin</option>
                                    {{-- <option value="survey_officer" @if (old('role', $user->role) == 'survey_officer') selected @endif>Petugas
                                                Survei</option> --}}
                                    <option value="user" @if (old('role', $user->role) == 'user') selected @endif>User
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //function confirm delete image with Swal alert when submit form
        function deleteImage(event) {
            event.preventDefault(); // will stop the form submission
            var form = event.target; // changed to event.target to get the form element

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submitting the form when user press yes
                }
            })
        }
    </script>
@endsection
