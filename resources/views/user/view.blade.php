<div id="contentArea">
    <div id="containerEditUser"></div>
    <div id="containerViewMoreUser"></div>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0 fw-bold">ข้อมูลผู้ใช้งาน</h4>
        </div>
        <div class="card-body table-responsive">
            <table id="userViewTable" class="table table-bordered text-center align-middle custom-table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Full Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Role</th>
                        <th class="text-center" width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $key => $row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->full_name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->role }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-info btn-icon btnViewMoreUser" title="ดูข้อมูล" data-id="{{ $row->id }}">
                                    <i class="bx bx-show"></i>
                                </button>
                                <button class="btn btn-warning btn-icon btnOpenEditUser" title="แก้ไข" data-id="{{ $row->id }}">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-icon btnDeleteUser" title="ลบ" data-id="{{ $row->id }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        #userViewTable_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        #contentArea .btn .bx {
            color: #fff !important;
        }
    </style>
</div>