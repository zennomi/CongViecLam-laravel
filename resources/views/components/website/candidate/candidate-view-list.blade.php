@props(['candidates'])

<div class="tab-pane " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    @if ($candidates->count() > 0)
        @foreach ($candidates as $candidate)
            <div class="card jobcardStyle1 body-24 rt-mb-24">
                <div class="card-body">
                    <div class="rt-single-icon-box ">
                        <div class="icon-thumb">
                            <div class="profile-image">
                                <img src="{{ asset($candidate->photo) }}" alt="{{ __('candidate_image') }}">
                            </div>
                        </div>
                        <div class="iconbox-content">
                            <div class="post-info2">
                                <div class="post-main-title">
                                    @if (auth('user')->check())
                                        <a href="javascript:void(0)"
                                            onclick="showCandidateProfileModal('{{ $candidate->user->username }}')">
                                            {{ $candidate->user->name }}
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="login_required">
                                            {{ $candidate->user->name }}
                                        </a>
                                    @endif

                                </div>
                                <span class="loacton text-gray-400 ">
                                    {{ $candidate->profession ? $candidate->profession->name : '' }}
                                </span>
                                <div class="body-font-4 text-gray-600 pt-4">
                                    <span class="info-tools">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.75 7.5C15.75 12.75 9 17.25 9 17.25C9 17.25 2.25 12.75 2.25 7.5C2.25 5.70979 2.96116 3.9929 4.22703 2.72703C5.4929 1.46116 7.20979 0.75 9 0.75C10.7902 0.75 12.5071 1.46116 13.773 2.72703C15.0388 3.9929 15.75 5.70979 15.75 7.5Z"
                                                stroke="#939AAD" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M9 9.75C10.2426 9.75 11.25 8.74264 11.25 7.5C11.25 6.25736 10.2426 5.25 9 5.25C7.75736 5.25 6.75 6.25736 6.75 7.5C6.75 8.74264 7.75736 9.75 9 9.75Z"
                                                stroke="#939AAD" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        {{ $candidate->country }}
                                    </span>
                                    <span class="info-tools ">
                                        <i class="ph-suitcase-simple"></i>
                                        @if ($candidate->experience)
                                            {{ $candidate->experience ? $candidate->experience->name : '' }}
                                        @else
                                            0
                                        @endif {{ __('years_experience') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="iconbox-extra align-self-center">
                            {{-- <div>
                                @if (auth()->user() ? auth()->user()->role == 'company' : '')
                                    <div class="iconbox-extra">
                                        @if ($candidate->bookmarked)
                                            <form
                                                action="{{ route('company.companybookmarkcandidate', $candidate->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
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
                                            </form>
                                        @else
                                            <button type="button" onclick="CompanyBookmark('{{ $candidate->id }}')"
                                                class="hoverbg-primary-50 text-primary-500 plain-button icon-button">
                                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15 19L8 14L1 19V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19Z"
                                                        stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div> --}}
                            <div>
                                @if (auth('user')->check())
                                    <a onclick="showCandidateProfileModal('{{ $candidate->user->username }}')"
                                        href="javascript:void(0);" class="btn btn-primary2-50">
                                        <span class="button-content-wrapper ">
                                            <span class="button-icon align-icon-right">
                                                <i class="ph-arrow-right"></i>
                                            </span>
                                            <span class="button-text">
                                                {{ __('view_profile') }}
                                            </span>
                                        </span>
                                    </a>
                                @else
                                    <a href="javascript:void(0);" class="btn btn-primary2-50 login_required">
                                        <span class="button-content-wrapper ">
                                            <span class="button-icon align-icon-right">
                                                <i class="ph-arrow-right"></i>
                                            </span>
                                            <span class="button-text">
                                                {{ __('view_profile') }}
                                            </span>
                                        </span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-md-12">
            <div class="card text-center">
                <x-not-found message="{{ __('no_data_found') }}" />
            </div>
        </div>
    @endif
    @if (request('perpage') != 'all' && $candidates->total() > $candidates->count())
        <div class="rt-pt-30">
            <nav>
                {{ $candidates->links('vendor.pagination.frontend') }}
            </nav>
        </div>
    @endif
</div>
