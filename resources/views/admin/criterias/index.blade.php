@extends('layouts.app')

@section('title', 'Data Kriteria')

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
        <h3 class="page-title"> Daftar Kriteria </h3>
        <a href="{{ route('criterias.create') }}" class="btn btn-info"> Tambah Kriteria </a>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Bobot</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criterias as $criteria)
                                    <tr class="text-center">
                                        <td>{{ $criteria->code }}</td>
                                        <td>{{ $criteria->name }}</td>
                                        <td>
                                            @if ($criteria->type == 'benefit')
                                                <span class="badge badge-success">Benefit</span>
                                            @else
                                                <span class="badge badge-danger">Cost</span>
                                            @endif
                                        </td>
                                        <td>{{ $criteria->weight }}</td>
                                        <td class="d-flex justify-content-center gap-1 align-items-center">
                                            <a class="btn btn-warning btn-sm showBtn"
                                                href="{{ route('criterias.show', $criteria->id) }}"
                                                data-id="{{ $criteria->id }}">
                                                <i class="icon-eye menu-icon text-dark"></i>
                                            </a>
                                            <a class="btn btn-primary btn-sm editBtn"
                                                href="{{ route('criterias.edit', $criteria->id) }}">
                                                <i class="icon-pencil menu-icon text-dark"></i>
                                            </a>
                                            <form action="{{ route('criterias.destroy', $criteria->id) }}" method="post"
                                                onsubmit="deleteData(event)">
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
                    form.submit(); // submitting the form when criteria press yes
                }
            })
        }
    </script>

@endsection
