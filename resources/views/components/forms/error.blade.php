@props([
    'name' => 'name',
    'class' => '',
])

@if ($errors->has($name))
    <span class="invalid-feedback {{ $class }}">
        {{ $errors->first($name) }}
    </span>
@endif
