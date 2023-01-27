@props([
    'name' => 'name',
    'cols' => 30,
    'rows' => 10,
    'id' => 'id',
    'class' => 'class',
    'placeholder',
    'value',
])

<textarea name="{{ $name }}" id="{{ $id ?? $name }}" cols="{{ $cols }}" rows="{{ $rows }}"
    placeholder="{{ $placeholder ?? $name }}" class="form-control {{ $class }}">
        {{ $value ?? old($name) }}
    </textarea>

<x-forms.error name="{{ $name }}" />
