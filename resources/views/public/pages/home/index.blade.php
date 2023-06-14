@extends('public.public')
@section('title')
    Systematic Literature Review
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/custom.css') }}" />
@endsection
@section('content')
        @include('public.pages.home.components.home-1')
        @include('public.pages.home.components.home-2')
@endsection
@push('js')
    @include('public.pages.home.components.demo-js')
@endpush
