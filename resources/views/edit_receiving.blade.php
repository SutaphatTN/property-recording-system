@extends('layouts.app')
@section('title', 'Edit Receiving Information')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('แก้ไขข้อมูลการรับรถเข้าคลัง') }}</div>

                    <div class="card-body">
                        <form id="editRec" method="POST" action="{{ route('update_rec', $listR->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="model_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ชื่อรุ่น') }}</label>

                                <div class="col-md-6">
                                    <input id="model_name" type="text"
                                        class="form-control @error('model_name') is-invalid @enderror" name="model_name"
                                        value="{{$listR->model_name}}" required autocomplete="model_name" autofocus>

                                    @error('model_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tank_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('เลขถังรถ') }}</label>

                                <div class="col-md-6">
                                    <input id="tank_number" type="text"
                                        class="form-control @error('tank_number') is-invalid @enderror" name="tank_number"
                                        value="{{$listR->tank_number}}" required autocomplete="tank_number">

                                    @error('tank_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="machine_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('เลขเครื่องยนต์รถ') }}</label>

                                <div class="col-md-6">
                                    <input id="machine_number" type="text"
                                        class="form-control @error('machine_number') is-invalid @enderror"
                                        name="machine_number" value="{{$listR->machine_number}}" required autocomplete="machine_number">

                                    @error('machine_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="color"
                                    class="col-md-4 col-form-label text-md-end">{{ __('สีรถ') }}</label>

                                <div class="col-md-6">
                                    <input id="color" type="text"
                                        class="form-control @error('color') is-invalid @enderror" name="color"
                                        value="{{$listR->color}}" required autocomplete="color">

                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="receiving_company"
                                    class="col-md-4 col-form-label text-md-end">{{ __('บริษัทส่งรถ') }}</label>

                                <div class="col-md-6">
                                    <input id="receiving_company" type="text"
                                        class="form-control @error('receiving_company') is-invalid @enderror"
                                        name="receiving_company" value="{{$listR->receiving_company}}" required autocomplete="receiving_company">

                                    @error('receiving_company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sending_company"
                                    class="col-md-4 col-form-label text-md-end">{{ __('บริษัทรับรถ') }}</label>

                                <div class="col-md-6">
                                    <input id="sending_company" type="text"
                                        class="form-control @error('sending_company') is-invalid @enderror"
                                        name="sending_company" value="{{$listR->sending_company}}" required autocomplete="sending_company">

                                    @error('sending_company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cost_price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ราคาทุน') }}</label>

                                <div class="col-md-6">
                                    <input id="cost_price" type="text"
                                        class="form-control @error('cost_price') is-invalid @enderror" name="cost_price"
                                        value="{{$listR->cost_price}}" required autocomplete="cost_price">

                                    @error('cost_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sell_price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ราคาขาย') }}</label>

                                <div class="col-md-6">
                                    <input id="sell_price" type="text"
                                        class="form-control @error('sell_price') is-invalid @enderror" name="sell_price"
                                        value="{{$listR->sell_price}}" required autocomplete="sell_price">

                                    @error('sell_price')
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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#editRec').submit(function(e) {
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
                    window.location.href = '/list_rec';
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