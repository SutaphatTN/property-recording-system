@extends('layouts.app')
@section('content')
<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0 text-center" style="border-radius: 20px; min-height: 70vh;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/home_dash.png') }}" 
                         alt="Logo" 
                         style="width: 500px; height: auto;">

                    <h2 class="mt-4 fw-bold text-secondary">
                        Welcome to Property Recording System
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection