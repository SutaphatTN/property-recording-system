<div class="modal fade modalViewMoreApp" tabindex="-1" aria-labelledby="modalViewMoreAppLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewMoreAppLabel">ข้อมูลแจ้งซ่อม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($maintenance->images)
                @php
                $images = json_decode($maintenance->images, true) ?? [];
                @endphp

                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($images as $img)
                        <div class="col-4 mb-3">
                            <div class="card">
                                <div class="d-flex justify-content-center align-items-center mt-3"
                                    style="width: 100%; height: 200px; margin:auto;">
                                    <img src="{{ asset('storage/'.$img) }}"
                                        class="card-img-top"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="row mt-3">
                    @if($maintenance->asset_id)
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">Asset Code :</label>
                            <div class="col-md-8">
                                <input type="text" name="assetCode" class="form-control" value="{{ $maintenance->asset_information->assetCode }}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">Asset Name :</label>
                            <div class="col-md-8">
                                <input type="text" name="assetName" class="form-control" value="{{ $maintenance->asset_information->assetName }}" disabled />
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">ครุภัณฑ์ :</label>
                            <div class="col-md-6">
                                <input type="text" name="repair_name" class="form-control" value="{{ $maintenance->repair_name }}" disabled />
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">วันที่แจ้งซ่อม :</label>
                            <div class="col-md-8">
                                <input type="text" name="repair_date" class="form-control" value="{{ $maintenance->repair_date_formatted }}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">สาเหตุการซ่อม :</label>
                            <div class="col-md-8">
                                <textarea name="repair_reason"
                                    class="form-control"
                                    disabled>{{ $maintenance->repair_reason }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">ผู้แจ้งซ่อม :</label>
                            <div class="col-md-8">
                                <input type="text" name="presenter" class="form-control" value="{{ $maintenance->presenter }}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">ราคา :</label>
                            <div class="col-md-8">
                                <input type="text" name="repair_price" class="form-control" value="{{ number_format($maintenance->repair_price, 2) }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">วันที่ขออนุมัติ :</label>
                            <div class="col-md-8">
                                <input type="text" name="process_date" class="form-control" value="{{ $maintenance->process_date_formatted }}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">ผู้ตรวจสอบ :</label>
                            <div class="col-md-8">
                                <input type="text" name="operator" class="form-control" value="{{ $maintenance->operator }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    @if($maintenance->status == 'approved' || $maintenance->status == 'rejected' || $maintenance->status == 'finished')
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">วันที่อนุมัติ :</label>
                            <div class="col-md-8">
                                <input type="text" name="approv_date" class="form-control" value="{{ $maintenance->approv_date_formatted }}" disabled />
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-6"></div>
                    @endif
                    <div class="col-6">
                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-end">ผู้อนุมัติ :</label>
                            <div class="col-md-8">
                                <!-- <input type="text" name="approver" class="form-control" value="{{ $maintenance->approver_name  }}" disabled /> -->
                                <input type="text" name="approver" class="form-control" value="{{ $maintenance->approverUser->name }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    @if($maintenance->status == 'approved')
                    <div class="col-6 text-center">
                        <a href="{{ asset('storage/' . $maintenance->quotation) }}" target="_blank" class="btn btn-secondary">
                            ดูไฟล์ใบเสนอราคา
                        </a>
                    </div>

                    <div class="col-6 text-center">
                        <a href="{{ route('maintenance.downloadApprove', $maintenance->id) }}" class="btn btn-info">
                            ดาวน์โหลดใบอนุมัติ
                        </a>
                    </div>
                    @else
                    <div class="col-12 text-center">
                        <a href="{{ asset('storage/' . $maintenance->quotation) }}" target="_blank" class="btn btn-secondary">
                            ดูไฟล์ใบเสนอราคา
                        </a>
                    </div>
                    @endif
                </div>

                @if($maintenance->status == 'approved')
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="button" id="btnFinishMaintenance" class="btn btn-success" data-id="{{ $maintenance->id }}">
                            ซ่อมเสร็จแล้ว
                        </button>
                    </div>
                </div>
                @endif

                @php
                $userRole = auth()->user()->role;
                @endphp

                <div class="row mt-3">
                    <div class="col-12 text-end">
                        @if($maintenance->status == 'processing')

                        @if($maintenance->approverUser->role == 'manager')
                        @if( ($userRole == 'audit' || $userRole == 'manager' || $userRole == 'md') )
                        <button class="btn btn-success btn-approve" style="margin-right: 4px;" title="อนุมัติ" data-id="{{ $maintenance->id }}">
                            <i class="bi bi-check2"></i> อนุมัติ
                        </button>
                        <button class="btn btn-danger btn-reject" title="ไม่อนุมัติ" data-id="{{ $maintenance->id }}">
                            <i class="bi bi-x-lg"></i> ไม่อนุมัติ
                        </button>
                        @endif
                        @endif

                        @if($maintenance->approverUser->role == 'md')
                        @if( $userRole == 'md' )
                        <button class="btn btn-success btn-approve" style="margin-right: 4px;" title="อนุมัติ" data-id="{{ $maintenance->id }}">
                            <i class="bi bi-check2"></i> อนุมัติ
                        </button>
                        <button class="btn btn-danger btn-reject" title="ไม่อนุมัติ" data-id="{{ $maintenance->id }}">
                            <i class="bi bi-x-lg"></i> ไม่อนุมัติ
                        </button>
                        @endif
                        @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modalViewMoreApp .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalViewMoreApp .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>