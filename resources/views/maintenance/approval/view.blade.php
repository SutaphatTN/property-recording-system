@extends('layouts.app')

@section('title', 'Property Recording System')

@section('content')

    @include('maintenance.approval.fragment', ['maintenance' => $maintenance])

@endsection