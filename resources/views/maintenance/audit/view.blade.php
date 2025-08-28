<div id="contentArea">

    <div id="containerAuditMain"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">รอตรวจสอบ</h4>
        </div>
        <div class="card-body">

            <table id="mainViewAuditTable" class="table table-bordered text-center align-middle custom-table">
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
                    @forelse($maintenance as $key => $row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        @if($row->asset_id)
                        <td>
                            <strong class="text-muted">Asset Code : {{ $row->asset_information->assetCode }}</strong><br>
                            <small>Asset Name : {{ $row->asset_information->assetName }}</small>
                        </td>
                        @else
                        <td>
                            <strong class="text-muted">Asset Code : {{ $row->repair_name }}</strong>
                        </td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($row->repair_date)->format('d/m/Y') }}</td>
                        <td>{{ $row->repair_reason }}</td>
                        <td>{{ $row->presenter }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @auth
                                @if(Auth::user()->role == 'audit')
                                @if($row->status == 'pending')
                                <button class="btn btn-warning btn-icon btnOpenAuditMainModal" title="ตรวจสอบ"
                                    data-id="{{ $row->id }}">
                                    <i class="bx bx-detail" style="color:white;"></i>
                                </button>
                                <button class="btn btn-danger btn-icon btn-deleteMaintenance" title="ลบ" data-id="{{ $row->id }}">
                                    <i class="bx bx-printer"></i>
                                </button>
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
        </div>
    </div>

    <style>
        #mainViewAuditTable_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        #contentArea .btn .bx {
            color: #fff !important;
        }
    </style>
</div>