<div class="modal fade modalPrintAll" id="modal-4" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-warning">
                    <div class="card-header text-white text-center" style="font-size: 1.3rem; font-weight: bold;">
                        ข้อมูล Qr Code
                    </div>
                </div>
            </div>
            <div class="modal-body text-sm">
                <form action="{{ route('assetData.downloadPrintAll') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                                <div class="col-sm-8">
                                    <input type="date" id="Fromdate" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                                <div class="col-sm-8">
                                    <input type="date" id="Todate" name="Todate" value="{{ date('Y-m-d') }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn bg-warning text-white">
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