<input {{ $checked ? 'checked' : '' }} data-on-text="{{ $onText }}" data-off-text="{{ $offText }}"
    button="{{ $button }}" oldvalue="{{ $oldvalue }}" type="checkbox" name="{{ $name }}"
    data-bootstrap-switch value="{{ $value }}">

<x-forms.error name="{{ $name }}" />
