@extends('layouts.app')
@section('title', 'User Information')
@section('content')
    <h2>ข้อมูลผู้ใช้งาน</h2>
    <table class="table table-bordered text-center mt-3">
        <thead>
            <tr>
                <th scope="col">รายชื่อ</th>
                <th scope="col">อีเมล</th>
                <th scope="col">สถานะ</th>
            </tr>
        </thead>
        <tbody id="userTableList"></tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadUsers() {
            $.get('{{ route('list_user.data') }}', function(data) {
                let html = '';
                data.forEach(function(user) {
                    html += `
                    <tr data-id="${user.id}">
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>
                            <a href="/edit_user/${user.id}" class="btn btn-warning">แก้ไข</a>
                            <a class="btn btn-danger btn-delete" data-id="${user.id}" data-name="${user.name}">ลบ</a>
                        </td>
                    </tr>
                `;
                });
                $('#userTableList').html(html);
            });
        }

        loadUsers();

        $('#userTableList').on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');

            if (confirm(`คุณต้องการลบรายชื่อ ${name} หรือไม่ ?`)) {
                $.ajax({
                    url: `/delete_user/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('ลบสำเร็จ');
                            loadUsers();
                        } else {
                            alert('ลบไม่สำเร็จ');
                        }
                    },
                    error: function() {
                        alert('เกิดข้อผิดพลาดในการลบ');
                    }
                });
            }
        });
    });
</script>
@endsection