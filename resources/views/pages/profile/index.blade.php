@extends('main')
@section('title')
    {{ $parent }} {{ $child }}
@endsection
@section('css')
@endsection
@section('content')
    @include('pages.profile.content.profile')
@endsection
@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script> --}}
    {{-- @include('pages.dashboard.components.3-chart-js') --}}
@endpush
