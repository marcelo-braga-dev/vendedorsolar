@push('css')
    <style>
        /* Limite elegante para conteúdo em desktops */
        .content-shell{
            /* espaçamentos responsivos */
            padding-top: clamp(.5rem, 1.5vw, 1.25rem);
            padding-bottom: clamp(1rem, 3vw, 2rem);
        }
        .content-inner{
            /* limite máximo do conteúdo em telas grandes */
            max-width: 1280px;           /* ajuste para 1200/1360 se preferir */
            margin-inline: auto;         /* centraliza */
        }
    </style>
@endpush

<div class="content-shell mt--6 mb-6">
    <div class="container-xxl">
        <div class="content-inner px-2 px-md-3">
            <h4>{{$title}}</h4>
            {{ $slot }}
        </div>
    </div>
</div>
