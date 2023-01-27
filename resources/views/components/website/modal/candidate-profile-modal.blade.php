<div class="modal fade cadidate-modal" id="candidate-profile-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-wrapper">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-5">
                    <div class="col-md-8">
                        <div class="candidate-profile mb-4 mb-md-0">
                            <div class="candidate-profile-img">
                                <img id="candidate_image"
                                    src="{{ asset('frontend') }}/assets/images/all-img/candidate-profile.png" alt="">
                            </div>
                            <div class="candidate-profile-info">
                                <h2 class="name"></h2>
                                <h4 class="designation"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-md-flex align-items-center justify-content-md-end">
                        <div class="d-flex gap-3 flex-column flex-md-row">
                            <div class="rt-mb-md-10">
                                {{-- Not bookmark  --}}
                                <button id="bookmakCandidate" class="d-none bg-primary-50 text-primary-500 plain-button icon-48 btn-star-white hover:bg-primary-500 hover:text-primary-50">
                                    <svg width="16" height="20" viewBox="0 0 16 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 19L8 14L1 19V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19Z"
                                            stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                                {{-- Already bookmarked  --}}
                                <button id="removeBookmakCandidate" class="d-none bg-primary-50 text-primary-500 plain-button icon-48 btn-star-white hover:bg-primary-500 hover:text-primary-50">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                            fill="var(--primary-500)"
                                            stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="biography-wrap">
                            <input id="candidate_id" type="hidden" value="">
                            <div class="biography">
                                <h2 class="title text-uppercase">{{ __('biography') }}</h2>
                                <p class="text">{{ __('no_data_found') }}</p>
                            </div>
                            <div id="candidate_social_profile_modal">
                                <div class="devider"></div>

                                <div class="devider"></div>
                                <div class="social-links">
                                    <h2 class="title">{{ __('follow_me_social_media') }}</h2>
                                    <div class="social-media">
                                        <ul>
                                            <li>
                                                <a href="#"
                                                    class="bg-primary-50 text-primary-500 plain-button icon-56 hover:bg-primary-500 hover:text-primary-50">
                                                    <x-svg.facebook-icon fill="currentColor" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="bg-primary-50 text-primary-500 plain-button icon-56 hover:bg-primary-500 hover:text-primary-50">
                                                    <x-svg.twitter-icon />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="bg-primary-50 text-primary-500 plain-button icon-56 hover:bg-primary-500 hover:text-primary-50">
                                                    <x-svg.linkedin2-icon />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="bg-primary-50 text-primary-500 plain-button icon-56 hover:bg-primary-500 hover:text-primary-50">
                                                    <x-svg.instagram-icon />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="bg-primary-50 text-primary-500 plain-button icon-56 hover:bg-primary-500 hover:text-primary-50">
                                                    <x-svg.youtube-icon />
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-widget">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <x-svg.birth-date-icon />
                                        </div>
                                        <h3 class="sub-title text-uppercase">{{ __('date_of_birth') }}</h3>
                                        <h2 class="title" id="candidate_birth_date">N/A</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <x-svg.fold-icon />
                                        </div>
                                        <h3 class="sub-title">{{ __('nationality') }}</h3>
                                        <h2 class="title" id="candidate_nationality">N/A</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <x-svg.board-icon />
                                        </div>
                                        <h3 class="sub-title">{{ __('marital_status') }}</h3>
                                        <h2 class="title" id="candidate_marital_status">N/A
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <x-svg.gender />
                                        </div>
                                        <h3 class="sub-title">{{ __('gender') }}</h3>
                                        <h2 class="title" id="candidate_gender">N/A</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <i class="ph-suitcase-simple f-size-24 text-primary-500"></i>
                                        </div>
                                        <h3 class="sub-title">{{ __('experience') }}</h3>
                                        <h2 class="title" id="candidate_experience">N/A</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <x-svg.education-cap-icon />
                                        </div>
                                        <h3 class="sub-title">{{ __('education') }}</h3>
                                        <h2 class="title" id="candidate_education">N/A</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="contact">
                                <h2 class="title">{{ __('contact_information') }}</h2>
                                <div class="contact-icon-box">
                                    <div class="icon-img">
                                        <x-svg.globe-icon />
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">{{ __('website') }}</h3>
                                        <h2 class="title" id="candidate_website">N/A</h2>
                                    </div>
                                </div>
                                <div class="devider"></div>
                                <div class="contact-icon-box">
                                    <div class="icon-img">
                                        <x-svg.location2-icon />
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">{{ __('location') }}</h3>
                                        <h2 class="title" id="candidate_location">N/A</h2>
                                    </div>
                                </div>
                                <div class="devider"></div>
                                <div class="contact-icon-box">
                                    <div class="icon-img">
                                        <x-svg.telephone-icon />
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">{{ __('phone') }}</h3>
                                        <h2 class="title" id="candidate_phone">N/A</h2>
                                        <h3 class="subtitle">{{ __('secondary_phone') }}</h3>
                                        <h2 class="title" id="candidate_seconday_phone">N/A
                                        </h2>
                                    </div>
                                </div>
                                <div class="devider"></div>
                                <div class="contact-icon-box">
                                    <div class="icon-img">
                                        <x-svg.envelope-icon />
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">{{ __('email_address') }}</h3>
                                        <h2 class="title" id="contact_info_email">N/A</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>
