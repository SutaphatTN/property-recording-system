@extends('layouts.app')
@section('title', 'Asset Maintenance Audit')
@section('content')

<div class="text-center mt-4 mb-3">
    <h3><b>ข้อมูลแจ้งซ่อมรอตรวจสอบ</b></h3>
</div>

<div id="containerAuditMain"></div>

<table id="mainViewAuditTable" class="table table-bordered table-striped text-center align-middle">
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
            <td class="text-center">{{ \Carbon\Carbon::parse($row->repair_date)->format('d/m/Y') }}</td>
            <td class="text-center">{{ $row->repair_reason }}</td>
            <td class="text-center">{{ $row->presenter }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    @auth
                    @if(Auth::user()->role == 'audit')
                    @if($row->status == 'pending')
                    <button class="btn btn-warning btnOpenAuditMainModal" title="ตรวจสอบ"
                        data-id="{{ $row->id }}">
                        <i class="bi bi-card-list" style="color:white;"></i>
                    </button>
                    <button class="btn btn-danger btn-deleteMaintenance" title="ลบ" data-id="{{ $row->id }}"><i class="bi bi-trash"></i></button>
                    @elseif($row->status == 'processing')
                    <button class="btn btn-primary btnOpenAuditMainModal" title="รออนุมัติ" data-id="{{ $row->id }}">รออนุมัติ</button>
                    @elseif($row->status == 'approved')
                    <button class="btn btn-success" title="อนุมัติ" data-id="{{ $row->id }}">อนุมัติแล้ว</button>
                    @elseif($row->status == 'rejected')
                    <button class="btn btn-dark" title="ไม่อนุมัติ" data-id="{{ $row->id }}">ไม่อนุมัติ</button>
                    @endif
                    @endif
                    @endauth


                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">ไม่มีการแจ้งซ่อม</td>
        </tr>
        @endforelse
    </tbody>
</table>

<style>
    #mainViewAuditTable_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }
</style>
@endsection