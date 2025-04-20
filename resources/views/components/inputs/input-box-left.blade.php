<div class="form-group">
    @if ($label)
        <label class="form-control-label d-block">{{ $label }}</label>
    @endif
    <div class="input-group input-group-alternative mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" style="font-size: 0.9rem">{{ $box }}</span>
        </div>
        <input type="{{ $type }}" name="{{ $name }}" {{ $attributes }} value="{{ $value }}"
               class="form-control {{ $class }}">
    </div>
</div>
