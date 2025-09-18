<div class="modal fade modalEditMain" tabindex="-1" aria-labelledby="modalEditMainLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @if($maintenance->status == 'pending')
                <h5 class="modal-title" id="modalEditMainLabel">แก้ไขข้อมูลการแจ้งซ่อม</h5>
                @else
                <h5 class="modal-title" id="modalEditMainLabel">
                    สถานะการแจ้งซ่อม :
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

                    <div class="row mb-3">
                        <div class="col-md-12 d-flex flex-wrap justify-content-center" id="existingImages">
                            @foreach($maintenance->images ?? [] as $index => $img)
                            <div class="existing-image position-relative m-2">
                                <img src="{{ asset('storage/'.$img) }}" alt="Image" width="120" height="120" class="img-thumbnail">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image">X</button>
                                <input type="hidden" name="existing_images[]" value="{{ $img }}">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Upload new images --}}
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">เพิ่มรูปใหม่</label>
                        <div class="col-md-6">
                            <input type="file" name="images[]" id="imagesMainEdit" class="form-control" multiple accept="image/*">
                            <small class="text-muted">รวมรูปทั้งหมด ต้องไม่เกิน 3 รูป</small>
                        </div>
                    </div>

                    @if($maintenance->asset_id)
                    <div class="row mb-3">
                        <label for="assetCode"
                            class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control asset_search" placeholder="พิมพ์ Asset Code เพื่อค้นหา"
                                value="{{ $maintenance->asset_information->assetCode }}">
                            <input type="hidden" name="asset_id" class="asset_id" value="{{ $maintenance->asset_id }}">

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
                            class="col-md-4 col-form-label text-md-end">{{ __('ครุภัณฑ์') }}</label>

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

                            @error('repair_reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @if($maintenance->asset_id)
                    <div class="row mb-3">
                        <label for="location"
                            class="col-md-4 col-form-label text-md-end">{{ __('ตำแหน่งของทรัพย์สิน') }}</label>

                        <div class="col-md-6">
                            <textarea id="location"
                                class="form-control @error('location') is-invalid @enderror"
                                name="location"
                                rows="4" autocomplete="location" required>{{ $maintenance->location }}</textarea>

                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @else
                    <div class="row mb-3">
                        <label for="location"
                            class="col-md-4 col-form-label text-md-end">{{ __('ตำแหน่งของครุภัณฑ์') }}</label>

                        <div class="col-md-6">
                            <textarea id="location"
                                class="form-control @error('location') is-invalid @enderror"
                                name="location"
                                rows="4" autocomplete="location" required>{{ $maintenance->location }}</textarea>

                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <label for="presenter"
                            class="col-md-4 col-form-label text-md-end">{{ __('ผู้แจ้งซ่อม') }}</label>

                        <div class="col-md-6">
                            <input type="text"
                                class="form-control readonly-field bg-light"
                                value="{{ $maintenance->presenterUser->name }}"
                                readonly>

                            <input type="hidden" name="presenter" value="{{ $maintenance->presenter }}">

                            @error('presenter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @elseif($maintenance->status == 'processing' || 'approved' || 'rejected' || 'finished')

                    @if(!empty($maintenance->images) && is_array($maintenance->images))
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @foreach($maintenance->images as $img)
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="d-flex justify-content-center align-items-center mt-3"
                                        style="width: 100%; height: 200px; margin:auto;">
                                        <img src="{{ asset('storage/'.$img) }}" class="card-img-top"
                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
                                    <input type="text" name="presenter" class="form-control" value="{{ $maintenance->presenterUser->name }}" disabled />
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
                                <label class="col-md-4 col-form-label text-md-end">วันที่ดำเนินการ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="process_date" class="form-control" value="{{ $maintenance->process_date_formatted }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">ผู้อนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approver" class="form-control" value="{{ $maintenance->approverUser->name }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status == 'approved')
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่อนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ $maintenance->approv_date_formatted }}" disabled />
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
                                <label class="col-md-4 col-form-label text-md-end">วันที่อนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ $maintenance->approv_date_formatted }}" disabled />
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

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group row mb-0">
                                <label class="col-md-3 col-form-label text-md-end">สาเหตุที่ไม่ผ่านการอนุมัติ :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="note" rows="2" disabled>{{ $maintenance->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status == 'finished')
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label class="col-md-4 col-form-label text-md-end">วันที่อนุมัติ :</label>
                                <div class="col-md-8">
                                    <input type="text" name="approv_date" class="form-control" value="{{ $maintenance->approv_date_formatted }}" disabled />
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
                                    <input type="text" name="result_date" class="form-control" value="{{ $maintenance->result_date_formatted }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($maintenance->status !== 'pending')

                    <div class="row mt-3">
                        @if($maintenance->asset_id)
                        <div class="col-12">
                            <div class="form-group row mb-0">
                                <label class="col-md-3 col-form-label text-md-end">ตำแหน่งของทรัพย์สิน :</label>
                                <div class="col-md-9">
                                    <input type="text" name="location" class="form-control" value="{{ $maintenance->location }}" disabled />
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12">
                            <div class="form-group row mb-0">
                                <label class="col-md-3 col-form-label text-md-end">ตำแหน่งของครุภัณฑ์ :</label>
                                <div class="col-md-9">
                                    <input type="text" name="location" class="form-control" value="{{ $maintenance->location }}" disabled />
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>

                    @endif

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @if($maintenance->status == 'pending')
                            <button type="button" id="btnUpdateMaintenance" class="btn btn-primary">
                                แก้ไขข้อมูล
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
    .modalEditMain .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalEditMain .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    #existingImages {
        gap: 10px;
    }

    .existing-image {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .existing-image img {
        display: block;
        object-fit: cover;
        border-radius: 4px;
    }

    .existing-image .remove-image {
        top: 2px;
        right: 2px;
        padding: 0 6px;
    }

    .swal2-container {
        z-index: 2000 !important;
    }
</style>