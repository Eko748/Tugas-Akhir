@extends('main')

@section('title')
    404 Not Found
@endsection

@section('content')
@section('css')
@endsection

@include('pages.error.404.content.404')

@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endpush
@endsection
