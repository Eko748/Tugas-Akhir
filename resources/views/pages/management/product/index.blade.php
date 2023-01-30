@extends('main')

@section('title')
  Management Product
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')

@include('pages.management.product.content.product')



@push('js')
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/css/vendors/select2/dist/js/select2.min.js') }}"></script>
<!-- Plugins JS start-->
@include('pages.management.product.js.product-js')
@include('pages.management.product.js.getUser-js')
<!-- Plugins JS Ends-->
@endpush
@endsection
