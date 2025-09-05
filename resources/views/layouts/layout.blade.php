<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    {{-- Favicon --}}
    <link href="{{ getLogoPrincipal() }}" rel="icon">
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    {{-- Icons --}}
    {{--    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">--}}
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    {{-- Argon CSS --}}
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('assets') }}/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    {{-- Font Awesome --}}
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />


    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    @stack('css')
</head>

@php define('MENU', $attributes['menu']); define('SUBMENU', $attributes['submenu']) @endphp

<body>
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth

@auth()
    <x-templates.auth tipo-usuario="{{ $tipoUsuario }}">
        {{ $slot }}
    </x-templates.auth>
@endauth

@guest()
    <div class="main-content">
        @yield('content')
    </div>
    @include('layouts.footers.guest')
@endguest

<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/ui.js') }}"></script>
<script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/mask/data-mask.js') }}"></script>
<script src="{{ asset('argon/js/argon.js?v=1.0.0') }}"></script>
<script src="{{ asset('assets/sweetalert2/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

<script>
    // fechar offcanvas ao clicar em links
    document.addEventListener('click', (e)=>{
        const link = e.target.closest('.offcanvas a.nav-link, .offcanvas .btn');
        if(!link) return;
        const el = document.getElementById('offcanvasMenu');
        if(!el) return;
        const off = bootstrap.Offcanvas.getInstance(el);
        if(off) off.hide();
    });
</script>

<x-modals.geral></x-modals.geral>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Selecione...'
        });
    });
</script>
@stack('js')
</body>
</html>
