<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM Solar') }}</title>
    {{-- Favicon --}}
    <link href="{{ getLogoPrincipal() }}" rel="icon">
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    {{-- Argon CSS (framework base — Bootstrap 4 compilado) --}}
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('assets') }}/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" type="text/css">

    {{-- Ícones — uma única fonte por conjunto (evita duas versões da mesma
         biblioteca brigando pela mesma classe, com a mais nova perdendo por
         ordem de carregamento):
         · Bootstrap Icons: local v1.11.3 (mais completo que o CDN v1.8.1)
         · Font Awesome: CDN v6.5.2 (a versão que já prevalecia antes)
         · Tabler Icons: CDN (conjunto próprio, sem duplicidade) --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}?v={{ @filemtime(public_path('css/bootstrap-icons.css')) }}">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    {{-- ?v=filemtime: cache-busting automático — o Cloudflare (e o
         navegador) cacheiam CSS estático por 12h; sem isso, uma
         edição neste arquivo só apareceria pros usuários horas
         depois, mesmo já publicada no servidor. --}}
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}?v={{ @filemtime(public_path('css/theme.css')) }}">
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
{{-- Bootstrap 5 (além do bundle 4 do Argon acima): telas mais novas usam
     data-bs-toggle (tooltip/tab/pill) e a API bootstrap.* diretamente, que
     só esse bundle entende. Não é redundância acidental — o resto do app
     ainda depende do bundle 4 do Argon para os data-toggle (collapse/modal/
     dropdown) do menu lateral e telas antigas. Migrar tudo para um só
     exige revisar cada data-toggle do projeto; fora do escopo desta limpeza. --}}
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
