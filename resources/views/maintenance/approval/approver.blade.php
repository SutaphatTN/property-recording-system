<div class="modal fade modalApproveMain" tabindex="-1" aria-labelledby="modalApproveMainLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApproveMainLabel">อนุมัติการแจ้งปัญหาการบำรุงทรัพย์สิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="approveFormMain" action="{{ route('maintenance.approve', $maintenance->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="assetCode"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>

                        <div class="col-md-6">
                            <select name="asset_id" class="form-control">
                                @foreach($asset as $info)
                                <option value="{{ $info->id }}"
                                    {{ $maintenance->asset_id == $info->id ? 'selected' : '' }}>
                                    {{ $info->assetCode }}
                                </option>
                                @endforeach
                            </select>


                            @error('assetCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

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
                            class="col-md-4 col-form-label text-md-end">{{ __('สาเหตุ') }}</label>

                        <div class="col-md-6">
                            <textarea id="repair_reason"
                                class="form-control @error('repair_reason') is-invalid @enderror"
                                name="repair_reason"
                                rows="4" autocomplete="repair_reason" required>{{ $maintenance->repair_reason }}</textarea>


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
                                class="form-control readonly-field"
                                name="presenter" value="{{ $maintenance->presenter }}" readonly>

                            @error('presenter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="repair_price"
                            class="col-md-4 col-form-label text-md-end">{{ __('ราคา') }}</label>

                        <div class="col-md-6">
                            <input id="repair_price" type="text"
                                class="form-control @error('repair_price') is-invalid @enderror"
                                name="repair_price" value="{{ $maintenance->repair_price }}" autocomplete="off" required>

                            @error('repair_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="process_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่ซ่อมเสร็จ') }}</label>

                        <div class="col-md-6">
                            <input id="process_date" type="date"
                                class="form-control @error('process_date') is-invalid @enderror"
                                name="process_date" value="{{ $maintenance->process_date }}" autocomplete="process_date" required>

                            @error('process_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="approver"
                            class="col-md-4 col-form-label text-md-end">{{ __('ผู้อนุมัติ') }}</label>

                        <div class="col-md-6">
                            <input id="approver"
                                type="text"
                                class="form-control readonly-field"
                                name="approver"
                                value="{{ Auth::user()->name }}"
                                readonly>

                            @error('approver')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="approv_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่อนุมัติ') }}</label>

                        <div class="col-md-6">
                            <input id="approv_date" type="date"
                                class="form-control @error('approv_date') is-invalid @enderror"
                                name="approv_date"
                                max="{{ date('Y-m-d') }}"
                                value="{{ old('approv_date', date('Y-m-d')) }}"
                                autocomplete="approv_date"
                                required>

                            @error('approv_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="note"
                            class="col-md-4 col-form-label text-md-end">{{ __('หมายเหตุ') }}</label>

                        <div class="col-md-6">
                            <textarea id="note"
                                class="form-control @error('note') is-invalid @enderror"
                                name="note"
                                rows="4">{{ $maintenance->note }}</textarea>

                            @error('note')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" id="btnApproveMaintenance" class="btn btn-primary">
                                อนุมัติ
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .readonly-field {
        background-color: rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        color: #555;
        cursor: not-allowed;
    }
</style>