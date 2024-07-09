<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Penerima Bantuan - BLT-DD Boto</title>

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<?php
$year = date('Y');
?>

<body>
    <table border="0" width="100%" style="margin-bottom: 5px">
        {{-- <tr>
            <td width="10%">
                <img src="{{ public_path("assets/img/logo_tuban.webp") }}" alt="Logo" width="100">
            </td>
            <td width="80%">
                <h2 style="text-align: center;">PEMERINTAH DESA BOTO</h2>
                <h3 style="text-align: center;">KECAMATAN KESAMBEN, KABUPATEN TUBAN, JAWA TIMUR</h3>
                <h4 style="text-align: center;">DATA PENERIMA BANTUAN</h4>
            </td>
            <td width="10%">
                <img src="{{ public_path("assets/img/logo_tuban.webp") }}" alt="Logo" width="100">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr style="border: 2px double black;">
            </td>
        </tr> --}}
        <tr>
            <td style="text-align: center">
                <h3>DAFTAR NAMA KEPALA KELUARGA CALON PENERIMA BLT-DD DESA BOTO TAHUN <?= $year ?></h2>
            </td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tgl. Lahir</th>
                <th>Alamat</th>
                <th>Hasil</th>
                <th>Ranking</th>
                {{-- <th>Status</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($rankings as $key => $value)
                <?php
                $aidRecipientCriteria = $aidRecipientsCriteria->where('id', $key)->first();
                ?>
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $aidRecipientCriteria->aidRecipient->name }}</td>
                    <td>{{ $aidRecipientCriteria->aidRecipient->nik }}</td>
                    <td>{{ $aidRecipientCriteria->aidRecipient->gender }}</td>
                    <td>{{ $aidRecipientCriteria->aidRecipient->place_of_birth }},
                        {{ $aidRecipientCriteria->aidRecipient->date_of_birth }}</td>
                    <td>{{ $aidRecipientCriteria->aidRecipient->address }}</td>
                    <td>{{ $value['hasil'] }}</td>
                    <td style="text-align: center">{{ $value['ranking'] }}</td>
                    {{-- <td>
                        @if ($value['status'] == 'accepted')
                            Layak
                        @else
                            Tidak Layak
                        @endif
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
</body>

</html>
