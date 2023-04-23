@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
    <style>
        .review-go {
            display: inline-block;
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            background-color: #2ecc71;
            box-shadow: 0px 4px 0px #15a358;
            transition: all 0.3s ease-in-out;
        }

        .review-go:hover {
            background-color: #27ae60;
            box-shadow: 0px 2px 0px #15a358;
            transform: translateY(2px);
        }
    </style>
        <link rel="stylesheet" type="text/css" href="../assets/css/vendors/owlcarousel.css">

@endsection
@include('pages.review.springer.content.springer')

@push('js')
    @include('pages.review.springer.content.js.1-data-js')
    @include('pages.review.springer.content.js.4-create-data-js')

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
@endpush
@endsection
