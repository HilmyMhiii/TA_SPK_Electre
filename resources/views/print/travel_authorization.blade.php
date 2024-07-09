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
        <p>TRAVEL AUTHORIZATION FORM</p>
    </div>
    <p>Here are details of yout request:</p>
    <table>
        <tr>
            <td>ID TA</td>
            <td>:</td>
            <td>{{ $travelAuthorization->id_ta }}</td>
        </tr>
        <tr>
            <td>Request By</td>
            <td>:</td>
            <td>{{ $travelAuthorization->request_by }}</td>
        </tr>
        <tr>
            <td>Approve By</td>
            <td>:</td>
            <td>{{ $travelAuthorization->approve_by }}</td>
        </tr>
        <tr>
            <td>Departement</td>
            <td>:</td>
            <td>{{ $travelAuthorization->departement }}</td>
        </tr>
        <tr>
            <td>Purpose/Event</td>
            <td>:</td>
            <td>{{ $travelAuthorization->purpose }}</td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td>:</td>
            <td>{{ $travelAuthorization->start_date }}</td>
        </tr>
        <tr>
            <td>End Date</td>
            <td>:</td>
            <td>{{ $travelAuthorization->end_date }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $travelAuthorization->status }}</td>
        </tr>
    </table>
    <div class="titleSecSec">
        <p>Data Traveller</p>
    </div>
    <table width="100%">
        <tr>
            <td style="text-align: center;">BN</td>
            <td style="text-align: center;">Name</td>
            <td style="text-align: center;">Departement</td>
            <td style="text-align: center;">Charge To</td>
            <td style="text-align: center;">Passport</td>
            <td style="text-align: center;">Total Price</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->bn_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->bn_name_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->departement_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->charge_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->passport_1 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->bn_price_1, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->bn_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->bn_name_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->departement_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->charge_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->passport_2 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->bn_price_2, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->bn_3 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->bn_name_3 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->departement_3 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->charge_3 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->passport_3 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->bn_price_3, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->bn_4 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->bn_name_4 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->departement_4 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->charge_4 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->passport_4 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->bn_price_4, 0, ',', '.') }}</td>
        </tr>
    </table>
    <div class="titleSecSec">
        <p>Data Flight</p>
    </div>
    <table width="100%">
        <tr>
            <td style="text-align: center;">Aircraft Name</td>
            <td style="text-align: center;">Total Airfare</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->aircraft_name }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->total_airfare, 0, ',', '.') }}</td>
        </tr>
    </table>
    <div class="titleSecSec">
        <p>Data Hotel</p>
    </div>
    <table width="100%">
        <tr>
            <td style="text-align: center;">Hotel Name</td>
            <td style="text-align: center;">City</td>
            <td style="text-align: center;">Checkin Date</td>
            <td style="text-align: center;">Checkout Date</td>
            <td style="text-align: center;">Hotel Price</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->hotel_name_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->city_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->checkin_date_1 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->checkout_date_1 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->hotel_price_1, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $travelAuthorization->hotel_name_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->city_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->checkin_date_2 }}</td>
            <td style="text-align: center;">{{ $travelAuthorization->checkout_date_2 }}</td>
            <td style="text-align: center;">Rp. {{ number_format($travelAuthorization->hotel_price_2, 0, ',', '.') }}</td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 10px; background:#DCF2F1;" border="1">
        <tr>
            <td style="text-align: left;">Total Prices</td>
            <td style="text-align: left;">Rp. {{ number_format($travelAuthorization->bn_price_1 + $travelAuthorization->bn_price_2 + $travelAuthorization->bn_price_3 + $travelAuthorization->bn_price_4 + $travelAuthorization->total_airfare + $travelAuthorization->hotel_price_1 + $travelAuthorization->hotel_price_2, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>