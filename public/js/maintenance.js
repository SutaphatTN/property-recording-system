$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.btnOpenStoreGeneralMainModal', function () {
    $.get("/maintenance/create/general", function (html) {
        $('#containerStoreGeneralMain').html(html);
        $('.modalStoreGeneralMain').modal('show');
    });
});

$(document).on('click', '.btnOpenApproveMainModal', function () {
    const id = $(this).data('id');

    $.get("/maintenance/" + id + "/view-approve", function (html) {
        $('#containerApproveMain').html(html);
        $('.modalApproveMain').modal('show');
    });
});

$(document).on('click', '.btnOpenEditMainModal', function () {
    const id = $(this).data('id');

    $.get("/maintenance/" + id + "/edit", function (html) {
        $('#containerEditMain').html(html);
        const $modal = $('.modalEditMain');
        $modal.modal('show');

        $modal.on('shown.bs.modal', function () {
            initAssetAutocomplete($modal);
        });
    });
});

$(document).on('click', '.btnOpenAuditMainModal', function () {
    const id = $(this).data('id');

    $.get("/maintenance/" + id + "/edit-audit", function (html) {
        $('#containerAuditMain').html(html);
        const $modal = $('.modalAuditMain');
        $modal.modal('show');

        $modal.on('shown.bs.modal', function () {
            initAssetAutocomplete($modal);
        });
    });
});

$(document).on('click', '.btnOpenViewMoreApp', function () {
    const id = $(this).data('id');

    $.get("/maintenance/" + id + "/view-moreApproval", function (html) {
        $('#containerViewMoreApp').html(html);
        $('.modalViewMoreApp').modal('show');
    });
});

$(document).on('submit', '#searchForm', function (e) {
    e.preventDefault();

    let url = $(this).attr('action');
    let data = $(this).serialize();

    $.get(url, data, function (html) {
        let newTable = $(html).find('#maintenanceTable').html();
        $('#maintenanceTable').html(newTable);
    });
});

$(document).on('click', '.btnOpenStoreMainModal', function () {
    $.get("/maintenance/create", function (html) {
        $('#containerStoreMain').html(html);
        const $modal = $('.modalStoreMain');
        $modal.modal('show');

        $modal.on('shown.bs.modal', function () {
            initAssetAutocomplete($modal);
        });
    });
});

function initAssetAutocomplete($modal) {
    var cache = {};

    $(".asset_search", $modal).autocomplete({
        minLength: 1,
        delay: 100,
        appendTo: $modal,
        source: function (request, response) {
            if (request.term in cache) {
                showResults(cache[request.term], response);
                return;
            }
            $.ajax({
                url: "/maintenance/search",
                dataType: "json",
                data: { term: request.term },
                success: function (data) {
                    cache[request.term] = data;
                    showResults(data, response);
                },
                error: function (err) {
                    console.error("Autocomplete error:", err);
                    showResults([], response);
                }
            });
        },
        select: function (event, ui) {
            if (ui.item.id) {
                $(".asset_id", $modal).val(ui.item.id);
            } else {
                $(".asset_id", $modal).val('');
                event.preventDefault();
            }
        },
        change: function (event, ui) {
            if (!ui.item) {
                $(this).val('');
                $(".asset_id", $modal).val('');
            }
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        let li = $("<li>").append("<div>" + item.label + "</div>");

        if (item.disabled) {
            li.addClass("ui-state-disabled");
        }
        return li.appendTo(ul);
    };

    function showResults(data, response) {
        if (!data || data.length === 0) {
            response([{
                label: 'ไม่มีข้อมูลทรัพย์สิน',
                value: '',
                id: null,
                disabled: true,
            }]);
        } else {
            response(data);
        }
    }
}

$(document).on('click', '.btn-deleteMaintenance', function () {
    const id = $(this).data('id');

    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/maintenance/" + id,
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
                        reloadMaintenance();
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

$(document).on('input', '#repair_price', function () {
    let value = this.value.replace(/,/g, '');
    if (isNaN(value)) {
        this.value = '';
        return;
    }
    this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});

$(document).on('click', '#btnApproveMaintenance', function () {
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
            $btn.prop('disabled', true).text('กำลังอนุมัติ...');
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });

            $('.modalApproveMain').modal('hide');
            reloadMaintenance();
        },
        error: function (xhr) {
            let errMsg = 'ไม่สามารถอนุมัติข้อมูลได้';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errMsg = xhr.responseJSON.message;
            }
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: errMsg,
            });
        },
        complete: function () {
            $btn.prop('disabled', false).text('อนุมัติ');
        }
    });
});

$(document).on('click', '#btnUpdateMaintenance', function () {
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
            $btn.prop('disabled', true).text('กำลังบันทึก...');
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });

            $('.modalEditMain, .modalAuditMain').modal('hide');

            if ($btn.closest('.modalEditMain').length) {
                reloadMaintenance();
            }

            if ($btn.closest('.modalAuditMain').length) {
                reloadMaintenanceAudit();
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
        },
        complete: function () {
            $btn.prop('disabled', false).text('บันทึกข้อมูล');
        }
    });
});

$(document).on('click', '#btnSaveMaintenance', function () {
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
            $btn.prop('disabled', true).text('กำลังบันทึก...');
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });

            $('.modalStoreMain, .modalStoreGeneralMain').modal('hide');
            reloadMaintenance();
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
        },
        complete: function () {
            $btn.prop('disabled', false).text('บันทึก');
        }
    });
});

$(document).on('click', '.btn-approve', function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'ยืนยันการอนุมัติ?',
        text: "คุณต้องการอนุมัติรายการนี้ใช่หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, อนุมัติ',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/maintenance/" + id + "/approve",
                type: 'PUT',
                success: function (res) {
                    Swal.fire('สำเร็จ', res.message, 'success');
                    reloadMaintenanceApprove();
                },
                error: function () {
                    Swal.fire('ผิดพลาด', 'ไม่สามารถอนุมัติได้', 'error');
                }
            });
        }
    });
});

$(document).on('click', '.btn-reject', function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'ยืนยันไม่อนุมัติ?',
        text: "คุณต้องการไม่อนุมัติรายการนี้ใช่หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ไม่อนุมัติ',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/maintenance/" + id + "/reject",
                type: 'PUT',
                success: function (res) {
                    Swal.fire('สำเร็จ', res.message, 'success');
                    reloadMaintenanceApprove();
                },
                error: function () {
                    Swal.fire('ผิดพลาด', 'ไม่สามารถไม่อนุมัติได้', 'error');
                }
            });
        }
    });
});

$(document).on('click', '#btnFinishMaintenance', function () {
    const $btn = $(this);
    const id = $(this).data('id');
    const url = "/maintenance/" + id + "/finish";

    $.ajax({
        url: url,
        type: 'POST',
        beforeSend: function () {
            $btn.prop('disabled', true).text('กำลังบันทึก...');
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: res.message,
                timer: 2000,
                showConfirmButton: true
            });
            $('.modalEditMain').modal('hide');
            reloadMaintenance();
        },
        error: function (xhr) {
            Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถบันทึกได้', 'error');
        },
        complete: function () {
            $btn.prop('disabled', false).text('เสร็จแล้ว');
        }
    });
});

function reloadMaintenance() {
    $.get("/maintenance", function (html) {
        let newContent = $(html).find('#contentArea').html();
        $('#contentArea').html(newContent);
        initMainTable();
    });
}

function reloadMaintenanceAudit() {
    $.get("/maintenance/view-audit", function (html) {
        let newContent = $(html).find('#contentArea').html();
        $('#contentArea').html(newContent);
        initMainAuditTable();
    });
}

function reloadMaintenanceApprove() {
    $.get("/maintenance/view-approval", function (html) {
        let newContent = $(html).find('#contentArea').html();
        $('#contentArea').html(newContent);
        initMainApproveTable();
    });
}

function initMainTable() {
    if ($.fn.DataTable.isDataTable('#mainViewTable')) {
        $('#mainViewTable').DataTable().destroy();
    }

    $('#mainViewTable').DataTable({
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

function initMainAuditTable() {
    if ($.fn.DataTable.isDataTable('#mainViewAuditTable')) {
        $('#mainViewAuditTable').DataTable().destroy();
    }

    $('#mainViewAuditTable').DataTable({
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

function initMainApproveTable() {
    if ($.fn.DataTable.isDataTable('#mainViewApproveTable')) {
        $('#mainViewApproveTable').DataTable().destroy();
    }

    $('#mainViewApproveTable').DataTable({
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

function initMainResultTable() {
    if ($.fn.DataTable.isDataTable('#mainViewResultTable')) {
        $('#mainViewResultTable').DataTable().destroy();
    }

    $('#mainViewResultTable').DataTable({
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