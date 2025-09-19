@php
$assets = $asset instanceof \Illuminate\Support\Collection ? $asset : collect([$asset]);
@endphp

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>QR Code Assets</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            src: url("{{ resource_path('fonts/THSarabunNew.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url("{{ resource_path('fonts/THSarabunNew-Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'THSarabunNew', DejaVu Sans, sans-serif;
            font-size: 16pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 50%;
            border: 1px solid #ccc;
            padding: 3px;
            vertical-align: top;
        }

        .label-top {
            display: table;
            width: 100%;
        }

        .label-top img {
            display: table-cell;
            vertical-align: top;
            width: 140px;
            height: 140px;
        }

        .label-text {
            display: table-cell;
            vertical-align: top;
            padding-left: 8px;
            font-size: 16pt;
            text-align: left;
        }

        .label-text p {
            margin: 0;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            @foreach($assets as $index => $row)
            <td>
                <div class="label-top">
                    <img src="{{ public_path('storage/'.$row->qrCode) }}" alt="QR Code">
                    <div class="label-text">
                        <p><b>รหัส :</b> {{ $row->assetCode }}</p>
                        <p><b>ชื่อ :</b> {{ $row->assetName }}</p>
                        <p><b>วันที่ซื้อ :</b> {{ $row->purchase_date_formatted }}</p>
                        <p><b>หมดประกัน :</b> {{ $row->expiration_date_formatted }}</p>
                    </div>
                </div>
                <div class="label-footer">
                    รายละเอียด : {{ Str::limit($row->detail_property, 40, 'ฯ') }}
                </div>
            </td>

            @if(($index + 1) % 2 == 0)
        </tr>
        <tr>
            @endif
            @endforeach

            @if($assets->count() % 2 != 0)
            <td></td>
            @endif
        </tr>
    </table>
</body>

</html>