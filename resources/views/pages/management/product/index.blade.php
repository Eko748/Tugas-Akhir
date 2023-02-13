@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
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
        <script>
            fetch('/management/product')
                .then(response => response.json())
                .then(data => {
                    const filteredData = data.filter(d => d.publisher === 'publisher');
                    document.getElementById('#publisher-data').innerHTML = JSON.stringify(filteredData);
                });
        </script>
    @endpush
@endsection
