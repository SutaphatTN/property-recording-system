@extends('layouts.app')
@section('title', 'Add Maintenance From QrCode')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('แจ้งซ่อมทรัพย์สิน') }}</div>

                <div class="card-body">
                    <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="images"
                                class="col-md-4 col-form-label text-md-end">{{ __('รูปทรัพย์สิน') }}</label>

                            <div class="col-md-6">
                                <input id="imagesMain" type="file"
                                    class="form-control @error('images') is-invalid @enderror"
                                    name="images[]" multiple required accept="image/*">

                                <small class="text-muted">แนบรูปอย่างน้อย 1 รูป แนบได้สูงสุด 3 รูป</small>

                                @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="asset_id" value="{{ $asset->id }}">

                        <div class="row mb-3">
                            <label for="asset_code" class="col-md-4 col-form-label text-md-end">{{ __('Asset Code') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="asset_code" class="form-control" value="{{ $asset->assetCode }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="repair_date"
                                class="col-md-4 col-form-label text-md-end">{{ __('วันที่แจ้งซ่อม') }}</label>

                            <div class="col-md-6">
                                <input id="repair_date" type="date"
                                    class="form-control @error('repair_date') is-invalid @enderror"
                                    name="repair_date" max="{{ date('Y-m-d') }}" value="" required autocomplete="repair_date">

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
                                    rows="4" required autocomplete="repair_reason">{{ old('repair_reason') }}</textarea>


                                @error('repair_reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="presenter"
                                class="col-md-4 col-form-label text-md-end">{{ __('ผู้แจ้ง') }}</label>

                            <div class="col-md-6">
                                <input id="presenter"
                                    type="text"
                                    class="form-control readonly-field bg-light"
                                    name="presenter"
                                    value="{{ Auth::user()->name }}"
                                    readonly>

                                @error('presenter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="btnSaveMaintenance" class="btn btn-primary">บันทึก</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .swal2-container {
        z-index: 2000 !important;
    }
</style>
@endsection