@extends('public.public')
@section('title')
    Systematic Literature Review
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/custom.css') }}" />
@endsection
@section('content')
    <div class="default-dash">
        <div class="row">
            @include('public.pages.home.components.home-1')
            @include('public.pages.home.components.home-2')
            @include('public.pages.home.components.home-3')
        </div>
    </div>
@endsection
@push('js')
    @include('public.pages.home.components.demo-js')
@endpush
