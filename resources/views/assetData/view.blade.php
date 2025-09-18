<div id="contentArea">
    <div id="containerEdit"></div>
    <div id="containerView"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">รายการทรัพย์สิน</h4>
        </div>
        <div class="card-body table-responsive">
            <table id="assetViewTable" class="table table-bordered text-center align-middle custom-table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
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
                        <td>{{ $key+1 }}</td>
                        <td>
                            <strong class="text-muted">Asset Code : {{ $row->assetCode }}</strong><br>
                            <small>Asset Name : {{ $row->assetName }}</small>
                        </td>
                        <td>
                            {{ $row->purchase_price !== null && $row->purchase_price !== '' ? number_format((float)$row->purchase_price, 2) : '-' }}
                        </td>
                        <td>
                            @if($row->status === 'ใหม่')
                            <span class="badge bg-label-info">{{ $row->status }}</span>
                            @else
                            <span class="badge bg-label-warning">{{ $row->status }}</span>
                            @endif
                        </td>
                        <td>{{ $row->presenterUser->name }}</td>
                        <td>
                            @if($row->asset_status === 'ใช้งานอยู่')
                            <span class="badge bg-label-success">{{ $row->asset_status }}</span>
                            @else
                            <span class="badge bg-label-danger">{{ $row->asset_status }}</span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-icon btn-info btnOpenViewModal" data-id="{{ $row->id }}" title="ดูข้อมูล">
                                    <i class="bx bx-show"></i>
                                </button>
                                <button class="btn btn-icon btn-warning btnOpenEditModal" data-id="{{ $row->id }}" title="แก้ไข">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <a href="{{ route('assetData.downloadPrintOne', $row->id) }}" target="_blank" class="btn btn-icon btn-primary" title="ปริ้น">
                                    <i class="bx bx-printer"></i>
                                </a>
                                <button class="btn btn-icon btn-danger btn-deleteAsset" data-id="{{ $row->id }}" title="ลบ">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        #assetViewTable_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        #contentArea .btn .bx {
            color: #fff !important;
        }
    </style>
</div>