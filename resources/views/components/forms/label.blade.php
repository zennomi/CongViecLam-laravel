@props([
    'class' => 'class',
    'name' => 'name',
    'for' => 'for',
    'required' => true,
])

<label class="{{ $class }}" for="{{ $for ? $for : $name }}">
    {{ __($name) }}

    @if ($required)
        <span class="form-label-required text-danger">*</span>
    @endif

    {{ $slot }}
</label>
