@extends('main')

@section('title')
  Chat
@endsection

@section('content')

@section('css')
{{-- <style>
  .sent-message {
      text-align: right;
      background: lightblue;
      padding: 10px;
      border-radius: 10px;
      margin: 10px 0;
  }

  .received-message {
      text-align: left;
      background: lightgray;
      padding: 10px;
      border-radius: 10px;
      margin: 10px 0;
  }
</style> --}}
@endsection

@include('pages.chat.content.message')

@push('js')
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<!-- Plugins JS start-->
 
@include('pages.chat.content.js.firebase-js')
{{-- @include('pages.chat.content.js.message-js') --}}
<!-- Plugins JS Ends-->
@endpush

@endsection