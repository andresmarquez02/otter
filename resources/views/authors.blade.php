@extends('layout.app')

@section('html')
    @livewire('nav')
    <div class="my-4">
        <div class="px-xl-1">
            <div class="px-5 mb-4 px-xl-5">
                <small class="text-muted" style="font-size:12px">
                    <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                    <i class="mdi mdi-chevron-right"></i>
                    Autores
                </small>
                <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Autores</a></h4>
            </div>
        </div>
        @livewire('authors')
    </div>
    @include("layout.footer")
@endsection
