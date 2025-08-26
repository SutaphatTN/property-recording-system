@extends('layouts.app')
@section('title', 'Asset Maintenance Approval Result')
@section('content')

<div class="text-center mt-4 mb-3">
    <h3><b>ผลการอนุมัติ</b></h3>
</div>

<div id="containerAuditMain"></div>
<div id="containerViewMoreApp"></div>

<table id="mainViewResultTable" class="table table-bordered table-striped text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">ข้อมูลอุปกรณ์ / สิ่งของ</th>
            <th class="text-center">สาเหตุ</th>
            <th class="text-center">ผู้อนุมัติ</th>
            <th class="text-center">วันที่อนุมัติ</th>
            <th class="text-center">ผลการอนุมัติ</th>
            <th class="text-center" width="150px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($maintenance as $key => $row)
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            @if($row->asset_id)
            <td class="text-center">
                <span>Asset Code : {{ $row->asset_information->assetCode }}</span><br>
                <span>Asset Name : {{ $row->asset_information->assetName }}</span>
            </td>
            @else
            <td class="text-center">
                <span>{{ $row->repair_name }}</span>
            </td>
            @endif
            <td class="text-center">{{ $row->repair_reason }}</td>
            <td class="text-center">{{ $row->approver }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($row->approv_date)->format('d/m/Y') }}</td>
            <td class="text-center">{{ $row->status == 'rejected' ? 'ไม่ผ่าน' : 'ผ่าน' }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-info btnOpenViewMoreApp" title="ดูข้อมูล" data-id="{{ $row->id }}"><i class="bi bi-eye" style="color:white;"></i></button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">ไม่มีผลการอนุมัติ</td>
        </tr>
        @endforelse
    </tbody>
</table>

<style>
    #mainViewResultTable_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }
</style>
@endsection