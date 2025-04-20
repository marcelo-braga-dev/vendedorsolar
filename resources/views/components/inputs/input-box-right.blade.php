<div class="form-group {{ $class }} @if ($hidden) d-none @endif" >
    @if ($label)
        <label class="form-control-label d-block">{{ $label }}</label>
    @endif
    <div class="input-group input-group-alternative mb-4">
        <input type="{{ $type }}" name="{{ $name }}" class="form-control text-right"
            {{ $attributes }}  @if ($hidden) disabled @endif>
        <div class="input-group-append">
            <span class="input-group-text" style="font-size: 0.9rem">{{ $box }}</span>
        </div>
    </div>
</div>
