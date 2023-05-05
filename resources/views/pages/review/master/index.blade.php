@extends('main')

@section('title')
    {{ $parent }} {{ $child }}
@endsection

@section('content')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/dist/css/select2.min.css') }}">
@endsection
@include('pages.review.master.content.master')

@push('js')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/css/vendors/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.ongkir').select2({
                placeholder: 'Provinsi',
                allowClear: true,
                width: "100%",
                ajax: {
                    url: '{{ route('review.ongkir')}}',
                    dataType: 'json',
                    delay: 220,
                    data: function(params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                },
                minimumInputLength: 0,
                minimumResultsForSearch: 0,
            })
        });
    </script>
@endpush
@endsection
