@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
@endsection
@include('pages.review.master.content.master')

@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endpush
@endsection
