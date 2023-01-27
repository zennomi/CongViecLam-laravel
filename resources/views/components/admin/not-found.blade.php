@php
$singuler = Str::plural($word, 1);
$plural = Str::plural($word, 2);
$method = Str::upper($method);
@endphp
@if ($method == 'GET')
    <div class="empty py-5">
        <x-not-found message="{{ __('no_data_found') }}" />
        <p class="empty-subtitle text-muted">
            {{ __('there_is_no') }} {{ strtolower($plural) }} {{ __('found_in_this_page') }}
        </p>
        <div class="empty-action">
            @if ($route !== '')
                <a href="{{ route($route) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    {{ __('add_your_first') }} {{ strtolower($singuler) }}
                </a>
            @endif
        </div>
    </div>
@else
    <div class="empty py-5">
        <x-not-found message="{{ __('no_data_found') }}" />
        <p class="empty-subtitle text-muted">
            {{ __('there_is_no') }} {{ strtolower($plural) }} {{ __('found_in_this_page') }}
        </p>
        <div class="empty-action">
            @if ($route !== '')
                <form action="{{ route($route) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        {{ __('add_your_first') }} {{ strtolower($singuler) }}
                    </button>
                </form>
            @endif
        </div>
    </div>
@endif
