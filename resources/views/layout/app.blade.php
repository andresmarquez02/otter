<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Otter</title>
        <link rel="stylesheet" href="{{asset('css/newmdb.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/toast.css')}}">
        <link rel="shortcut icon" href="{{asset('otter.png')}}">
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @livewireStyles
        @yield('styles')
    </head>
    <body class="bg-light-color vh-100-min" data-mdb-spy="scroll" data-mdb-target="#scrollspy" data-mdb-offset="250"
    style="display:flex;flex-direction: column;min-height: 100vh;overflow-x: hidden;">
        @yield('html')
        <script src="{{asset('js/mdb.min.js')}}"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/toast.js')}}"></script>
        <script type="text/javascript" src="{{asset("js/main.js")}}"></script>
        @livewireScripts
        <script src="{{asset('js/alpine.js')}}"></script>
        @yield('scripts')
        <script src="{{asset('js/messages.js')}}"></script>
    </body>
</html>
