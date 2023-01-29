@extends('auth.auth')

@section('title')
  Register
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection

@section('content')

@include('auth.pages.register.components.register')

@push('js')
<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
@endpush

@endsection