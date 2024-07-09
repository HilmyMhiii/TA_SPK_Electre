@extends('layouts.app')

@section('title', 'Data Sub Kriteria')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Daftar Sub Kriteria </h3>
        <a href="{{ route('subcriterias.create') }}" class="btn btn-info"> Tambah Sub Kriteria </a>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kode Sub Kriteria</th>
                                    <th class="text-center">Kriteria</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCriterias as $subCriteria)
                                    <tr class="text-center">
                                        <td>{{ $subCriteria->name }}</td>
                                        <td>{{ $subCriteria->code }}</td>
                                        <td>{{ $subCriteria->criteria->name }}</td>
                                        <td>{{ $subCriteria->value }}</td>
                                        <td class="d-flex justify-content-center gap-1 align-items-center">
                                            <a class="btn btn-warning btn-sm showBtn"
                                                href="{{ route('subcriterias.show', $subCriteria->id) }}"
                                                data-id="{{ $subCriteria->id }}">
                                                <i class="icon-eye menu-icon text-dark"></i>
                                            </a>
                                            <a class="btn btn-primary btn-sm editBtn"
                                                href="{{ route('subcriterias.edit', $subCriteria->id) }}">
                                                <i class="icon-pencil menu-icon text-dark"></i>
                                            </a>
                                            <form action="{{ route('subcriterias.destroy', $subCriteria->id) }}"
                                                method="post" onsubmit="deleteData(event)">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="icon-trash menu-icon"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //function confirm delete image with Swal alert when submit form
        function deleteData(event) {
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
                    form.submit(); // submitting the form when subCriteria press yes
                }
            })
        }
    </script>

@endsection
