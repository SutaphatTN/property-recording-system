<div class="modal fade modalStoreGeneralMain" tabindex="-1" aria-labelledby="modalStoreGeneralMainLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStoreGeneralMainLabel">แจ้งซ่อมทั่วไป</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createFormMain" action="{{ route('maintenance.storeGeneral') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="repair_name"
                            class="col-md-4 col-form-label text-md-end">{{ __('อุปกรณ์ / สิ่งของ ที่ต้องการซ่อม') }}</label>

                        <div class="col-md-6">
                            <input id="repair_name"
                                type="text"
                                class="form-control"
                                name="repair_name"
                                value="">

                            @error('repair_name')
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
                                class="form-control readonly-field"
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

<style>
    .modalStoreGeneralMain .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalStoreGeneralMain .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>