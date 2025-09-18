<div id="contentArea">

    <div id="containerAuditMain"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">รอตรวจสอบ</h4>
        </div>
        <div class="card-body table-responsive">

            <table id="mainViewAuditTable" class="table table-bordered text-center align-middle custom-table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">ข้อมูลครุภัณฑ์</th>
                        <th class="text-center">วันที่แจ้งซ่อม</th>
                        <th class="text-center">สาเหตุ</th>
                        <th class="text-center">ผู้แจ้งซ่อม</th>
                        <th class="text-center" width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $canEdit = in_array(auth()->user()->role, ['audit', 'md', 'manager']);
                    @endphp

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
                        <td>{{ $row->repair_date_formatted }}</td>
                        <td>{{ $row->repair_reason }}</td>
                        <td>{{ $row->presenterUser->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @if($row->status == 'pending')
                                <button class="btn btn-warning btn-icon btnOpenAuditMainModal"
                                    title="ตรวจสอบ"
                                    data-id="{{ $row->id }}"
                                    {{ $canEdit ? '' : 'disabled' }}
                                    {{ $canEdit ? '' : 'style=opacity:0.5;cursor:not-allowed;' }}>
                                    <i class="bx bx-detail" style="color:white;"></i>
                                </button>

                                <button class="btn btn-danger btn-icon btn-deleteMaintenanceAudit"
                                    title="ลบ"
                                    data-id="{{ $row->id }}"
                                    {{ $canEdit ? '' : 'disabled' }}
                                    {{ $canEdit ? '' : 'style=opacity:0.5;cursor:not-allowed;' }}>
                                    <i class="bx bx-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
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