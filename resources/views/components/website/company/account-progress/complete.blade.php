<fieldset>
    <div class="account-successfull-wrap">
        <div class="account-successfull-icon">
            <x-svg.check-double-icon />
        </div>
        <div class="account-successfull-data">
            <h4>🎉 {{ __('congratulations_you_profile_is_complete') }}</h4>
            <p>{{ __('now_you_can_start_using_your_account_you_can_post_job_purchase_plan_for_upcoming_job_and_many_more_enjoy') }}!</p>
        </div>
        <a href="{{ route('company.dashboard') }}" class="btn bg-gray-50 rt-mr-8">
            {{ __('view_dashboard') }}
        </a>
        <a href="{{ route('company.job.create') }}" class="btn btn-primary">
            <span class="button-content-wrapper ">
                <span class="button-icon align-icon-right">
                    <i class="ph-arrow-right"></i>
                </span>
                <span class="button-text">
                    {{ __('post_job') }}
                </span>
            </span>
        </a>
    </div>
</fieldset>
