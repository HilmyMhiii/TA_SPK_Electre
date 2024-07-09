@extends('layouts.app')

@section('title', 'Detail Subkriteria')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Detail Subkriteria </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data Subkriteria</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="name" class="form-label"><b>Nama</b></label>
                            <p>{{ $subcriteria->name }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="code" class="form-label"><b>Kode Sub Kriteria</b></label>
                            <p>{{ $subcriteria->code }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="criteria" class="form-label"><b>Kriteria</b></label>
                            <p>{{ $subcriteria->criteria->name }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="value" class="form-label"><b>Nilai</b></label>
                            <p>{{ $subcriteria->value }}</p>
                        </div>
                        <div>
                            <a href="{{ route('subcriterias.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
