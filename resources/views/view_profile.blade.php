@extends('layout.app')

@section('html')
    <div>
        @livewire('nav')
        @livewire('view-profile',["id_user" => $id])
        <div class="mt-2 mb-4">
            <div class="px-xl-1">
                <div class="px-4 mb-4 px-xl-5">
                    <h4 class="fw-bold "><a href="{{request()->fullUrl}}" class="text-dark">Posts</a></h4>
                </div>
            </div>
            @livewire('posts',["user_id" => $id])
        </div>
    </div>
    @include("layout.footer")
@endsection
