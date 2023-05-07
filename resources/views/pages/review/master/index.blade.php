@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
@endsection
@include('pages.review.master.content.master')

@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endpush
@endsection
