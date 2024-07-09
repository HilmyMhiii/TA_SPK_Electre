@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Daftar Kriteria </h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin">

            <div class="card my-4">
                <div class="card-header">
                    <h4>Tingkat Kepentingan Kriteria</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bobot</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sangat Rendah</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Rendah</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Cukup</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Tinggi</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Sangat Tinggi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Data Kriteria</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="form-id" action="{{ route('criterias.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="code" class="form-label">Kode Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" placeholder="Masukkan Kode" value="{{ old('code') }}" />
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nama Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan Nama Kriteria"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="type" class="form-label">Jenis Kriteria<span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type"
                                    name="type">
                                    <option value="">Pilih Jenis Kriteria</option>
                                    <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit
                                    </option>
                                    <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="weight" class="form-label">Bobot Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                    id="weight" name="weight" placeholder="Masukkan Bobot Kriteria"
                                    value="{{ old('weight') }}" />
                                @error('weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="code_subcriteria" class="form-label">Kode Subkriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code_subcriteria') is-invalid @enderror"
                                    id="code_subcriteria" name="code_subcriteria" placeholder="Masukkan Kode"
                                    value="{{ old('code_subcriteria') }}" />
                                @error('code_subcriteria')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name_subcriteria" class="form-label">Nama Sub Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name_subcriteria') is-invalid @enderror"
                                    id="name_subcriteria" name="name_subcriteria" placeholder="Masukkan Sub Kriteria"
                                    value="{{ old('name_subcriteria') }}" />
                                @error('name_subcriteria')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="value_subcriteria" class="form-label">Nilai Sub Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('value_subcriteria') is-invalid @enderror"
                                    id="value_subcriteria" name="value_subcriteria" placeholder="Masukkan Nilai Kriteria"
                                    value="{{ old('value_subcriteria') }}" />
                                @error('value_subcriteria')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('criterias.index') }}" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
