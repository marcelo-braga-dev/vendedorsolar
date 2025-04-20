<div class="form-group">
    @if ($label)
        <label for="" class="form-control-label d-block">{{ $label }}</label>
    @endif
    <input {{ $attributes }} name="{{ $name }}" class="form-control form-control-alternative {{ $class }}"
           type="datetime-local" value="{{ $value }}">
</div>
