@extends('layout.app')

@section('html')
    @livewire('nav')
    <div class="my-4">
        <div class="px-xl-1">
            <div class="px-4 mb-4 px-xl-5">
                <small class="text-muted" style="font-size:12px">
                    <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                    <i class="mdi mdi-chevron-right"></i>
                    Busqueda
                </small>
                <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Busqueda</a></h4>
            </div>
        </div>
        @livewire('posts',["search" => $search])
    </div>
    @include("layout.footer")
@endsection
