@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('post-details');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($post->image) }}
@endsection
@section('title')
    {{ $post->title }}
@endsection

@section('main')
    <div class="breadcrumbs breadcrumbs-height">
        <div class="container">
            <div class="breadcrumb-menu">
                <h6 class="f-size-18 m-0">{{ __('blog_deatils') }}</h6>
                <ul>
                    <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                    <li>/</li>
                    <li>{{ __('blog_deatils') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="blog-content-area rt-pt-50 rt-mb-100 rt-mb-md-20">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 single-blog-page">
                    <article class="single-blog-post blog-post hover-shadow:none">
                        <h4 class="rt-mb-24">{{ $post->title }}</h4>
                        <div class="entry-meta align-items-center">
                            <a class="author-img-link d-flex align-items-center" href="#">
                                <img src="assets/images/all-img/authur-img.png" alt="" class="rt-mr-12">
                                <span class="body-font-3 text-gray-700"> {{ $post->author->name }}</span>
                            </a>
                            <a class="date" href="#">
                                <i class="ph-calendar-blank"></i>
                                {{ date('M d, Y', strtotime($post->created_at)) }}
                            </a>
                            @if (count($post->comments) != 0)
                                <a class="comment" href="{{ route('website.post', $post->slug) }}#comments">
                                    <i class="ph-chat-circle-dots"></i>
                                    {{ $post->commentsCount() }} {{ __('comments') }}
                                </a>
                            @endif
                        </div>
                        <div class="rt-pt-30 mt-3">
                            <img src="{{ url($post->image) }}" alt="" class="w-100 object-fit">
                        </div>
                        <br>
                        <h6 class="rt-mb-24">
                            {{ $post->short_description }}
                        </h6>
                        <div class="body-font-3 text-gray-600">
                            {!! $post->description !!}
                        </div>
                        <br>
                        <div class="rt-spacer-60"></div>
                        <ul class="rt-list gap-8">
                            <li class="d-inline-block body-font-3">
                                {{ __('share_this_job') }}
                            </li>
                            <li class="d-inline-block ms-3">
                                <button class="btn btn-outline-plain">
                                    <span class="f-size-18 text-primary-500"> <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="iconify iconify--bx" width="1em" height="1em"
                                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"
                                            data-icon="bx:bxl-facebook">
                                            <path
                                                d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"
                                                fill="currentColor"></path>
                                        </svg></span>
                                    <a
                                        href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}">{{ __('facebook') }}</a>
                                </button>
                            </li>
                            <li class="d-inline-block">
                                <button class="btn btn-outline-plain">
                                    <span class="f-size-18 text-twitter"> <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="iconify iconify--bx" width="1em" height="1em"
                                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"
                                            data-icon="bx:bxl-twitter">
                                            <path
                                                d="M19.633 7.997c.013.175.013.349.013.523c0 5.325-4.053 11.461-11.46 11.461c-2.282 0-4.402-.661-6.186-1.809c.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721a4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062c.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973a4.02 4.02 0 0 1-1.771 2.22a8.073 8.073 0 0 0 2.319-.624a8.645 8.645 0 0 1-2.019 2.083z"
                                                fill="currentColor"></path>
                                        </svg></span>
                                    <a
                                        href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}">{{ __('twitter') }}</a>
                                </button>
                            </li>
                        </ul>
                    </article>

                    <div class="comments-elemenst rt-pt-100 rt-pt-md-50" id="comments">
                        <h6 class="rt-mb-32">{{ __('write_a_comment') }}</h6>
                        <form action="{{ route('website.comment', $post->slug) }}" class="rt-mb-50" method="post">
                            @csrf
                            <textarea rows="4" name="body" placeholder="{{ __('share_your_thoughts_on_this_post') }}?"
                                class="rt-mb-15"></textarea>
                            @auth()
                                <button type="submit" class="btn btn-primary">{{ __('post_a_comment') }}</button>
                            @else
                                <button type="submit"
                                    class="btn btn-primary login_required">{{ __('post_a_comment') }}</button>
                            @endauth
                        </form>
                        <ul class="comments-list rt-list">
                            @forelse ($post->comments as $comment)
                                <li class="single-comments">
                                    <div class="rt-single-icon-box rt-mb-15">
                                        <div class="icon-thumb rt-mr-16">
                                            <div class="user-img">
                                                <img src="{{ url($comment->user->image) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="iconbox-content body-font-3 text-gray-700">
                                            <a class="user-name ft-wt-5 rt-mb-4 text-gray-900 hover:text-primary-500"
                                                href="#">{{ $comment->user->name }}</a>
                                            <span
                                                class="d-block body-font-4 text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="body-font-3 text-gray-700">
                                        {!! nl2br($comment->body) !!}
                                    </div>
                                    <div class="body-font-4 mt-3">
                                        <button id="replies-{{ $comment->id }}" data-id="{{ $comment->id }}"
                                            class="btn btn-primary btn-sm reply"
                                            onclick="showHideForm('reply-{{ $comment->id }}')">
                                            {{ __('reply') }}
                                        </button>
                                        <form id="reply-{{ $comment->id }}"
                                            action="{{ route('website.comment', $post->slug) }}" class="rt-mb-50 d-none"
                                            method="post">
                                            @csrf
                                            <hr>
                                            <h6 class="rt-mb-32 rt-mt-32 mt-3">
                                                {{ __('write_a_reply') }}</h6>
                                            <textarea rows="4" name="body" placeholder="{{ __('share_your_thoughts_on_this_comment') }}?"
                                                class="rt-mb-15"></textarea>
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            @auth('user')
                                                <button type="submit" class="btn btn-primary btn-inline">
                                                    {{ __('post_a_reply') }}
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-primary login_required">
                                                    {{ __('post_a_reply') }}
                                                </button>
                                            @endauth
                                        </form>
                                    </div>
                                    @if (count($comment->replies) > 0)
                                        @foreach ($comment->replies as $reply)
                                <li class="single-comments">
                                    <div class="rt-single-icon-box rt-mb-15">
                                        <div class="icon-thumb rt-mr-16">
                                            <div class="user-img">
                                                <img src="{{ url($reply->user->image) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="iconbox-content body-font-3 text-gray-700">
                                            <a class="user-name ft-wt-5 rt-mb-4 text-gray-900 hover:text-primary-500"
                                                href="#">{{ $reply->user->name }}</a>
                                            <span
                                                class="d-block body-font-4 text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="body-font-3 text-gray-700">
                                        {!! nl2br($reply->body) !!}
                                    </div>
                                </li>
                            @endforeach
                            @endif
                            </li>
                        @empty
                            <p>{{ __('no_comments') }}</p>
                            @endforelse
                        </ul>
                        <div class="rt-spacer-24"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="rt-spacer-80 rt-spacer-md-40"></div>

@endsection

@section('script')
    <script>
        function showHideForm(id) {
            var value = document.getElementById(id).style.display;
            var button = '#replies-' + id.slice(-1);
            if (value == 'none') {
                document.getElementById(id).classList.add('d-none');
                $(button).hide();
            } else {
                document.getElementById(id).classList.remove('d-none');
                $(button).show();
            }
        }
    </script>
@endsection
