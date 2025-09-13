$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.btnOpenViewModal', function () {
    const id = $(this).data('id');

    $.get("/assetData/" + id + "/view-more", function (html) {
        $('#containerView').html(html);
        $('.modalViewAsset').modal('show');
    });
});

$(document).on('click', '.btnOpenStoreModal', function () {
    $.get("/assetData/create", function (html) {
        $('#containerStore').html(html);
        $('.modalStoreAsset').modal('show');
    });
});

$(document).on('click', '.btnOpenStoreAssetModal', function () {
    $.get("/assetData/createAsset", function (html) {
        $('#containerStoreAsset').html(html);
        $('.modalStoreAssetGen').modal('show');
    });
});

$(document).on('click', '.btnOpenEditModal', function () {
    const id = $(this).data('id');

    $.get("/assetData/" + id + "/edit", function (html) {
        $('#containerEdit').html(html);
        $('.modalEditAsset').modal('show');
    });
});

$(document).on('click', '.btnOpenPrintAll', function () {
    $.get("/assetData/print-all", function (html) {
        $('#containerPrintAll').html(html);
        $('.modalPrintAll').modal('show');
    });
});

$(document).on('click', '.btnOpenExcel', function () {
    $.get("/assetData/excel", function (html) {
        $('#containerExcel').html(html);
        $('.modalExcel').modal('show');
    });
});

$(document).on('change', '.company-select', function () {
    let companyId = $(this).val();

    let form = $(this).closest('form, .modal');
    let departmentSelect = form.find('.department-select');
    let branchSelect = form.find('.branch-select');

    departmentSelect.empty().append('<option value="">-- เลือกแผนก --</option>');
    branchSelect.empty().append('<option value="">-- เลือกสาขา --</option>');

    if (companyId) {
        $.get('/company/' + companyId, function (data) {
            if (data.branches.length > 0) {
                data.branches.forEach(function (branch) {
                    branchSelect.append('<option value="' + branch.id + '">' + branch.branch_name + '</option>');
                });
            }

            if (data.departments.length > 0) {
                data.departments.forEach(function (dept) {
                    departmentSelect.append('<option value="' + dept.id + '">' + dept.department_name + '</option>');
                });
            }
        });
    }
});

$(document).on('click', '.btn-deleteAsset', function () {
    const id = $(this).data('id');

    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6c5ffc',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/assetData/" + id,
                type: 'DELETE',
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: true
                        });
                        reloadAsset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบข้อมูลได้',
                        });
                    }
                },
                error: function (xhr) {
                    let errMsg = 'ไม่สามารถลบข้อมูลได้';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: errMsg,
                    });
                }
            });
        }
    });
});

$(document).on('input', '#purchase_price', function () {
    let value = this.value.replace(/,/g, '');
    if (isNaN(value)) {
        this.value = '';
        return;
    }
    this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
});

$(document).on('click', '#btnUpdateAsset', function () {
    const $btn = $(this);
    const form = $btn.closest('form')[0];

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const url = $(form).attr('action');
    const formData = new FormData(form);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('.modalEditAsset').modal('hide');

            Swal.fire({
                title: 'กำลังบันทึกข้อมูล...',
                text: 'กรุณารอสักครู่',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $btn.prop('disabled', true);
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });

            if ($btn.closest('.modalEditAsset').length) {
                reloadAsset();
            }

        },
        error: function (xhr) {
            let errMsg = 'ไม่สามารถแก้ไขข้อมูลได้';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errMsg = xhr.responseJSON.message;
            }
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: errMsg,
            });
            $('.modalEditAsset').modal('hide');
        },
        complete: function () {
            $btn.prop('disabled', false).text('แก้ไขข้อมูล');
        }
    });
});

$(document).on('click', '#btnSaveAsset', function () {
    const $btn = $(this);
    const form = $btn.closest('form')[0];

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const url = $(form).attr('action');
    const formData = new FormData(form);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('.modalStoreAsset, .modalStoreAssetGen').modal('hide');

            Swal.fire({
                title: 'กำลังบันทึกข้อมูล...',
                text: 'กรุณารอสักครู่',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $btn.prop('disabled', true);
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });

            if ($btn.closest('.modalStoreAsset, .modalStoreAssetGen').length) {
                reloadAsset();
            }

        },
        error: function (xhr) {
            let errMsg = 'ไม่สามารถบันทึกข้อมูลได้';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errMsg = xhr.responseJSON.message;
            }
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: errMsg,
            });
            $('.modalStoreAsset, .modalStoreAssetGen').modal('hide');
        },
        complete: function () {
            $btn.prop('disabled', false).text('บันทึก');
        }
    });
});

function reloadAsset() {
    $.get("/assetData", function (html) {
        $('#contentArea').html(html);
        initAssetTable();
    });
}

function initAssetTable() {
    if ($.fn.DataTable.isDataTable('#assetViewTable')) {
        $('#assetViewTable').DataTable().destroy();
    }

    $('#assetViewTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        pageLength: 10,
        language: {
            lengthMenu: "แสดง _MENU_ แถว",
            zeroRecords: "ไม่พบข้อมูล",
            info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            infoEmpty: "ไม่มีข้อมูล",
            search: "ค้นหา:",
            paginate: {
                first: "หน้าแรก",
                last: "หน้าสุดท้าย",
                next: "ถัดไป",
                previous: "ก่อนหน้า"
            }
        }
    });
}

$(document).ready(function () {
    if ($('#assetViewTable').length) {
        initAssetTable();
    }
});

$(document).on('submit', '#formPrintAll', function (e) {
    e.preventDefault();
    var form = $(this);
    var errorDiv = $('#printAllError');
    errorDiv.addClass('d-none').text('');

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        xhrFields: { responseType: 'blob' },
        success: function (data, status, xhr) {
            var contentType = xhr.getResponseHeader('Content-Type');
            if (contentType === 'application/pdf') {
                var blob = new Blob([data], { type: 'application/pdf' });
                var url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            } else {
                var reader = new FileReader();
                reader.onload = function () {
                    var json = JSON.parse(reader.result);
                    errorDiv.removeClass('d-none').text(json.message);
                };
                reader.readAsText(data);
            }
        },
        error: function () {
            errorDiv.removeClass('d-none').text('ไม่พบข้อมูลทรัพย์สิน ตามวันเดือนปีที่คุณเลือก กรุณาลองใหม่');
        }
    });
});
