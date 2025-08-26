@extends('layouts.app')
@section('title', 'Asset Information')

@section('content')
<div class="container">
    <h2>ข้อมูลทรัพย์สิน</h2>
    <div class="row align-items-center">
        <div class="col-md-3 text-center mb-3">
            <img src="{{ asset('storage/'.$asset->qrCode) }}"
                alt="QR Code"
                class="img-fluid"
                style="max-width: 150px;">
        </div>

        <div class="col-md-9">
            <h5><b>Asset Code :</b> {{ $asset->assetCode }}</h5>
            <h5><b>Asset Name :</b> {{ $asset->assetName }}</h5>
            <h5><b>รายละเอียด :</b> {{ $asset->detail_property }}</h5>
            <h5><b>วันที่ซื้อ :</b> {{ $asset->purchase_date }}</h5>
            <h5><b>วันที่หมดประกัน :</b> {{ $asset->expiration_date }}</h5>
        </div>
    </div>
</div>
@endsection

