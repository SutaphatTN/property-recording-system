@extends('layouts.app')
@section('title', 'Receiving Information')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0">ข้อมูลการรับรถเข้าคลัง</h2>
        @auth
            @if (Auth::user()->is_admin)
                <a href="/create_rec" class="btn btn-primary">เพิ่มข้อมูล</a>
            @endif
        @endauth
    </div>

    <table class="table table-bordered text-center mt-3">
        <thead>
            <tr>
                <th scope="col">ชื่อรุ่น</th>
                <th scope="col">เลขถังรถ</th>
                <th scope="col">เลขเครื่องยนต์รถ</th>
                <th scope="col">สี</th>
                <th scope="col">บริษัทส่งรถ</th>
                <th scope="col">บริษัทรับรถ</th>
                <th scope="col">ราคาทุน</th>
                <th scope="col">ราคาขาย</th>
                @auth
                    @if (Auth::user()->is_admin)
                        <th scope="col">สถานะ</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody id="receivingList"></tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadRecs() {
            $.get('{{ route('list_rec.data') }}', function(data) {
                let html = '';
                data.forEach(function(rec) {
                    html += `
                    <tr data-id="${rec.id}">
                        <td>${rec.model_name}</td>
                        <td>${rec.tank_number}</td>
                        <td>${rec.machine_number}</td>
                        <td>${rec.color}</td>
                        <td>${rec.receiving_company}</td>
                        <td>${rec.sending_company}</td>
                        <td>${rec.cost_price}</td>
                        <td>${rec.sell_price}</td>
                        @auth
                        @if (Auth::user()->is_admin)
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="/edit_rec/${rec.id}" class="btn btn-warning">แก้ไข</a>
                                <a href="#" class="btn btn-danger delete-btn" data-id="${rec.id}">ลบ</a>
                            </div>
                        </td>
                        @endif
                        @endauth
                    </tr>
                `;
                });
                $('#receivingList').html(html);
            });
        }

        loadRecs();

        $('#receivingList').on('click', '.btn-delete', function() {
            const id = $(this).data('id');

            if (confirm(`คุณต้องการลบข้อมูลรถใช่หรือไม่ ?`)) {
                $.ajax({
                    url: `/delete_rec/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('ลบสำเร็จ');
                            loadRecs();
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
