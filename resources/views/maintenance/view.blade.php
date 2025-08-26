@extends('layouts.app')
@section('title', 'Asset Maintenance')
@section('content')

<div class="text-center mt-4 mb-3">
    <h3><b>ข้อมูลการแจ้งซ่อม</b></h3>
</div>

<form id="searchForm" class="row justify-content-end align-items-center mb-3" method="get" action="{{ route('maintenance.index') }}">
    <div class="col-auto">
        <label class="me-2">สถานะ:</label>
        <select name="status" class="form-control form-control-sm w-auto">
            <option value="">-- เลือกสถานะ --</option>
            <option value="pending">รอตรวจสอบ</option>
            <option value="processing">รออนุมัติ</option>
            <option value="approved">อนุมัติแล้ว</option>
            <option value="rejected">ไม่ผ่านการอนุมัติ</option>
            <option value="finished">ซ่อมเสร็จแล้ว</option>
        </select>
    </div>

    <div class="col-auto">
        <label class="me-2">จากวันที่:</label>
        <input type="date" name="from_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
    </div>

    <div class="col-auto">
        <label class="me-2">ถึงวันที่:</label>
        <input type="date" name="to_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-warning">
            <i class="fas fa-search"></i> ค้นหา
        </button>
    </div>
</form>

<div id="containerEditMain"></div>
<div id="containerApproveMain"></div>

<div id="maintenanceTable">
    <table id="mainViewTable" class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">ข้อมูลอุปกรณ์ / สิ่งของ</th>
                <th class="text-center">วันที่แจ้งซ่อม</th>
                <th class="text-center">สาเหตุ</th>
                <th class="text-center">ผู้แจ้งซ่อม</th>
                <th class="text-center" width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenance as $key => $row)
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
                <td class="text-center">{{ \Carbon\Carbon::parse($row->repair_date)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $row->repair_reason }}</td>
                <td class="text-center">{{ $row->presenter }}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        @if(Auth::user()->role == 'staff' || 'audit')
                        @if($row->status == 'pending')
                        <button class="btn btn-warning btnOpenEditMainModal" title="แก้ไข" data-id="{{ $row->id }}"><i class="bi bi-pencil-square" style="color: white;"></i></button>
                        <button class="btn btn-danger btn-deleteMaintenance" title="ลบ" data-id="{{ $row->id }}"><i class="bi bi-trash"></i></button>
                        @else
                        <button class="btn btn-info btnOpenEditMainModal" title="ดูข้อมูล" data-id="{{ $row->id }}"><i class="bi bi-eye" style="color:white;"></i></button>
                        @endif
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    #mainViewTable_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }
</style>
@endsection