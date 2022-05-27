<div class="form-group">
    <label class="form-control-label">{{ $label }}</label>
    <input type="{{ $type }}" value="@if(empty($value)){{ old($name) }}@else{{$value}}@endif"
    name="{{ $name }}" {{ $attributes }}
        class="form-control form-control-alternative {{ $class }}">
</div>
