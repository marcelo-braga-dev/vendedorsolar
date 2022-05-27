<div class="form-group">
    <label class="form-control-label">{{ $label }}</label>
    <select name="{{ $name }}" {{$attributes}} class="form-control select2">
        {{ $slot }}
    </select>
</div>
