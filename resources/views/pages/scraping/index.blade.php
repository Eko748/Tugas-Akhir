@extends('main')

@section('title')
  Scraping Document
@endsection

@section('content')

@section('css')

@endsection

@include('pages.scraping.content.scraping')

@push('js')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<!-- Plugins JS Ends-->
@include('pages.scraping.content.js.home-js')

@endpush

@endsection