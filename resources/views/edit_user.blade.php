@extends('layouts.app')
@section('title', 'Edit User Information')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('แก้ไขข้อมูลผู้ใช้งาน') }}</div>

                    <div class="card-body">
                        <form id="editUserForm" method="POST" action="{{ route('update_user', $listU->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ชื่อผู้ใช้') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $listU->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('อีเมล') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $listU->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('แก้ไขข้อมูล') }}
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">
                                        {{ __('ยกเลิก') }}
                                    </a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#editUserForm').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let formData = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = '/list_user';
                } else {
                    alert('เกิดข้อผิดพลาด');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                if (errors) {
                    $.each(errors, function(key, value) {
                        errorMessages += value + '\n';
                    });
                } else {
                    errorMessages = 'เกิดข้อผิดพลาด ไม่ทราบสาเหตุ';
                }
                alert(errorMessages);
            }
        });
    });
});
</script>

@endsection