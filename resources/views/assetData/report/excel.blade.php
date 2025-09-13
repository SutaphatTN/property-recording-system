<div class="modal fade modalExcel" id="modal-4" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-info">
                    <div class="card-header text-white text-center" style="font-size: 1.3rem; font-weight: bold;">
                        ข้อมูลทรัพย์สินประจำเดือน
                    </div>
                </div>
            </div>
            <div class="modal-body text-sm">
                <form action="{{ route('assetData.printExcel') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                                <div class="col-sm-8">
                                    <input type="date" id="from_date" name="from_date" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                                <div class="col-sm-8">
                                    <input type="date" id="to_date" name="to_date" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn bg-info text-white" style="margin-right: 3px;">
                            <i class="bx bx-printer"></i>&nbsp;Print
                        </button>
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> ยกเลิก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>