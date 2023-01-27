<div class="col-lg-3">
    <div class="d-sidebar">
        <h3>@lang('employer_dashboard')</h3>
        <ul class="sidebar-menu menu-active-classes">
            <li>
                <a href="{{ route('company.dashboard') }}" class="{{ linkActive('company.dashboard') }}">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-stack"></i>
                        </span>
                        <span class="button-text">
                            {{ __('overview') }}
                        </span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('website.employe.details', auth()->user()->username) }}">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-user-circle"></i>
                        </span>
                        <span class="button-text">
                            {{ __('my_profile') }}
                        </span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.myjob') }}" class="{{ linkActive('company.myjob') }}">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-suitcase-simple"></i>
                        </span>
                        <span class="button-text">
                            {{ __('my_jobs') }}
                        </span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.bookmark') }}"
                    class="{{ request()->routeIs('company.bookmark') || request()->routeIs('company.bookmark.category.index') ? 'active' : '' }} ">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-bookmark-simple"></i>
                        </span>
                        <span class="button-text">
                            {{ __('saved_candidate') }}
                        </span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.plan') }}" class="{{ linkActive('company.plan') }}">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-notebook"></i>
                        </span>
                        <span class="button-text">
                            {{ __('plans_billing') }}
                        </span>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('company.setting') }}" class="{{ linkActive('company.setting') }}">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-gear"></i>
                        </span>
                        <span class="button-text">
                            {{ __('settings') }}
                        </span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <span class="button-content-wrapper ">
                        <span class="button-icon align-icon-left">
                            <i class="ph-sign-out"></i>
                        </span>
                        <span class="button-text">
                            {{ __('log_out') }}
                        </span>
                    </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
    .custom-dropdown-toggle::after {
        border: none;
        content: "";
        font-family: "flaticon";
        font-size: 14px;
        vertical-align: middle;
        margin-left: auto;
    }

    .active.custom-dropdown-toggle::after {
        transform: rotate(180deg) !important;
    }
</style>
