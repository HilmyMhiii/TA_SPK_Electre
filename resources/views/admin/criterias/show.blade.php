@extends('layouts.app')

@section('title', 'Detail Kriteria')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Detail Kriteria </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4>Data Kriteria</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="name" class="form-label"><b>Nama</b></label>
                            <p>{{ $criteria->name }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="code" class="form-label"><b>Kode</b></label>
                            <p>{{ $criteria->code }}</p>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="type" class="form-label"><b>Jenis</b></label>
                            <p>{{ $criteria->type }}</p>
                        </div>
                        <div>
                            <a href="{{ route('criterias.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
