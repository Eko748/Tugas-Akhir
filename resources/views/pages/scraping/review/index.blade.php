@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection


@section('css')
    <style>
        @media only screen and (max-width: 767px) {
            .scrap-data {
                display: none;
            }
        }

        .loading-container {
            position: relative;
            display: inline-block;
        }

        .magnifying-glass {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .magnifying-glass:before {
            content: "";
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .magnifying-glass:after {
            content: "";
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            top: 70%;
            left: 70%;
            transform: translate(-50%, -50%);
        }

        .loading {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/select2.css"> --}}
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/owlcarousel.css">
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/range-slider.css"> --}}
@endsection
@section('content')
    @include('pages.scraping.review.content.review')

    @push('js')
        @include('pages.scraping.review.content.js.data-js')
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/osmosis/index.js') }}"></script> --}}

        {{-- <script src="../assets/js/scrollbar/simplebar.js"></script>
    <script src="../assets/js/scrollbar/custom.js"></script> --}}
        <script src="../assets/js/range-slider/ion.rangeSlider.min.js"></script>
        <script src="../assets/js/range-slider/rangeslider-script.js"></script>
        <script src="../assets/js/touchspin/vendors.min.js"></script>
        <script src="../assets/js/touchspin/touchspin.js"></script>
        <script src="../assets/js/touchspin/input-groups.min.js"></script>
        <script src="../assets/js/owlcarousel/owl.carousel.js"></script>
        <script src="../assets/js/select2/select2.full.min.js"></script>
        <script src="../assets/js/select2/select2-custom.js"></script>
        <script src="../assets/js/product-tab.js"></script>
        <!-- Plugins JS Ends-->
        {{-- @include('pages.scraping.content.js.home-js')
@include('pages.scraping.content.js.osmosis') --}}
    @endpush
@endsection
