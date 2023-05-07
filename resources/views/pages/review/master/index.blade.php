@extends('main')
@section('title')
    {{ $parent }} {{ $child }}
@endsection
@section('css')
@endsection
@section('content')
    @include('pages.review.master.content.master')
@endsection
@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endpush
