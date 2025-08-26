<div class="modal fade modalExcel" id="modal-4" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-info">
                    <div class="card-header">
                        <b>ข้อมูลทรัพย์สินประจำเดือน</b>
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
                                    <input type="date" id="from_date" name="from_date" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                                <div class="col-sm-8">
                                    <input type="date" id="to_date" name="to_date" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="text-center gap-2">
                        <button type="submit" class="btn bg-info">
                            <i class="bi bi-printer"></i> print
                        </button>
                        <button type="button" class="btn bg-danger" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> ยกเลิก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>