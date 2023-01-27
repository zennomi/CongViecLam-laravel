<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" parameter=""
                        icon="fas fa-tachometer-alt">
                        {{ __('dashboard') }}
                    </x-admin.sidebar-list>
                    <!-- ======= Order ======== -->
                    @if (userCan('order.view'))
                        <li class="nav-header">
                            {{ __('order') }}
                        </li>
                        <x-admin.sidebar-list :linkActive="request()->routeIs('order.index') ? true : false" route="order.index" icon="fas fa-money-bill">
                            {{ __('order') }}
                        </x-admin.sidebar-list>
                    @endif
                    <!-- ======= Company ======== -->
                    @if (userCan('company.view'))
                        <x-admin.sidebar-list :linkActive="Request::is('admin/company*') ? true : false" route="company.index" icon="fas fa-building">
                            {{ __('company') }}
                        </x-admin.sidebar-list>
                    @endif
                    <!-- ======== Candidate ====== -->
                    @if (userCan('candidate.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('candidate*') ? true : false" route="candidate.index" icon="fas fa-user">
                            {{ __('candidate') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (userCan('job.view') || userCan('job_category.view') || userCan('job_role.view') || userCan('plan.view') || userCan('industry_types.view') || userCan('professions.view'))
                        <li class="nav-header text-uppercase">{{ __('manage_jobs') }}</li>
                    @endif

                    <!-- ======= Job ======== -->
                    @if (userCan('job.view'))
                        <x-admin.sidebar-list :linkActive="Request::is('admin/job/*') || Request::is('admin/job') ? true : false" route="job.index" icon="fas fa-briefcase">
                            {{ __('jobs') }}
                        </x-admin.sidebar-list>
                    @endif
                    <!-- ======= Job Category ======== -->
                    @if (userCan('job_category.view'))
                        <x-admin.sidebar-list :linkActive="Request::is('admin/jobCategory*') ? true : false" route="jobCategory.index" icon="fas fa-th">
                            {{ __('job-category') }}
                        </x-admin.sidebar-list>
                    @endif
                    <!-- ======= Job Role ======== -->
                    @if (userCan('job_role.view'))
                        <x-admin.sidebar-list :linkActive="Request::is('admin/jobRole*') ? true : false" route="jobRole.index" icon="fas fa-user-tie">
                            {{ __('job_role') }}
                        </x-admin.sidebar-list>
                    @endif

                    @if (Module::collections()->has('Plan') && userCan('plan.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.plan.index') ||
                        Route::is('module.plan.create') ||
                        Route::is('module.plan.edit')
                            ? true
                            : false" route="module.plan.index" icon="fas fa-credit-card">
                            {{ __('price_plan') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (userCan('industry_types.view') || userCan('professions.view'))
                        <x-admin.sidebar-dropdown :linkActive="Request::is('admin/industryType*') || Request::is('admin/profession*')
                            ? true
                            : false" :subLinkActive="Request::is('admin/industryType*') || Request::is('admin/profession*')
                            ? true
                            : false" icon="fas fa-users-cog">
                            @slot('title')
                                {{ __('attributes') }}
                            @endslot
                            <!-- ======= Industrytype ======== -->
                            <ul class="nav nav-treeview">
                                @if (userCan('industry_types.view'))
                                    <x-admin.sidebar-list :linkActive="Request::is('admin/industryType*') ? true : false" route="industryType.index"
                                        icon="fas fa-industry">
                                        {{ __('industry_type') }}
                                    </x-admin.sidebar-list>
                                @endif

                                <!-- ======= professions ======== -->
                                @if (userCan('professions.view'))
                                    <x-admin.sidebar-list :linkActive="Request::is('admin/profession*') ? true : false" route="profession.index"
                                        icon="fas fa-id-card">
                                        {{ __('professions') }}
                                    </x-admin.sidebar-list>
                                @endif
                            </ul>
                        </x-admin.sidebar-dropdown>
                    @endif

                    @if (userCan('post.view') || userCan('country.view') || userCan('state.view') || userCan('city.view') || userCan('newsletter.view') || userCan('newsletter.sendmail') || userCan('contact.view') || userCan('testimonial.view') || userCan('admin.view'))
                        <li class="nav-header text-uppercase">{{ __('others') }}</li>
                    @endif
                    <!-- ======== Blog ====== -->
                    @if (Module::collections()->has('Blog'))
                        @if (userCan('post.view'))
                            <x-admin.sidebar-list :linkActive="Route::is('module.blog.*') || Route::is('module.category.*') ? true : false" route="module.blog.index" parameter=""
                                icon="fas fa-blog">
                                {{ __('blog') }}
                            </x-admin.sidebar-list>
                        @endif
                    @endif

                    <!--=========  Locations ========= -->
                    @if (Module::collections()->has('Location') || Module::collections()->has('Map'))
                        @if (userCan('country.view'))
                            <x-admin.sidebar-dropdown :linkActive="Route::is('module.country*') || Route::is('module.map.*') ? true : false" :subLinkActive="Route::is('module.country*') ? true : false" icon="fas fa-list">
                                @slot('title')
                                    {{ __('location') }}
                                @endslot
                                @if (userCan('country.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.country*') ? true : false" route="module.country.index"
                                            icon="fas fa-circle">
                                            {{ __('country') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('map.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.map.*') ? true : false" route="module.map.index" parameter=""
                                            icon="fas fa-map-marker-alt">
                                            {{ __('map') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                            </x-admin.sidebar-dropdown>
                        @endif
                    @endif

                    <!--=========== News Letter ========= -->
                    @if (Module::collections()->has('Newsletter'))
                        @if (userCan('newsletter.view') || userCan('newsletter.sendmail'))
                            <x-admin.sidebar-dropdown :linkActive="Route::is('module.newsletter*') ? true : false" :subLinkActive="Route::is('module.newsletter*') ? true : false"
                                icon="nav-icon fas fa-envelope">
                                @slot('title')
                                    {{ __('newsletter') }}
                                @endslot
                                @if (userCan('newsletter.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.newsletter.index') ? true : false" route="module.newsletter.index"
                                            icon="fas fa-circle">
                                            {{ __('email_list') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('newsletter.sendmail'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.newsletter.send_mail') ? true : false" route="module.newsletter.send_mail"
                                            icon="fas fa-circle">
                                            {{ __('send_mail') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                            </x-admin.sidebar-dropdown>
                        @endif
                    @endif

                    @if (Module::collections()->has('Testimonial') && userCan('testimonial.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.testimonial.index') ||
                        Route::is('module.testimonial.create') ||
                        Route::is('module.testimonial.edit')
                            ? true
                            : false" route="module.testimonial.index" icon="fas fa-star">
                            {{ __('testimonial') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (userCan('faq.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.faq.index') ||
                        Route::is('module.faq.create') ||
                        Route::is('module.faq.edit') ||
                        Route::is('module.faq.category.index') ||
                        Route::is('module.faq.category.create') ||
                        Route::is('module.faq.category.edit')
                            ? true
                            : false" route="module.faq.index" icon="fas fa-question-circle">
                            {{ __('faq') }}
                        </x-admin.sidebar-list>
                    @endif

                    <!--=========== User Role And Permission ========= -->
                    @if (userCan('admin.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('user.*') ? true : false" route="user.index" parameter="" icon="fas fa-users">
                            {{ __('user_role_manage') }}
                        </x-admin.sidebar-list>
                    @endif
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer pt-3 border-top border-secondary">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link bg-primary text-light">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('visit_website') }}</p>
                        </a>
                    </li>
                    @if (userCan('setting.view'))
                        <x-admin.sidebar-list :linkActive="request()->is('admin/settings/*') ? true : false" route="settings.general" icon="fas fa-cog">
                            {{ __('settings') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-item">
                        <a href="javascript:void(0" class="nav-link"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('log_out') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none invisible">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
