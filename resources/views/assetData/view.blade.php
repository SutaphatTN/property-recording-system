@extends('layouts.app')
@section('title', 'Asset Information')
@section('content')

<div class="text-center mt-4 mb-3">
    <h3><b>ข้อมูลทรัพย์สินของบริษัท</b></h3>
</div>

<div id="containerEdit"></div>
<div id="containerView"></div>

<table id="assetViewTable" class="table table-bordered table-striped text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th class="text-center">No.</th>
            <!-- <th class="text-center">รูปทรัพย์สิน</th> -->
            <th class="text-center">ข้อมูลทรัพย์สิน</th>
            <th class="text-center">ราคา</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">ผู้แจ้งซื้อ</th>
            <th class="text-center">สถานะทรัพย์สิน</th>
            <th class="text-center" width="150px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asset as $key => $row)
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            <!-- <td>
                <img src="{{ asset('storage/'.$row->images) }}" width="100"><br>
            </td> -->
            <td>
                <span>Asset Code : {{ $row->assetCode }}</span><br>
                <span>Asset Name : {{ $row->assetName }}</span>
            </td>
            <!-- <td class="text-center">
                <img src="{{ asset('storage/' . $row->qrCode) }}"
                    width="120"
                    alt="QR Code"
                    data-bs-toggle="modal"
                    data-bs-target="#qrModal{{ $row->id }}"
                    style="cursor: pointer;">

                <div style="margin-top: 8px;">
                    <a href="{{ asset('storage/' . $row->qrCode) }}"
                        download="{{ $row->assetCode }}.png"
                        class="btn btn-sm btn-primary">
                        ดาวน์โหลด
                    </a>
                </div>

                <div class="modal fade" id="qrModal{{ $row->id }}" tabindex="-1" aria-labelledby="qrModalLabel{{ $row->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrModalLabel{{ $row->id }}">QR Code: {{ $row->assetCode }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $row->qrCode) }}" class="img-fluid" alt="QR Code" style="max-width: 100%;">
                            </div>
                            <div class="modal-footer">
                                <a href="{{ asset('storage/' . $row->qrCode) }}"
                                    download="{{ $row->assetCode }}.png"
                                    class="btn btn-success">
                                    ดาวน์โหลด
                                </a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td> -->
            <td class="text-center">{{ number_format($row->purchase_price, 2) }}</td>
            <td class="text-center">{{ $row->status }}</td>
            <td class="text-center">{{ $row->presenter }}</td>
            <td class="text-center">{{ $row->asset_status }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-info btnOpenViewModal" title="ดูข้อมูล" data-id="{{ $row->id }}"><i class="bi bi-eye" style="color:white;"></i></button>
                    <button class="btn btn-warning btnOpenEditModal" title="แก้ไข" data-id="{{ $row->id }}"><i class="bi bi-pencil-square" style="color: white;"></i></button>
                    <a href="{{ route('assetData.downloadPrintOne', $row->id) }}" class="btn btn-primary">
                        <i class="bi bi-printer"></i>
                    </a>


                    <button class="btn btn-danger btn-deleteAsset" title="ลบ" data-id="{{ $row->id }}"><i class="bi bi-trash"></i></button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
    #assetViewTable_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }
</style>

@endsection