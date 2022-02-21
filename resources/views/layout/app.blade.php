<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Otter</title>
        <link rel="stylesheet" href="{{asset('css/newmdb.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/toast.css')}}">
        {{-- <link rel="shortcut icon" href="{{asset('Mors.png')}}"> --}}
        <script src="{{asset('js/jquery.min.js')}}"></script>
        @livewireStyles
        @yield('styles')
    </head>
    <body style="overflow-x: hidden;" class="bg-light-color vh-100-min" data-mdb-spy="scroll" data-mdb-target="#scrollspy" data-mdb-offset="250">
        @yield('html')
        {{-- <div>
            <footer class="p-4 bg-dark">
                holii
            </footer>
        </div> --}}
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
