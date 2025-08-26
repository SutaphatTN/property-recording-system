<div class="modal fade modalViewAsset" tabindex="-1" aria-labelledby="modalViewAssetLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewAssetLabel">
                    ข้อมูลทรัพย์สิน Asset Code : {{ $asset->assetCode }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- ใช้ modal-body ครอบแทน -->
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <b>รายละเอียด</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="d-flex justify-content-center align-items-center mt-3"
                                        style="width: 200px; height: 200px; margin:auto;">
                                        <img src="{{ asset('storage/'.$asset->images) }}"
                                            class="card-img-top"
                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>

                                    <div class="card-body">
                                        <p class="card-text text-center">รูปทรัพย์สิน</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="d-flex justify-content-center align-items-center mt-3"
                                        style="width: 200px; height: 200px; margin:auto;">
                                        <img src="{{ asset('storage/'.$asset->qrCode) }}"
                                            class="card-img-top"
                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center">Qr Code</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
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
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">บริษัท :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="company_id" class="form-control" value="{{ $asset->company->company_name }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">แผนกผู้รับผิดชอบ :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="department_id" class="form-control" value="{{ $asset->department->department_name }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">สาขา :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="branch_id" class="form-control" value="{{ $asset->branch->branch_name }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">ตำแหน่งรับผิดชอบ :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="position_id" class="form-control" value="{{ $asset->position->position_name }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">location ย่อย :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="location_sub" class="form-control" value="{{ $asset->location_sub }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">ราคา :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="purchase_price" class="form-control" value="{{ number_format($asset->purchase_price, 2) }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">วันที่ซื้อ :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="purchase_date" class="form-control" value="{{ \Carbon\Carbon::parse($asset->purchase_date)->format('d/m/Y') }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">วันที่หมดอายุประกัน :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="expiration_date" class="form-control" value="{{ \Carbon\Carbon::parse($asset->expiration_date)->format('d/m/Y') }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">สถานะ :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="status" class="form-control" value="{{ $asset->status }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">สถานะทรัพย์สิน :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="asset_status" class="form-control" value="{{ $asset->asset_status }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">รายละเอียดทรัพย์สิน :</label>
                                    <div class="col-md-8">
                                        <textarea name="detail_property"
                                            class="form-control"
                                            disabled>{{ $asset->detail_property }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">สาเหตุ :</label>
                                    <div class="col-md-8">
                                        <textarea name="purchase_reason"
                                            class="form-control"
                                            disabled>{{ $asset->purchase_reason }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-end">ผู้แจ้งซื้อ :</label>
                                    <div class="col-md-8">
                                        <input type="text" name="presenter" class="form-control" value="{{ $asset->presenter }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <b>ประวัติการซ่อม</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-center">วันที่ซ่อมเสร็จ</th>
                                    <th class="text-center">ราคา</th>
                                    <th class="text-center">สาเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($maintenances as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($row->result_date)->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ number_format($row->repair_price, 2) }}</td>
                                    <td class="text-center">{{ $row->repair_reason }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">ไม่มีประวัติการซ่อม</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>