@extends('main')
@section('title')
    Dashboard
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid default-dash">
            <div class="row">
                @include('layout.breadcrumb')
                <div class="row">
                    @include('pages.dashboard.components.1-welcome')
                    @include('pages.dashboard.components.2-chart')
                </div>
                @if (session('status') === 'new-user')
                    @include('pages.dashboard.components.3-alert')
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    @include('pages.dashboard.components.4-chart-js')
@endpush
