@extends('main')

@section('title')
    Dashboard
@endsection

@section('content')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
@endsection

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            @include('pages.dashboard.components.index-top')
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@push('js')
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/chart-custom.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/general-widget.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script>
        var options = {
            series: [{
                name: 'Total',
                data: {!! json_encode($userData) !!}
            }],
            chart: {
                type: 'bar',
                height: 150
            },
            xaxis: {
                categories: {!! json_encode($userLabels) !!}
            }
        };

        var member = new ApexCharts(document.querySelector("#chart-member"), options);
        member.render();
    </script>
    <script>
        var options = {
            series: {!! json_encode($categoryData) !!},
            chart: {
                type: 'donut',
                height: 150
            },
            labels: {!! json_encode($categoryLabels) !!}
        };

        var chart = new ApexCharts(document.querySelector("#chart-review"), options);
        chart.render();
    </script>
    <!-- Plugins JS Ends-->
@endpush
@endsection
