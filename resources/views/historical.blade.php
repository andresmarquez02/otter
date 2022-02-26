@extends('layout.app')
@section('html')
    <div>
        @livewire('nav')
        <div class="my-4">
            <div class="px-xl-4">
                <div class="px-4 mb-4 px-lg-5">
                    <small class="text-muted" style="font-size:12px">
                        <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        Historial
                    </small>
                    <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Historial</a></h4>
                </div>
            </div>
            @livewire('historical')
        </div>
    </div>
    @include("layout.footer")
@endsection
