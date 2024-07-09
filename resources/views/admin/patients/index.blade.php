@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')

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
        <h3 class="page-title"> Daftar Pasien </h3>
        <div>
            <a href="{{ route('patients.create') }}" class="btn btn-info"> Tambah Pasien </a>
            <a href="{{ route('patients.create-excel') }}" class="btn btn-success"> Tambah Pasien Excel </a>
        </div>
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
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">TTL</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr class="text-center">
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->nik }}</td>
                                        <td>{{ $patient->gender }}</td>
                                        <td>{{ $patient->place_of_birth }}, {{ $patient->date_of_birth }}</td>
                                        <td class="d-flex justify-content-center gap-1 align-items-center">
                                            <a class="btn btn-warning btn-sm showBtn"
                                                href="{{ route('patients.show', $patient->id) }}"
                                                data-id="{{ $patient->id }}">
                                                <i class="icon-eye menu-icon text-dark"></i>
                                            </a>
                                            <a class="btn btn-primary btn-sm editBtn"
                                                href="{{ route('patients.edit', $patient->id) }}">
                                                <i class="icon-pencil menu-icon text-dark"></i>
                                            </a>
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="post"
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
                    form.submit(); // submitting the form when patient press yes
                }
            })
        }
    </script>

@endsection
