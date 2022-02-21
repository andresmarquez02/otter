@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{asset("plugins/dropify/css/dropify.min.css")}}">
@endsection
@section('html')
    @livewire('nav')
    <div class="my-5">
        <div class="d-flex justify-content-center">
            <div class="px-2 mb-2 w-95 w-md-50">
                <small class="text-muted" style="font-size:12px">
                    <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                    <i class="mdi mdi-chevron-right"></i>
                    Imagen por defecto
                </small>
                <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Imagen por defecto</a></h4>
            </div>
        </div>
        @livewire('admin.img-default')
    </div>
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
