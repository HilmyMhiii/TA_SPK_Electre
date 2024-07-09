@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Detail Pasien </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pasien</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3 d-flex justify-content-start flex-column">
                            <label for="photo" class="form-label"><b>Gambar</b></label>
                            <img src="{{ $patient->photo ? asset('storage/' . $patient->photo) : asset('assets/images/user-1.png') }}"
                                alt="photo" width="200px" class="img-thumbnail">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="nik" class="form-label"><b>NIK</b></label>
                            <p>{{ $patient->nik }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="name" class="form-label"><b>Nama</b></label>
                            <p>{{ $patient->name }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="gender" class="form-label"><b>Jenis Kelamin</b></label>
                            <p>{{ $patient->gender }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="ttl" class="form-label"><b>Tempat, Tanggal Lahir</b></label>
                            <p>{{ $patient->place_of_birth }}, {{ $patient->date_of_birth }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="address" class="form-label"><b>Alamat</b></label>
                            <p>{{ $patient->address }}</p>
                        </div>
                        <hr />
                        @foreach ($criterias as $criteria)
                            @foreach ($criteria->subCriterias as $subCriteria)
                                @foreach ($criteriaPatient as $key => $criterion)
                                    @if ($key === $criteria->code && $criterion === $subCriteria->code)
                                        <div class="col-md-6 mb-1">
                                            <label for="{{ $criteria->code }}"
                                                class="form-label"><b>{{ $criteria->name }}</b></label>
                                            <p id="{{ $criteria->code }}">{{ $subCriteria->name }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        <div>
                            <a href="{{ route('patients.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
