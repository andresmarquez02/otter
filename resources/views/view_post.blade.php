@extends('layout.app')

@section('html')
    @livewire('nav')
    @livewire('view-post',["id_post" => $id])
    @include("layout.footer")
@endsection
