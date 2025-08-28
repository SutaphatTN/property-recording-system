@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-primary">404</h1>
        <h3 class="mb-3">Page Not Found ⚠️</h3>

        <a href="{{ url('/home') }}" class="btn btn-primary mt-3">Back to home</a>

        <div class="mt-4">
            <img src="{{ asset('assets/img/page-error.png') }}" 
                 alt="Error" style="max-width: 400px;">
        </div>
    </div>
</div>
@endsection
