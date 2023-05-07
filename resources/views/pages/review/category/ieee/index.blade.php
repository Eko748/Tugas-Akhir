@extends('main')
@section('title')
    {{ $parent }} {{ $child }}
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
@section('content')
    @include('pages.review.category.ieee.content.ieee')
@endsection
@push('js')
    @include('pages.review.components.ieee-js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-tab.js') }}"></script>
    <script src="{{ asset('assets/js/crypto-js/crypto-js.js') }}"></script>
@endpush
