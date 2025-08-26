<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 100px 25px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        body {
            font-family: 'sarabun';
            font-size: 16pt;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center;">ใบเสนอซ่อม</h3>

    <table class="no-border" style="width: 100%; border: none;">
        <tr class="no-border">
            <td class="no-border" style="text-align: left;">
                <img src="{{ public_path('storage/' . $maintenance->asset_information->company->company_image) }}"
                    alt="Logo" style="max-width: 120px;">
            </td>
            <td class="no-border" style="text-align: right;">
                <b>Asset Code:</b> {{ $maintenance->asset_information->assetCode }}<br>
                <b>วันที่เสนอ:</b> {{ $maintenance->repair_date_thai }}
            </td>
        </tr>
    </table>


    <br>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th>รายละเอียด</th>
                <th style="width: 100px;">หน่วยละ</th>
                <th style="width: 100px;">จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $maintenance->asset_information->detail_property }}</td>
                <td>{{ $maintenance->repair_price }}</td>
                <td>{{ $maintenance->repair_price }}</td>
            </tr>

            <!-- <tr>
                <td colspan="4" style="text-align: left; font-weight: bold;">
                    {{ $maintenance->repair_price_text }}
                </td>
            </tr> -->
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
                    ผู้เสนอ<br><br>
                    .................................<br>
                    ({{ $maintenance->presenter }})
                </td>
                <td class="no-border" style="text-align: center;">
                    ผู้อนุมัติ<br><br>
                    .................................<br>
                    (................................)
                </td>
            </tr>
        </table>
    </footer>


</body>

</html>