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
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>

@endpush
@endsection
