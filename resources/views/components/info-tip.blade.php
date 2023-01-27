@props(['message' => 'Tooltip'])

<span data-toggle="tooltip" title="{{ $message }}">
    <x-svg.info-icon/>
</span>
