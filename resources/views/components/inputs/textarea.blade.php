@if ($label)
    <label class="form-control-label">{{ $label }}</label>
@endif
<textarea name="{{ $name }}" {{ $attributes }} class="form-control form-control-alternative mb-4">{{ $slot }}</textarea>
