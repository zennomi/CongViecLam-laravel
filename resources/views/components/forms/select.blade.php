<select name="{{ $name }}" id="{{ $id ? $id:$name }}" class="form-control {{ $class }} {{ error($name) }}">
    {{ $slot }}
</select>
<x-forms.error name="{{ $name }}"/>
