@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Detail User </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="name" class="form-label"><b>Nama</b></label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="code" class="form-label"><b>Username</b></label>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="type" class="form-label"><b>Email</b></label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="type" class="form-label"><b>Role</b></label>
                            <p>
                                @if ($user->role == 'admin')
                                    <span class="badge badge-primary">Admin</span>
                                @elseif($user->role == 'user')
                                    <span class="badge badge-success">User</span>
                                @elseif($user->role == 'survey_officer')
                                    <span class="badge badge-secondary">Petugas</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('setting-users.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
