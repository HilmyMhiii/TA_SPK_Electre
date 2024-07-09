@extends('layouts.app')

@section('title', 'Tambah Subkriteria')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Tambah Subkriteria </h3>
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data Subkriteria</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="form-id" action="{{ route('subcriterias.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="code" class="form-label">Kode Subkriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" placeholder="Masukkan Kode" />
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nama Subkriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan Nama Subkriteria"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="criteria_id" class="form-label">Kriteria<span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('criteria_id') is-invalid @enderror" id="criteria_id"
                                    name="criteria_id">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($criterias as $criteria)
                                        <option value="{{ $criteria->id }}"
                                            @if (old('criteria_id') == $criteria->id) selected @endif>
                                            {{ $criteria->name }}</option>
                                    @endforeach
                                </select>
                                @error('criteria_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="value" class="form-label">Nilai Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('value') is-invalid @enderror"
                                    id="value" name="value" placeholder="Masukkan Nilai Kriteria"
                                    value="{{ old('value') }}" />
                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('subcriterias.index') }}" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
