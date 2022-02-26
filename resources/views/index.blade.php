@extends('layout.app')

@section('html')
    <div>
        <div>
            @livewire('nav')
            <div class="my-4">
                <div class="px-xl-1">
                    <div class="px-4 mb-4 px-xl-5">
                        <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Inicio</a></h4>
                    </div>
                </div>
                @livewire('posts')
            </div>
        </div>
    </div>
    @include("layout.footer")
@endsection
