@extends('main')
@section('title')
    {{ $parent }} {{ $child }}
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    @include('pages.management.project.content.project')
@endsection
@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/crypto-js/crypto-js.js') }}"></script>
    @include('pages.management.project.content.js.1-data-table-js')
    @include('pages.management.project.content.js.2-data-view-js')
@endpush
