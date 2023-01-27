    <div class="container">
        <div class="row">
            <div class="col-xl-6 rt-mb-24">
                <div class="cta-1 ct-height bgprefix-cover"
                    style="background-image: url({{ asset($cms_setting->candidate_image) }}">
                    <h5 class="rt-mb-15">{{ __('candidate_title') }}</h5>
                    <div class="body-font-4 rt-mb-24 text-gray-600 max-312">
                        {{ __('candidate_description') }}
                    </div>
                    <form action="{{ route('register') }}" method="GET">
                        <input class="d-none" type="text" name="user" value="candidate" id="">
                        <button type="submit" class="btn btn-light">
                            <span class="button-content-wrapper ">
                                <span class="button-icon align-icon-right">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12H19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="button-text">
                                    {{ __('register_now') }}
                                </span>
                            </span>
                        </button>
                    </form>
                </div>

            </div>
            <div class="col-xl-6 rt-mb-24">
                <div class="cta-1 ct-height bgprefix-cover"
                    style="background-image: url({{ asset($cms_setting->employers_image) }}">
                    <h5 class="rt-mb-15 text-gray-10">{{ __('employers_title') }}</h5>
                    <div class="body-font-4 rt-mb-24 text-gray-10 max-312">
                        {{ __('employers_description') }}
                    </div>
                    <form action="{{ route('register') }}" method="GET">
                        <input class="d-none" type="text" name="user" value="company" id="">
                        <button type="submit" class="btn btn-light">
                            <span class="button-content-wrapper ">
                                <span class="button-icon align-icon-right">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12H19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="button-text">
                                    {{ __('register_now') }}
                                </span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
