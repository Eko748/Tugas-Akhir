@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
    <style>
        @media only screen and (max-width: 767px) {
            .scrap-data {
                display: none;
            }
        }
    </style>
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/select2.css"> --}}
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.min.css') }}">


    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/range-slider.css"> --}}
@endsection
@include('pages.review.ieee.content.ieee')

@push('js')
    @include('pages.review.ieee.content.js.1-data-js')
    {{-- @include('pages.review.ieee.content.js.5-scrapy-js') --}}

    <!-- Plugins JS start-->
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
    <script src="../assets/js/clipboard/clipboard.min.js"></script>
    <script src="../assets/js/clipboard/clipboard-script.js"></script>
    <!-- Plugins JS Ends-->
@endpush
@endsection
