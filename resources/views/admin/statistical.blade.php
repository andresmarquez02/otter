@extends('layout.app')
@section('html')
    @livewire('nav')
    <div class="my-5">
        <div class="d-flex justify-content-center">
            <div class="px-2 mb-2 w-95 w-sm-85">
                <small class="text-muted" style="font-size:12px">
                    <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                    <i class="mdi mdi-chevron-right"></i>
                    Estadisticas
                </small>
                <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Estadisticas</a></h4>
            </div>
        </div>
        @livewire('admin.statisticals')
    </div>
@endsection
