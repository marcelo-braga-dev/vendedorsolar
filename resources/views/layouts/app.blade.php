<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    {{-- Icons --}}
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    {{-- Manifest PWA --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- Cor da barra do navegador (Android/Chrome) --}}
    <meta name="theme-color" content="#e25507">

    {{-- iOS: permitir modo "app" --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Propostas Energia Solar">

    {{-- Ícones para iPhone/iPad --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/icon-192.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icons/icon-192.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icons/icon-192.png') }}">

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

<script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"/>
<script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"/>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"/>
<script src="{{ asset('argon/js/argon.js?v=1.0.0') }}"/>
<script src="{{ asset('assets/sweetalert2/script.js') }}"/>
<x-modals.geral/>

@stack('js')

{{-- Argon JS --}}
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"/>

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('{{ asset('service-worker.js') }}')
                .then(function (registration) {
                    console.log('ServiceWorker registrado com sucesso:', registration.scope);
                })
                .catch(function (error) {
                    console.log('Falha ao registrar o ServiceWorker:', error);
                });
        });
    }
</script>
</body>

</html>
