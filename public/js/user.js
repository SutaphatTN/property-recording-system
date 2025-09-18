$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.btnViewMoreUser', function () {
    const id = $(this).data('id');

    $.get("/user/" + id + "/view-more", function (html) {
        $('#containerViewMoreUser').html(html);
        $('.modalViewMoreUser').modal('show');
    });
});

$(document).on('click', '.btnOpenEditUser', function () {
    const id = $(this).data('id');

    $.get("/user/" + id + "/edit", function (html) {
        $('#containerEditUser').html(html);
        $('.modalEditUser').modal('show');
    });
});

$(document).on('click', '.btnDeleteUser', function () {
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
                url: "/user/" + id,
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

$(document).on('click', '#btnUpdateUser', function () {
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
            $('.modalEditUser').modal('hide');

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

            if ($btn.closest('.modalEditUser').length) {
                reloadUser();
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
            $('.modalEditUser').modal('hide');
        },
        complete: function () {
            $btn.prop('disabled', false);
        }
    });
});

function reloadUser() {
    $.get("/user", function (html) {
        $('#contentArea').html(html);
        initUserTable();
    });
}

function initUserTable() {
    if ($.fn.DataTable.isDataTable('#userViewTable')) {
        $('#userViewTable').DataTable().destroy();
    }

    $('#userViewTable').DataTable({
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