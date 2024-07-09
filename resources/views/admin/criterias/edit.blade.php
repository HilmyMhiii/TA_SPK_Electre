@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Edit Kriteria </h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <form method="post" id="form-id" action="{{ route('criterias.update', $criteria->id) }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="code" class="form-label">Kode Kriteria<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" placeholder="Masukkan Kode"
                                    value="{{ $criteria->code }}" />
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
                                    value="{{ $criteria->name }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="value" class="form-label">Jenis Kriteria<span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type"
                                    name="type">
                                    <option value="">Pilih Jenis Kriteria</option>
                                    <option value="benefit" @if ($criteria->type == 'benefit') selected @endif>Benefit
                                    </option>
                                    <option value="cost" @if ($criteria->type == 'cost') selected @endif>Cost</option>
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
                                    value="{{ $criteria->weight }}" />
                                @error('weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('criterias.index') }}" class="btn btn-warning">Kembali</a>
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
