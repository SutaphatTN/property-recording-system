<div id="contentArea">

    <div id="containerViewMoreApp"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">รออนุมัติ</h4>
        </div>
        <div class="card-body table-responsive">
            <table id="mainViewApproveTable" class="table table-bordered text-center align-middle custom-table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">ข้อมูลครุภัณฑ์</th>
                        <th class="text-center">สาเหตุ</th>
                        <th class="text-center">ผู้ตรวจสอบ</th>
                        <th class="text-center">ผู้อนุมัติ</th>
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
                        <td><strong class="text-muted">{{ $row->repair_name }}</strong></td>
                        @endif
                        <td>{{ $row->repair_reason }}</td>
                        <td>{{ $row->operatorUser->name }}</td>
                        <td>
                            @php
                            $badgeClass = ($row->approverUser && $row->approverUser->role == 'manager')
                            ? 'bg-label-warning'
                            : 'bg-label-primary';
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $row->approverUser->name ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-info btn-icon btnOpenViewMoreApp" title="ดูข้อมูล" data-id="{{ $row->id }}">
                                    <i class="bx bx-show"></i>
                                </button>
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
    #mainViewApproveTable_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }

    #contentArea .btn .bx {
        color: #fff !important;
    }
</style>