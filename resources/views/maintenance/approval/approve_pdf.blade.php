<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>{{ $maintenance->asset_information->assetCode ?? $maintenance->repair_name }}</title>
    <style>
        @page {
            margin: 100px 25px;
        }

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

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        body {
            font-family: 'THSarabunNew';
            font-size: 22pt;
            line-height: 1.1;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            line-height: 1.1
        }

        th,
        td {
            padding: 3px;
            text-align: center;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center;">ใบอนุมัติ</h3>

    <table class="no-border" style="width: 100%; border: none;">
        <tr class="no-border">
            <td class="no-border" style="text-align: left;">
                @if($maintenance->asset_information && $maintenance->asset_information->company && $maintenance->asset_information->company->company_image)
                <img src="{{ public_path('storage/' . $maintenance->asset_information->company->company_image) }}"
                    alt="Logo" style="max-width: 120px;">
                @endif
            </td>
            <td class="no-border" style="text-align: right;">
                @if($maintenance->asset_information)
                Asset Code : {{ $maintenance->asset_information->assetCode }}<br>
                @endif
                วันที่เสนอ : {{ $maintenance->approv_date_thai }}<br>
                @if($maintenance->status == 'finished')
                วันที่ซ่อมเสร็จ : {{ $maintenance->result_date_thai }}
                @endif
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th>รายละเอียด</th>
                <th>จำนวน</th>
                <th style="width: 100px;">หน่วยละ</th>
                <th style="width: 100px;">จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                @if($maintenance->asset_information)
                <td>{{ $maintenance->asset_information->assetName }}</td>
                @else
                <td>{{ $maintenance->repair_name }}</td>
                @endif
                <td>1</td>
                <td>{{ number_format($maintenance->repair_price, 2) }}</td>
                <td>{{ number_format($maintenance->repair_price, 2) }}</td>
            </tr>

            <tr>
                <td colspan="5" style="text-align: center;">
                    {{ $maintenance->repair_price_text }}
                </td>
            </tr>
        </tbody>

    </table>

    <!-- <table class="no-border" style="margin-top: 10px; border: none;">
        <tr class="no-border">
            <td class="no-border"><b>ราคาภาษาไทย:</b> </td>
            <td class="no-border" style="text-align: right;"><b>ราคารวม:</b> {{ $maintenance->repair_price }}</td>
        </tr>
    </table> -->

    <br><br>

    <footer>
        <table class="no-border" style="width: 100%;">
            <tr class="no-border">
                <td class="no-border" style="text-align: center;">
                    ผู้เสนอ<br>
                    {{ $maintenance->presenterUser->full_name }}
                </td>
                <td class="no-border" style="text-align: center;">
                    ผู้อนุมัติ<br>
                    {{ $maintenance->approverUser->full_name  }}
                </td>
            </tr>
        </table>
    </footer>


</body>

</html>