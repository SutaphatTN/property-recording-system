<div class="modal fade modalAuditMain" tabindex="-1" aria-labelledby="modalAuditMainLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAuditMainLabel">ตรวจสอบ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="auditFormMain" action="{{ route('maintenance.updateAudit', $maintenance->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    @if($maintenance->status == 'pending')
                    @if($maintenance->asset_id)
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

                            @error('asset_id')
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
                                class="form-control readonly-field bg-light"
                                name="presenter" value="{{ $maintenance->presenter }}" readonly>

                            @error('presenter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @if($maintenance->repair_name)
                    <div class="row mb-3">
                        <label for="assetCode"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control asset_search" placeholder="พิมพ์ Asset Code เพื่อค้นหา">
                            <input type="hidden" name="asset_id" class="asset_id">
                            
                            @error('assetCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <label for="repair_price"
                            class="col-md-4 col-form-label text-md-end">{{ __('ราคา') }}</label>

                        <div class="col-md-6">
                            <input id="repair_price" type="text"
                                class="form-control @error('repair_price') is-invalid @enderror"
                                name="repair_price" value="" autocomplete="off" required>

                            @error('repair_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="quotation"
                            class="col-md-4 col-form-label text-md-end">{{ __('ใบเสนอราคา') }}</label>


                        <div class="col-md-6">
                            @if(!empty($maintenance->quotation))
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $maintenance->quotation) }}" target="_blank" class="btn btn-secondary">
                                    ดูไฟล์ใบเสนอราคา
                                </a>
                            </div>
                            @endif

                            <input id="quotation" type="file" accept="application/pdf"
                                class="form-control @error('quotation') is-invalid @enderror"
                                name="quotation" value="{{ old('quotation', $maintenance->quotation) }}" autocomplete="off">

                            @error('quotation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="operator"
                            class="col-md-4 col-form-label text-md-end">{{ __('ผู้ตรวจสอบ') }}</label>

                        <div class="col-md-6">
                            <input id="operator"
                                type="text"
                                class="form-control readonly-field bg-light"
                                name="operator"
                                value="{{ Auth::user()->name }}"
                                readonly>

                            @error('operator')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="process_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่ขออนุมัติ') }}</label>

                        <div class="col-md-6">
                            <input id="process_date" type="date"
                                class="form-control @error('process_date') is-invalid @enderror"
                                name="process_date" max="{{ date('Y-m-d') }}" value="{{ $maintenance->process_date }}" autocomplete="process_date" required>

                            @error('process_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @if($maintenance->status == 'pending')
                            <button type="button" id="btnUpdateMaintenance" class="btn btn-primary">
                                บันทึก
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modalAuditMain .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalAuditMain .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>