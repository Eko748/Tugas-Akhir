@extends('main')
@section('title')
    {{ $parent }} {{ $child }}
@endsection
@section('css')
@endsection
@section('content')
    @include('pages.review.category.springer.content.springer')
@endsection
@push('js')
    @include('pages.review.components.springer-js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-tab.js') }}"></script>
    <script src="{{ asset('assets/js/crypto-js/crypto-js.js') }}"></script>
@endpush
