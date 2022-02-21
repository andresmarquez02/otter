@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{asset("plugins/dropify/css/dropify.min.css")}}">
@endsection
@section('html')
    @livewire('nav')
    @livewire('my-profile')
    @include("layout.footer")
@endsection
@section('scripts')
    <script src="{{asset("plugins/dropify/js/dropify.js")}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });
    </script>
@endsection
