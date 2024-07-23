<div class="form-group">
    @if ($label)
        <label class="form-control-label">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" {{$attributes}} class="form-control select2 {{ $class }}">
        {{ $slot }}
    </select>
</div>
