<div id="contentArea">
    <div id="containerEditMain"></div>
    <div id="containerApproveMain"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">ข้อมูลการแจ้งซ่อม</h4>
        </div>
        <div class="card-body">

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
                    <input type="date" name="fromDate" max="{{ date('Y-m-d') }}" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-auto">
                    <label class="me-2">ถึงวันที่:</label>
                    <input type="date" name="toDate" max="{{ date('Y-m-d') }}" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-search"></i> ค้นหา
                    </button>
                </div>
            </form>

            <div id="maintenanceTable">
                <table id="mainViewTable" class="table table-bordered text-center align-middle custom-table">
                    <thead>
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
                            <td>{{ $key+1 }}</td>
                            @if($row->asset_id)
                            <td>
                                <strong class="text-muted">Asset Code : {{ $row->asset_information->assetCode }}</strong><br>
                                <small>Asset Name : {{ $row->asset_information->assetName }}</small>
                            </td>
                            @else
                            <td>
                                <strong class="text-muted">{{ $row->repair_name }}</strong>
                            </td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($row->repair_date)->format('d/m/Y') }}</td>
                            <td>{{ $row->repair_reason }}</td>
                            <td>{{ $row->presenter }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if(Auth::user()->role == 'staff' || Auth::user()->role == 'audit')
                                    @if($row->status == 'pending')
                                    <button class="btn btn-warning btn-icon btnOpenEditMainModal" title="แก้ไข" data-id="{{ $row->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-icon btn-deleteMaintenance" title="ลบ" data-id="{{ $row->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-info btn-icon btnOpenEditMainModal" title="ดูข้อมูล" data-id="{{ $row->id }}">
                                        <i class="bx bx-show"></i>
                                    </button>
                                    @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        #mainViewTable_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        #contentArea .btn .bx {
            color: #fff !important;
        }
    </style>
</div>