<div class="row">
    <div class="col-lg-12">
        <div class="joblist-left-content2 rt-pt-20">
            <button type="button" class="btn btn-sm btn-link no-padding d-block open-adf">
                {{ __('advance_filter') }}
            </button>
            <div class="d-flex flex-wrap">
                {{-- Search History --}}
                <x-website.job.search-history />

                <div class="flex-grow-0 rt-mb-20">
                    <div class="joblist-fliter-gorup">

                        <div class="left-content">
                            <select class="rt-selectactive gap" name="sort_by" id="sort_by">
                                <option disabled class="d-none" {{ request('sort_by') ? '' : 'selected' }}
                                    value="">
                                    {{ __('sortby') }}
                                </option>
                                @if (auth('user')->check())
                                    <option {{ request('sort_by') == 'recommanded' ? 'selected' : '' }}
                                        value="recommanded">
                                        {{ __('recommanded') }}
                                    </option>
                                @endif
                                <option {{ request('sort_by') == 'latest' ? 'selected' : '' }} value="latest">
                                    {{ __('latest') }}
                                </option>
                                <option {{ request('sort_by') == 'featured' ? 'selected' : '' }} value="featured">
                                    {{ __('featured') }}
                                </option>
                            </select>
                        </div>
                        @if (request('location'))
                            <div class="left-content">
                                <select class="rt-selectactive gap" name="radius" id="radius">
                                    <option {{ request('radius') == 0 ? 'selected' : '' }} value="0">
                                        {{ __('exact_location_only') }}
                                    </option>
                                    <option {{ request('radius') == 5 ? 'selected' : '' }} value="5">
                                        {{ __('within') }} 5 {{ __('miles') }}
                                    </option>
                                    <option {{ request('radius') == 10 ? 'selected' : '' }} value="10">
                                        {{ __('within') }} 10 {{ __('miles') }}
                                    </option>
                                    <option {{ request('radius') == 15 ? 'selected' : '' }} value="15">
                                        {{ __('within') }} 15 {{ __('miles') }}
                                    </option>
                                    <option {{ request('radius') == 25 ? 'selected' : '' }} value="25">
                                        {{ __('within') }} 25 {{ __('miles') }}
                                    </option>
                                    <option {{ request('radius') == 50 ? 'selected' : '' }} value="50">
                                        {{ __('within') }} 50 {{ __('miles') }}
                                    </option>
                                    <option {{ request('radius') == 100 ? 'selected' : '' }} value="100">
                                        {{ __('within') }} 100 {{ __('miles') }}
                                    </option>
                                </select>
                            </div>
                        @endif

                        {{-- List Style Switcher --}}
                        <x-website.job.job-list-style-switcher />

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@section('frontend_scripts')
    <script>
        $('#sort_by').on('change', function() {
            $('#job_search_form').submit();
        })
    </script>
    <script>
        $('#radius').on('change', function() {
            $('#job_search_form').submit();
        })
    </script>
@endsection
