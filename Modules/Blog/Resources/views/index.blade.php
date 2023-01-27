@extends('admin.layouts.app')
@section('title')
    {{ __('post_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sticky-note"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_post') }}</span>
                        <span class="info-box-number">
                            {{ $totalPosts ?? '0' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-comments"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_comments') }}</span>
                        <span class="info-box-number">{{ $totalComments ?? '0' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_authors') }}</span>
                        <span class="info-box-number">{{ $totalAuthor ?? '0' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_category') }}</span>
                        <span class="info-box-number">{{ $categories->count() ?? '0' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 p-1">
                                <h3 class="card-title line-height-36">{{ __('post_list') }}</h3>
                            </div>
                            <div class="col align-self-end p-1">
                                @if (request('keyword') || request('category') || request('author') || request('status') || request('sort_by'))
                                    <a href="{{ route('module.blog.index') }}"
                                        class="ml-1 btn btn-danger float-right d-flex align-items-center justify-content-center"><i
                                            class="fas fa-times"></i> &nbsp;{{ __('clear') }}
                                    </a>
                                @endif
                                @if (userCan('post.create'))
                                    <a href="{{ route('module.blog.create') }}"
                                        class="btn btn-primary float-right d-flex align-items-center justify-content-center"><i
                                            class="fas fa-plus"></i>&nbsp;{{ __('create_post') }}</a>
                                @endif
                                <a href="{{ route('module.category.create') }}"
                                    class="btn bg-success float-right d-flex align-items-center mx-1 justify-content-center">
                                    <i class="fas fa-plus"></i>&nbsp;{{ __('create_category') }}
                                </a>
                                <a href="{{ route('module.category.index') }}"
                                    class="btn btn-outline-primary float-right d-flex align-items-center justify-content-center mx-1">
                                    <i class="fas fa-eye"></i>&nbsp;{{ __('all_category') }}
                                </a>
                            </div>
                        </div>
                    </div>


                 {{-- Filter  --}}
                 <form id="formSubmit"  action="{{ route('module.blog.index') }}" method="GET" onchange="this.submit();">
                    <div class="card-body border-bottom row">
                        <div class="col-3">
                            <label>{{ __('search') }}</label>
                            <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control" value="{{ request('keyword') }}">
                        </div>
                        <div class="col-3">
                            <label>{{ __('category') }}</label>
                            <select name="category" class="form-control w-100-p">
                                <option value="" {{ !request('category') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                @foreach ($categories as $category)
                                    <option {{ request('category') == $category->slug ? 'selected' : '' }}
                                        value="{{ $category->slug }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>{{ __('author') }}</label>
                            <select name="author" class="form-control w-100-p">
                                <option value="" {{ !request('author') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                @foreach ($authors as $key => $author)
                                    <option value="{{ $author[0]->author->id }}"
                                        {{ request('author') == $author[0]->author->id ? 'selected' : '' }}>
                                        {{ $author[0]->author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>{{ __('status') }}</label>
                            <select name="status" class="form-control w-100-p">
                                <option value="" {{ !request('status') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                    {{ __('published') }} ({{ $totalPublished ?? '0' }})
                                </option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                                    {{ __('draft') }} ({{ $totalDraft ?? '0' }})
                                </option>
                            </select>
                        </div>
                    </div>
                </form>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('category') }}</th>
                                    <th>{{ __('comments') }}</th>
                                    <th>{{ __('author') }}</th>
                                    <th width="12%">
                                        {{ __('action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $post)
                                    <tr>
                                        <td class="text-center"><img width="50px" height="50px" class="rounded"
                                                src="{{ asset($post->image) }}" alt=""></td>
                                        <td class="text-center">
                                            <a href="{{ route('website.post', $post->slug) }}">{{ $post->title }}</a>
                                        </td>
                                        <td class="text-center">
                                            {{ $post->category->name }}
                                        </td>
                                        <td class="text-center">{{ $post->comments_count }}</td>
                                        <td class="text-center">{{ $post->author->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('website.post', $post->slug) }}#comments"
                                                class="btn bg-success">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            @if (userCan('post.update'))
                                                <a data-toggle="tooltip" data-placement="top" title="{{ __('edit') }}"
                                                    href="{{ route('module.blog.edit', $post->id) }}"
                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('post.delete'))
                                                <form action="{{ route('module.blog.destroy', $post->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('delete') }}"
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                        class="btn bg-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <p>{{ __('no_data_found') }}...</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (request('perpage') != 'all' && $blogs->total() > $blogs->count())
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $blogs->onEachSide(1)->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
