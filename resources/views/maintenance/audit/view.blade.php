@extends('layouts.app')

@section('title', 'Property Recording System')

@section('content')

    @include('maintenance.audit.fragment', ['maintenance' => $maintenance])

@endsection