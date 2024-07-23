<div class="form-group">
    @if ($label)
        <label class="form-control-label">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" value="@if(empty($value)){{ old($name) }}@else{{$value}}@endif"
           name="{{ $name }}" {{ $attributes }}
           class="form-control form-control-alternative {{ $class }}">
</div>
