@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{asset("plugins/dropify/css/dropify.min.css")}}">
@endsection
@section('html')
    <div>
        @livewire('nav')
        <div class="my-4">
            <div class="d-flex justify-content-center">
                <div class="px-2 mb-2 w-95 w-md-85">
                    <small class="text-muted" style="font-size:12px">
                        <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        Crear Post
                    </small>
                    <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Crear Post</a></h4>
                </div>
            </div>
            @livewire('create-posts')
        </div>
    </div>
    @include("layout.footer")
@endsection
@section('scripts')
    <script src="{{asset("plugins/dropify/js/dropify.js")}}"></script>
    <script src="{{asset("js/tinymce.min.js")}}"></script>
    <script src="https://cdn.tiny.cloud/1/r9uduxhm3f3y8kfxrshcswcez4a9hflan4cza58ahz5ef4ov/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });
    </script>
@endsection
