@extends('layout.app')
@section('html')
    @livewire('nav')
    <div class="my-5">
        <div class="d-flex justify-content-center">
            <div class="px-2 mb-2 w-95 w-sm-85 w-md-60">
                <small class="text-muted" style="font-size:12px">
                    <a href="{{!empty(auth()->user()) ? url("home") : url("/")}}">Inicio</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    Roles
                </small>
                <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Roles</a></h4>
            </div>
        </div>
        @livewire('admin.roles')
    </div>
@endsection
