@if ($companies->count() > 0)
    @foreach ($companies as $company)
        <div class="card jobcardStyle1 rt-mb-24">
            <div class="card-body">
                <div class="rt-single-icon-box ">
                    <div class="icon-thumb">
                        <img src="{{ asset($company->logo_url) }}" alt="" draggable="false">
                    </div>
                    <div class="iconbox-content">
                        <div class="post-info2">
                            <div class="post-main-title">
                                <a href="">{{ $company->user->name }}
                                </a>
                            </div>
                            <span class="loacton text-gray-400 ">
                                <i class="ph-map-pin"></i>
                                {{ $company->country }}
                            </span>
                        </div>
                    </div>
                    <div class="iconbox-extra align-self-center">
                        <div>
                            <form action="{{ route('candidate.bookmarkCompany', $company->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                            fill="var(--primary-500)" stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <x-not-found message="{{ __('no_data_found') }}" />
@endif
<div class="rt-spacer-50 rt-spacer-md-20"></div>
<nav>
    {{ $companies->links('vendor.pagination.frontend') }}
</nav>
