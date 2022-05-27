<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    {{-- Favicon --}}
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    {{-- Icons --}}
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    {{-- Argon CSS --}}
    {{-- <link type="text/css" href="/assets/vendor/select2/dist/css/select2.min.css" rel="stylesheet"> --}}
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('argon') }}/select2/css/select2.min.css" rel="stylesheet">

    <style>
        .navbar-vertical.navbar-expand-md .navbar-nav .nav .nav-link {
            padding-left: 1.75rem;
            padding-top: 0.25rem;
        }

        .navbar-vertical .navbar-nav .nav-link[data-toggle='collapse']:after {
            color: inherit;
        }

        .navbar-vertical.navbar-expand-md .navbar-nav .nav-link.active:before {
            border-left: 3px solid white;
            border-right: 2px solid red;
        }
        /* Works on Firefox */
        #sidenav-main {
            scrollbar-width: thin;
            scrollbar-color: blue orange;
        }

        /* Works on Chrome, Edge, and Safari */
        #sidenav-main::-webkit-scrollbar {
            width: 8px;
        }

        #sidenav-main::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #sidenav-main::-webkit-scrollbar-thumb {
            background-color: rgba(185, 185, 185, 0.73);
            border-radius: 20px;
            /*border: 3px solid #c4c4c4;*/
        }</style>
</head>

<body class="{{ $class }}">
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth

@auth()
    <x-templates.auth tipo-usuario="{{ auth()->user()->tipo }}"/>
@endauth

@guest()
    <div class="main-content">
        @yield('content')
    </div>
@endguest

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

@stack('js')

{{-- Argon JS --}}
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>
