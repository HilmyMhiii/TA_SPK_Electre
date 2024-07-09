<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Travel Authorization</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }
        .titleSecPri{
            background-color: #0C2D57;
            color: #ffffff;
            padding: 10px 5px;
            text-align: center;
        }
        .titleSecSec{
            background-color: #0C2D57;
            color: #ffffff;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="titleSecPri">
        <p>TRAVEL AUTHORIZATION</p>
    </div>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>ID TA</th>
                <th>Request By</th>
                <th>Approve By</th>
                <th>Departement</th>
                <th>Purpose/Event</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($travel_authorizations as $travel_authorization)
                <tr>
                    <td>{{ $travel_authorization->id_ta }}</td>
                    <td>{{ $travel_authorization->request_by }}</td>
                    <td>{{ $travel_authorization->approve_by }}</td>
                    <td>{{ $travel_authorization->departement }}</td>
                    <td>{{ $travel_authorization->purpose }}</td>
                    <td>{{ $travel_authorization->start_date }}</td>
                    <td>{{ $travel_authorization->end_date }}</td>
                    <td>
                        <span class="badge badge-warning">{{ $travel_authorization->status }}</span>
                    </td>
                    <td>
                        Rp. {{ number_format($travel_authorization->bn_price_1 + $travel_authorization->bn_price_2 + $travel_authorization->bn_price_3 + $travel_authorization->bn_price_4 + $travel_authorization->total_airfare + $travel_authorization->hotel_price_1 + $travel_authorization->hotel_price_2, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>