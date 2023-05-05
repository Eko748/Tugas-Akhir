@extends('public.public')

@section('title')
  Systematic Literature Review
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/custom.css') }}" />
@endsection

@section('content')

  <div class="container-fluid default-dash">
    <div class="row">

        @include('public.pages.home.components.home-1')
        @include('public.pages.home.components.home-2')
        {{-- @include('public.pages.home.components.home-3') --}}
        {{-- @include('public.pages.home.components.home-4') --}}
        @include('public.pages.home.components.home-5')
        @include('public.pages.home.components.home-6')
        @include('public.pages.home.components.home-7')
     
    </div>
  </div>
@endsection