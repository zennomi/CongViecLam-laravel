@component('mail::message')
# Hello, {{ $candidate_name }}

{{ $body }} <br>
{{ config('app.name') }}
@endcomponent
