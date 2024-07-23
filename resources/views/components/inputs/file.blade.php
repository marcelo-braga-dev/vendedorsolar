@php($info = pathinfo(asset('storage/').'/'. $url))
<div class="p-2 m-2 border rounded">
    @if ($label)
        <label class="form-control-label d-block">{{ $label }}</label>
    @endif
    @if (!empty($info['extension']) && $info['extension'] == 'pdf')
        <a class="btn btn-danger mb-3 btn-sm" href="{{ asset('storage/')}}/{{ $url }}">
            <i class="fas fa-file-pdf"></i> Abrir Arquivo</a>
    @elseif(!empty($info['extension']) && $info['extension'] == 'mp4')
        <video width="250" height="auto" controls>
            <source src="{{ asset('storage').'/'. $url ?? '' }}">
            {{--<source src="movie.ogg" type="video/ogg">--}}
            Seu navegador não tem suporte para rodar esse vídeo.
        </video>
        @if ($download)
            <a href="{{ asset('storage')}}/{{ $url }}"
               class="btn btn-link d-block" download>Download</a>
        @endif
    @else
        @if ($url)
            <div class="row">
                <img class="mb-2 mx-auto" src="{{ asset('storage/')}}/{{ $url }}" width="150" alt="">
            </div>
            @if ($download)
                <a href="{{ asset('storage')}}/{{ $url }}"
                   class="btn btn-link d-block" download>Download</a>
            @endif
        @endif
    @endif

    <input type="file" name="{{ $name }}" class="form-control">
</div>
