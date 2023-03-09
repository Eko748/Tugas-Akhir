@extends('main')

@section('title')
  {{ $parent }} {{ $child }}
@endsection

@section('content')

@section('css')
@endsection

@include('pages.management.slr.content.slr')

@push('js')
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<!-- Plugins JS start-->
<script src="../assets/js/form-validation-custom.js"></script>
@include('pages.management.slr.content.js.1-data-js')
<!-- Plugins JS Ends-->
@endpush

@endsection