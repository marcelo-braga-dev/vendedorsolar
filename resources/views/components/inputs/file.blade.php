@php($info = pathinfo(asset('storage/').'/'. $url))

<label class="form-control-label d-block">{{ $label }}</label>
@if (!empty($info['extension']) && $info['extension'] == 'pdf')
    <a class="btn btn-danger mb-3 btn-sm" href="{{ asset('storage/')}}/{{ $url }}">
        <i class="fas fa-file-pdf"></i> Abrir Arquivo</a>
@else
    @if ($url) <img src="{{ asset('storage/')}}/{{ $url }}" width="150" alt=""> @endif
@endif

<input type="file" name="{{ $name }}" class="form-control">
