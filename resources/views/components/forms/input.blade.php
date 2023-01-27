@props(['type', 'name' => 'name', 'id' => 'id', 'class' => 'class', 'placeholder' => 'placeholder', 'value'])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id ? $id : $name }}"
    class="form-control {{ $class }} {{ error($name) }}" value="{{ $value ?? old($name) }}"
    placeholder="{{ __($placeholder) }}">
<x-forms.error name="{{ $name }}" />
