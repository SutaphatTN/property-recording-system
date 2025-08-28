<div class="modal fade modalEditMain" tabindex="-1" aria-labelledby="modalEditMainLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @if($maintenance->status == 'pending')
                <h5 class="modal-title" id="modalEditMainLabel">แก้ไขข้อมูลการแจ้งซ่อม</h5>
                @else
                <h5 class="modal-title" id="modalEditMainLabel">
                    ติดตามสถานะการแจ้งซ่อม :
                    @if($maintenance->status == 'pending')
                    รอตรวจสอบ
                    @elseif($maintenance->status == 'processing')
                    รออนุมัติ
                    @elseif($maintenance->status == 'approved')
                    อนุมัติแล้ว
                    @elseif($maintenance->status == 'rejected')
                    ไม่ผ่านการอนุมัติ
                    @else
                    ซ่อมเสร็จแล้ว
                    @endif
                </h5>

                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editFormMain" action="{{ route('maintenance.update', $maintenance->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($maintenance->status == 'pending')
                    @if($maintenance->asset_id)
                    <div class="row mb-3">
                        <label for="assetCode"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control asset_search" placeholder="พิมพ์ Asset Code เพื่อค้นหา"
                                value="{{ $maintenance->asset_information->assetCode }}">
                            <input type="hidden" name="asset_id" class="asset_id">

                            @error('assetCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @else
                    <div class="row mb-3">
                        <label for="repair_name"
                            class="col-md-4 col-form-label text-md-end">{{ __('อุปกรณ์ / สิ่งของ ที่ต้องการซ่อม') }}</label>

                        <div class="col-md-6">
                            <input id="repair_name" type="text"
                                class="form-control"
                                name="repair_name" value="{{ $maintenance->repair_name }}">

                            @error('repair_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <label for="repair_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่แจ้งซ่อม') }}</label>

                        <div class="col-md-6">
                            <input id="repair_date" type="date"
                                class="form-control @error('repair_date') is-invalid @enderror"
                                name="repair_date" max="{{ date('Y-m-d') }}" value="{{ $maintenance->repair_date }}" autocomplete="repair_date" required>

                            @error('repair_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="repair_reason"
                            class="col-md-4 col-form-label text-md-end">{{ __('สาเหตุการซ่อม') }}</label>

                        <div class="col-md-6">
                            <textarea id="repair_reason"
                                class="form-control @error('repair_reason') is-invalid @enderror"
                                name="repair_reason"
                                rows="4" autocomplete="repair_reason" required>{{ $maintenance->repair_reason }}</textarea>

                            @if($maintenance->status == 'processing')
                            <textarea id="repair_reason"
                                class="form-control readonly-field @error('repair_reason') is-invalid @enderror"
                                name="repair_reason"
                                rows="4" autocomplete="repair_reason" readonly>{{ $maintenance->repair_reason }}</textarea>
                            @endif


                            @error('repair_reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="presenter"
                            class="col-md-4 col-form-label text-md-end">{{ __('ผู้แจ้งซ่อม') }}</label>

                        <div class="col-md-6">
                            <input id="presenter" type="text"
                                class="form-control readonly-field bg-light"
                                name="presenter" value="{{ $maintenance->presenter }}" readonly>

                            @error('presenter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @elseif($maintenance->status == 'processing' || 'approved' || 'rejected' || 'finished')

                    @if($maintenance->asset_id && $asset && $asset->images)
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="card">
                                    <div class="d-flex justify-content-center align-items-center mt-3"
                                        style="width: 100%; height: 200px; margin:auto;">

                                        <img src="{{ asset('storage/'.$asset->images) }}"
                                            class="card-img-top"
                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center">รูปทรัพย์สิน</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mt-3">
                        @if($maintenance->asset_id && $asset)
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">Asset Code :</label>
                                <div class="col-md-8">
                                    <input type="text" name="assetCode" class="form-control" value="{{ $asset->assetCode }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">Asset Name :</label>
                                <div class="col-md-8">
                                    <input type="text" name="assetName" class="form-control" value="{{ $asset->assetName }}" disabled />
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">อุปกรณ์ / สิ่งของ ที่ต้องการซ่อม :</label>
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
                                    <input type="text" name="repair_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->repair_date)->format('d/m/Y') }}" disabled />
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
                                    <input type="text" name="process_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->process_date)->format('d/m/Y') }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผู้อนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approver" class="form-control" value="{{ $maintenance->approver }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status == 'approved')
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่ขออนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->approv_date)->format('d/m/Y') }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผลการอนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $maintenance->status == 'approved' ? 'ผ่าน' : '' }}"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status == 'rejected')
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่ขออนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->approv_date)->format('d/m/Y') }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผลการอนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $maintenance->status == 'rejected' ? 'ไม่ผ่าน' : '' }}"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status == 'finished')
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่ขออนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->approv_date)->format('d/m/Y') }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผลการอนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $maintenance->status == 'finished' ? 'ผ่าน' : '' }}"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผลการซ่อม :</label>
                                <div class="col-md-8">
                                    <input type="text" name="repair_result" class="form-control" value="{{ $maintenance->repair_result }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่ซ่อมเสร็จ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="result_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->result_date)->format('d/m/Y') }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @if($maintenance->status == 'pending')
                            <button type="button" id="btnUpdateMaintenance" class="btn btn-primary">
                                แก้ไขข้อมูล
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                            @elseif($maintenance->status == 'approved')
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="button" id="btnFinishMaintenance" class="btn btn-success" data-id="{{ $maintenance->id }}">
                                        เสร็จแล้ว
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modalEditMain .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalEditMain .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>