
<table>
    <thead>
        <tr>
            <th>รูปทรัพย์สิน</th>
            <th>Qr Code</th>
            <th>Asset Code</th>
            <th>Asset Name</th>
            <th>บริษัท</th>
            <th>แผนก</th>
            <th>สาขา</th>
            <th>ตำแหน่งรับผิดชอบ</th>
            <th>location ย่อย</th>
            <th>วันที่ซื้อ</th>
            <th>วันหมดประกัน</th>
            <th>สถานะ</th>
            <th>สถานะทรัพย์สิน</th>
            <th>รายละเอียดทรัพย์สิน</th>
            <th>สาเหตุ</th>
            <th>ผู้แจ้งซื้อ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asset as $row)
        <tr>
            <td>{{ $row->assetCode }}</td>
            <td>{{ $row->assetName }}</td>
            <td>{{ $row->detail_property }}</td>
            <td>{{ $row->company->company_name ?? '-' }}</td>
            <td>{{ $row->branch->branch_name ?? '-' }}</td>
            <td>{{ $row->department->department_name ?? '-' }}</td>
            <td>{{ $row->position->position_name ?? '-' }}</td>
            <td>{{ $row->purchase_date }}</td>
            <td>{{ $row->expiration_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
