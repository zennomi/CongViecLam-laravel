@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('blog');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <div class="breadcrumbs breadcrumbs-height">
        <div class="container">
            <div class="breadcrumb-menu">
                <h6 class="f-size-18 m-0">{{ __('blog') }}</h6>
                <ul>
                    <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                    <li>/</li>
                    <li>{{ __('blog') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="blog-content-area rt-pt-50 rt-mb-100 rt-mb-md-20">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 rt-mb-md-30 order-1 order-xl-0">
                    <div class="sidebar-wrapper">
                        <div class="widget widget_search">
                            <form action="{{ route('website.posts') }}" method="GET" id="searchForm">
                                <h2 class="widget-title"> {{ __('search') }} </h2>
                                <div class="fromGroup has-icon2">
                                    <input type="text" placeholder="{{ __('search') }}" name="search"
                                        value="{{ request('search') }}">
                                    <button class="icon-badge rt-ml-12 bg-transparent border-0 no-padding">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                                stroke="{{ $setting->frontend_primary_color }}" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21 21.0004L16.65 16.6504"
                                                stroke="{{ $setting->frontend_primary_color }}" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                                @if ($categories && count($categories))
                                    <hr>
                                    <ul class="rt-list filter_lists">
                                        <li class="d-block has-children open">
                                            <div class="body-font-1 ft-wt-5 rt-mb-20"> {{ __('category') }} </div>
                                            <ul class="sub-catagory rt-list">
                                                @foreach ($categories as $category)
                                                    <li class="d-block rt-mb-15">
                                                        <div class="form-check from-chekbox-custom">
                                                            <input {{ request('category') && in_array($category->slug, request('category')) ? 'checked':'' }}
                                                                class="form-check-input" type="checkbox" value="{{ $category->slug }}"
                                                                id="{{ $category->id }}category" name="category[]">
                                                            <label class="form-check-label pointer text-gray-700 f-size-16"
                                                                for="{{ $category->id }}category">
                                                                {{ $category->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>

                                    <button type="submit" class="btn btn-primary btn-xs mt-4">Filter</button>
                                @endif
                            </form>
                        </div>
                        @if ($recent_posts && count($recent_posts))
                            <div class="widget rt-widget-recent-posts">
                                <h2 class="widget-title">{{ __('recent_post') }}</h2>
                                <ul>
                                    @foreach ($recent_posts as $post)
                                        <li>
                                            <div class="rt-single-icon-box">
                                                <div class="icon-thumb recent-post-img rt-mr-16">
                                                    <img src="{{ url($post->image) }}" alt="">
                                                </div>
                                                <div class="iconbox-content">
                                                    <div class="bofy-font-4 entry-meta rt-mb-10">
                                                        <a href="#"
                                                            class="date text-gray-500 rt-mr-8 hover:text-primary-500">
                                                            {{ date('M d, Y', strtotime($post->created_at)) }}
                                                        </a>
                                                        @if ($post->comments_count != 0)
                                                            <span class="text-gray-500 rt-mr-8">
                                                                <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M4 2C4 3.10457 3.10457 4 2 4C0.89543 4 0 3.10457 0 2C0 0.89543 0.89543 0 2 0C3.10457 0 4 0.89543 4 2Z"
                                                                        fill="#767E94" />
                                                                </svg>
                                                            </span>
                                                            <a href="{{ route('website.post', $post->slug) }}#comments"
                                                                class="comments text-gray-500 hover:text-primary-500">
                                                                {{ $post->comments_count }}
                                                                {{ $post->comments_count == 1 ? __('comment') : __('comments') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('website.post', $post->slug) }}"
                                                        class="body-font-3 text-gray-900 hover:text-primary-500">
                                                        {{ Str::limit($post->short_description, 80) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-8 order-0 order-xl-1">
                    {{-- @if (request('category') || request('search'))
                        <div class="header-top rt-mb-4">
                            <div class="container p-3 rt-ml-2 font-weight-bold">
                                {{ $posts->count() }} {{ __('result_found_for') }}
                                <span class="text-primary">{{ request('category') }}</span>
                                {{ request('search') ? '&' : '' }}
                                <span class="text-primary">{{ request('search') }}</span>
                            </div>
                        </div>
                    @endif --}}
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <article class="blog-list-view rt-single-icon-box blog-post rt-mb-24">
                                <div class="icon-thumb post-img">
                                    <div class="post-thmubnail">
                                        <a href="{{ route('website.post', $post->slug) }}">
                                            <img src="{{ url($post->image) }}" alt="" class="rt-rounded-8 w-100">
                                        </a>
                                    </div>
                                </div>
                                <div class="iconbox-content">
                                    <header class="entry-header">
                                        <div class="entry-meta">
                                            <a class="date" href="#">
                                                <i class="ph-calendar-blank"></i>
                                                {{ date('M d, Y', strtotime($post->created_at)) }}
                                            </a>
                                            @if ($post->comments_count != 0)
                                                <a class="comment"
                                                    href="{{ route('website.post', $post->slug) }}#comments">
                                                    <i class="ph-chat-circle-dots"></i>
                                                    {{ $post->comments_count }}
                                                    {{ $post->comments_count == 1 ? __('comment') : __('comments') }}
                                                </a>
                                            @endif
                                        </div>
                                        <h4 class="entry-title">
                                            <a href="{{ route('website.post', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                    </header><!-- .end entry header -->
                                    <div class="entry-content">
                                        {{ Str::limit($post->short_description, 150) }}
                                    </div>
                                    <div class="entry-footer">
                                        <a href="{{ route('website.post', $post->slug) }}">{{ __('read_more') }} <i
                                                class="ph-arrow-right"></i></a>
                                    </div><!-- /.entry-footer -->
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="card text-center">
                            <x-not-found message="{{ __('no_data_found') }}" />
                        </div>
                    @endif
                    <div class="blog-pagination rt-pt-30 rt-mb-30">
                        <nav>
                            {{ $posts->links('vendor.pagination.frontend') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
