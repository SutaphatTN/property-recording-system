<div class="modal fade modalEditAsset" tabindex="-1" aria-labelledby="modalEditAssetLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAssetLabel">แก้ไขข้อมูลทรัพย์สินของบริษัท</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form
                    action="{{ route('assetData.update', $asset->id) }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="images"
                            class="col-md-4 col-form-label text-md-end">{{ __('รูปทรัพย์สิน') }}</label>

                        <div class="col-md-6">
                            @if($asset->images)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$asset->images) }}"
                                    alt="Asset Image" width="150">
                            </div>
                            @endif

                            <input id="images" type="file"
                                class="form-control @error('images') is-invalid @enderror" name="images">

                            @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="assetCode"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>

                        <div class="col-md-6">
                            <input id="assetCode" type="text"
                                class="form-control @error('assetCode') is-invalid @enderror" name="assetCode"
                                value="{{ $asset->assetCode }}" autocomplete="assetCode" required>

                            @error('assetCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="assetName"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Name') }}</label>

                        <div class="col-md-6">
                            <input id="assetName" type="text"
                                class="form-control @error('assetName') is-invalid @enderror"
                                name="assetName" value="{{ $asset->assetName }}" autocomplete="assetName" required>

                            @error('assetName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="detail_property"
                            class="col-md-4 col-form-label text-md-end">{{ __('รายละเอียดทรัพย์สิน') }}</label>

                        <div class="col-md-6">
                            <textarea id="detail_property"
                                class="form-control @error('detail_property') is-invalid @enderror"
                                name="detail_property"
                                rows="4" required>{{ $asset->detail_property }}</textarea>

                            @error('detail_property')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="company_id" class="col-md-4 col-form-label text-md-end">{{ __('บริษัท') }}</label>

                        <div class="col-md-6">
                            <select class="form-control company-select" name="company_id" required>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $asset->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name_th }}
                                </option>
                                @endforeach
                            </select>

                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="department_id"
                            class="col-md-4 col-form-label text-md-end">{{ __('แผนก') }}</label>

                        <div class="col-md-6">
                            <select class="form-control department-select" name="department_id" required>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $asset->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->department_name_th }}
                                </option>
                                @endforeach
                            </select>

                            @error('department_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="branch_id"
                            class="col-md-4 col-form-label text-md-end">{{ __('สาขา') }}</label>

                        <div class="col-md-6">
                            <select class="form-control branch-select" name="branch_id" required>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $asset->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name_th }}
                                </option>
                                @endforeach
                            </select>

                            @error('branch_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="location_sub"
                            class="col-md-4 col-form-label text-md-end">{{ __('location ย่อย') }}</label>

                        <div class="col-md-6">
                            <input id="location_sub" type="text"
                                class="form-control @error('location_sub') is-invalid @enderror" name="location_sub"
                                value="{{ $asset->location_sub }}" autocomplete="location_sub" required>

                            @error('location_sub')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="position_id"
                            class="col-md-4 col-form-label text-md-end">{{ __('ตำแหน่งรับผิดชอบ') }}</label>

                        <div class="col-md-6">
                            <select name="position_id" class="form-control">
                                @foreach($positions as $position)
                                <option value="{{ $position->id }}"
                                    {{ $asset->position_id == $position->id ? 'selected' : '' }}>
                                    {{ $position->position_name_th }}
                                </option>
                                @endforeach
                            </select>

                            @error('position_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="purchase_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่ซื้อ') }}</label>

                        <div class="col-md-6">
                            <input id="purchase_date" type="date"
                                class="form-control @error('purchase_date') is-invalid @enderror"
                                name="purchase_date" max="{{ date('Y-m-d') }}" 
                                value="{{ $asset->purchase_date }}">

                            @error('purchase_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="expiration_date"
                            class="col-md-4 col-form-label text-md-end">{{ __('วันที่หมดอายุประกัน') }}</label>

                        <div class="col-md-6">
                            <input id="expiration_date" type="date"
                                class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date"
                                value="{{ $asset->expiration_date }}">

                            @error('expiration_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="purchase_price"
                            class="col-md-4 col-form-label text-md-end">{{ __('ราคา') }}</label>

                        <div class="col-md-6">
                            <input id="purchase_price" type="text"
                                class="form-control @error('purchase_price') is-invalid @enderror"
                                name="purchase_price" value="{{ $asset->purchase_price !== null && $asset->purchase_price !== '' ? number_format((float)$asset->purchase_price, 2) : '-' }}" autocomplete="off">

                            @error('purchase_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="purchase_reason"
                            class="col-md-4 col-form-label text-md-end">{{ __('สาเหตุการซื้อ') }}</label>

                        <div class="col-md-6">
                            <textarea id="purchase_reason"
                                class="form-control @error('purchase_reason') is-invalid @enderror"
                                name="purchase_reason"
                                rows="4" autocomplete="purchase_reason">{{ $asset->purchase_reason ?: '-' }}</textarea>


                            @error('purchase_reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status"
                            class="col-md-4 col-form-label text-md-end">{{ __('สถานะ') }}</label>

                        <div class="col-md-6">
                            <select id="status"
                                class="form-control @error('status') is-invalid @enderror"
                                name="status"
                                autocomplete="status">
                                <option value="ใหม่" {{ $asset->status == 'ใหม่' ? 'selected' : '' }}>ใหม่</option>
                                <option value="มีอยู่แล้ว" {{ $asset->status == 'มีอยู่แล้ว' ? 'selected' : '' }}>มีอยู่แล้ว</option>
                            </select>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="presenter"
                            class="col-md-4 col-form-label text-md-end">{{ __('ผู้แจ้งซื้อ') }}</label>

                        <div class="col-md-6">
                            <input id="presenter"
                                type="text"
                                class="form-control readonly-field bg-light"
                                name="presenter"
                                value="{{ $asset->presenter }}"
                                readonly>

                            @error('presenter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="asset_status"
                            class="col-md-4 col-form-label text-md-end">{{ __('สถานะทรัพย์สิน') }}</label>

                        <div class="col-md-6">
                            <select id="asset_status"
                                class="form-control @error('asset_status') is-invalid @enderror"
                                name="asset_status"
                                autocomplete="asset_status">
                                <option value="ใช้งานอยู่" {{ $asset->asset_status == 'ใช้งานอยู่' ? 'selected' : '' }}>ใช้งานอยู่</option>
                                <option value="ไม่ได้ใช้งาน" {{ $asset->asset_status == 'ไม่ได้ใช้งาน' ? 'selected' : '' }}>ไม่ได้ใช้งาน</option>
                            </select>

                            @error('asset_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" id="btnUpdateAsset" class="btn btn-primary">
                                แก้ไขข้อมูล
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
    .modalEditAsset .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalEditAsset .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>