@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
@include('pages.review.category.ieee.content.ieee')

@push('js')
    @include('pages.review.components.ieee-js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/range-slider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/range-slider/rangeslider-script.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/product-tab.js') }}"></script>
@endpush
@endsection
