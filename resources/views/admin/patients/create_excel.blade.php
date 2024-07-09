@extends('layouts.app')

@section('title', 'Tambah Pasien Excel')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3>Tambah Pasien Excel</h3>
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

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        <a href="{{ asset('assets/docs/template_pasien.xlsx') }}" target="_blank"><i
                                class="fas fa-download"></i> Download Template Pasien</a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pasien</h4>

                        </div>
                        <div class="card-body">
                            <form method="post" id="form-id" action="{{ route('patients.store-excel') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="file" class="form-label">File<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                            id="file" name="file" />
                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <a href="{{ route('patients.index') }}" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
