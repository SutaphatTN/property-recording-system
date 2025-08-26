@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <img src="{{ asset('images/Mitsubishi_logo.png') }}" alt="Logo"
                style="height: 300px; width: auto; margin-right: 10px; margin-bottom: 5%">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ผู้ใช้งาน') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('ยินดีต้อนรับ คุณ :name สู่ระบบจัดการทรัพย์สินบริษัท', ['name' => Auth::user()->name]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
