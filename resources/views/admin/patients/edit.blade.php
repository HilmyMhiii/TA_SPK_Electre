@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Daftar Pasien </h3>
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
            <form method="post" id="form-id" action="{{ route('patients.update', $patient->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pasien</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nik" class="form-label">NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                    name="nik" placeholder="Masukkan NIK" value="{{ $patient->nik }}" />
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan Nama"
                                    value="{{ $patient->name }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin<span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type"
                                    name="gender">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" @if ($patient->gender == 'Laki-laki') selected @endif>Laki-laki
                                    </option>
                                    <option value="Perempuan" @if ($patient->gender == 'Perempuan') selected @endif>Perempuan
                                    </option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="place_of_birth" class="form-label">Tempat Lahir<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                                    id="place_of_birth" name="place_of_birth" placeholder="Masukkan Tempat Lahir"
                                    value="{{ $patient->place_of_birth }}" />
                                @error('place_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="date_of_birth" class="form-label">Tanggal Lahir<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth" value="{{ $patient->date_of_birth }}" />
                                @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                    placeholder="Masukkan Alamat">{{ $patient->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="photo" class="form-label">Foto<span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    id="photo" name="photo" />
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header">
                        <h4>Data Kriteria</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            @foreach ($criterias as $criteria)
                                <div class="col-md-6 mb-3">
                                    <label for="{{ $criteria->code }}" class="form-label">{{ $criteria->name }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error($criteria->code) is-invalid @enderror"
                                        id="{{ $criteria->code }}" name="{{ $criteria->code }}" required>
                                        <option value="">Pilih {{ $criteria->name }}</option>
                                        @foreach ($criteria->subCriterias as $subCriteria)
                                            @php
                                                $isSelected = false;
                                            @endphp

                                            @foreach ($criteriaPatient as $key => $criterion)
                                                @if ($key == $criteria->code && $subCriteria->code == $criterion)
                                                    @php
                                                        $isSelected = true;
                                                    @endphp
                                                    <option value="{{ $subCriteria->code }}" selected>
                                                        {{ $subCriteria->name }}
                                                    </option>
                                                @endif
                                            @endforeach

                                            @if (!$isSelected)
                                                <option value="{{ $subCriteria->code }}">
                                                    {{ $subCriteria->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error($criteria->code)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('patients.index') }}" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>

@endsection
