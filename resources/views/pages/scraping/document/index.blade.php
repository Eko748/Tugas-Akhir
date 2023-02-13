@extends('main')

@section('title')
  {{ $parent }} {{ $child }}
@endsection

@section('css')

@endsection
@section('content')


@include('pages.scraping.document.content.scraping')

@push('js')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/osmosis/index.js') }}"></script>
<script src="../assets/js/form-wizard/form-wizard-two.js"></script>

<!-- Plugins JS Ends-->
@include('pages.scraping.document.content.js.home-js')
@include('pages.scraping.document.content.js.osmosis')
@endpush

@endsection