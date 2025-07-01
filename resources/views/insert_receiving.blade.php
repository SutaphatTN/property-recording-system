@extends('layouts.app')
@section('title', 'Add Receiving Information')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('เพิ่มข้อมูลการรับรถเข้าคลัง') }}</div>

                    <div class="card-body">
                        {{-- <form method="POST" action="/insert_rec"> --}}
                        <form id="insertRec" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="model_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ชื่อรุ่น') }}</label>

                                <div class="col-md-6">
                                    <input id="model_name" type="text"
                                        class="form-control @error('model_name') is-invalid @enderror" name="model_name"
                                        value="" required autocomplete="model_name" autofocus>

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
                                        value="" required autocomplete="tank_number">

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
                                        name="machine_number" value="" required autocomplete="machine_number">

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
                                        value="" required autocomplete="color">

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
                                        name="receiving_company" value="" required autocomplete="receiving_company">

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
                                        name="sending_company" value="" required autocomplete="sending_company">

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
                                        value="" required autocomplete="cost_price">

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
                                        value="" required autocomplete="sell_price">

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
                                        {{ __('เพิ่มข้อมูล') }}
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
$(document).ready(function () {
    $('#insertRec').submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const form = $(this);
        const formData = form.serialize();

        $.ajax({
            url: '/insert_rec',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = '/list_rec';
                } else {
                    alert('เกิดข้อผิดพลาดในการบันทึก');
                }
            },
            error: function (xhr) {
                let errorText = 'เกิดข้อผิดพลาด';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorText = Object.values(errors).map(e => e.join('\n')).join('\n');
                }
                alert(errorText);
            }
        });
    });
});
</script>