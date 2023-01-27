<div class="rt-site-footer bg-gray-900 dark-footer">
    <div class="footer-cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <form action="{{ route('newsletter.subscribe') }}" class="rt-from" method="POST">
                        @csrf
                        <div class="subscribe-inputbox-1 row smallgap">
                            <div class="col-md-8">
                                <div class="fromGroup has-icon2">
                                    <input type="text" name="email" placeholder="{{ __('email_address') }}"
                                        class="text-white form-control @error('email') is-invalid @enderror">
                                    <span class="icon-badge-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M22 6L12 13L2 6" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                @error('email')
                                    <span class="text-danger"
                                        role="alert">{{ __($message) }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="newsButton btn btn-primary col-lg-4 p-0">
                                    <span class="p-4">{{ __('subscribe') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 rt-pt-md-30">
                    <div class="row">
                        <div class="col-md-4 col-sm-4   text-center rt-mb-20">
                            <div class="f-size-24 ft-wt-5 text-gray-10"><span
                                    class="counter">{{ livejob() }}</span></div>
                            <span class="text-gray-500 f-size-16">{{ __('live_job') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-4   text-center rt-mb-20">
                            <div class="f-size-24 ft-wt-5 text-gray-10"><span
                                    class="counter">{{ companies() }}</span></div>
                            <span class="text-gray-500 f-size-16">{{ __('companies') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-4  text-center rt-mb-20">
                            <div class="f-size-24 ft-wt-5 text-gray-10"><span
                                    class="counter">{{ candidate() }}</span></div>
                            <span class="text-gray-500 f-size-16">{{ __('candidates') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('frontend_scripts')
    <x-website.toast-errors />
@endsection
