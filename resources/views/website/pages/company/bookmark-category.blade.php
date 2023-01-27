@extends('website.layouts.app')

@section('title', __('bookmark_category'))

@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                <x-website.company.sidebar />
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="row d-flex justify-content-between p-2">
                            <div class="col-sm-12 col-md-6 justify-content-start">
                                <h3 class="f-size-18 lh-1 mb-2">
                                    {{ __('bookmark_category') }}
                                    <span class="text-gray-400">({{ $dataCount }})</span>
                                </h3>
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                                <a href="{{ route('company.bookmark') }}">
                                    <button type="button"
                                        class="btn btn-outline-primary text-center d-flex justify-content-center items-center">
                                        <i class="ph-arrow-left f-size-20 text-primary-500 mr-1 mt-1"></i>
                                        {{ __('back') }}
                                    </button>
                                </a>
                                <div class="sidebar-open-nav ml-3">
                                    <i class="ph-list"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card overflow-hidden">
                                    <div class="">
                                        <div class="db-job-card-table text-center">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="text-start">{{ __('name') }}</th>
                                                        <th class="text-end">{{ strtoupper(__('action')) }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @if ($categories->count() > 0)
                                                        @foreach ($categories as $cat)
                                                            <tr>
                                                                <td>
                                                                    <div class="text-start">
                                                                        <span class="ml-2 text-gray-900 f-size-16  ft-wt-4">
                                                                            {{ $cat->name }}
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="text-end mr-2">
                                                                        <a href="{{ route('company.bookmark.category.edit', $cat->id) }}"
                                                                            class="f-size-25 text-primary-500 p-1 cursor-pointer">
                                                                            <i class="ph-pencil-simple"></i>
                                                                        </a>
                                                                        <a onclick="DataDelete('data-delete-form{{ $cat->id }}')"
                                                                            href="#"
                                                                            class="f-size-25 cursor-pointer text-danger-500 p-1">
                                                                            <i class="ph-trash-simple"></i>
                                                                        </a>
                                                                        <form class="d-none"
                                                                            id="data-delete-form{{ $cat->id }}"
                                                                            action="{{ route('company.bookmark.category.destroy', $cat->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <x-svg.not-found-icon />
                                                                <p class="mt-4">{{ __('no_data_found') }}</p>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @if ($categories->count())
                                                        <tr>
                                                            <td colspan="2" class="text-center p-0">
                                                                {{ $categories->links('vendor.pagination.simple-bootstrap-4') }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="post-job-item rt-mb-15">
                                            <form
                                                action="{{ request()->routeIs('company.bookmark.category.index')
                                                    ? route('company.bookmark.category.store')
                                                    : route('company.bookmark.category.update', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @if (request()->routeIs('company.bookmark.category.index'))
                                                @else
                                                    @method('PUT')
                                                @endif
                                                <div class="rt-mb-20">
                                                    <label for="m" class=" body-font-4 d-block text-gray-900 rt-mb-8">
                                                        @if (request()->routeIs('company.bookmark.category.index'))
                                                            {{ __('create') }}
                                                        @else
                                                            {{ __('update') }}
                                                        @endif
                                                    </label>
                                                    <input name="name"
                                                        @if (request()->routeIs('company.bookmark.category.index')) @else value="{{ $category->name }}" @endif
                                                        class="form-control @error('name') is-invalid @enderror" type="text"
                                                        placeholder="{{ __('name') }}..">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if (request()->routeIs('company.bookmark.category.index'))
                                                    <button type="submit" class="text-center btn btn-primary rt-mr-10">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-icon align-icon-right">
                                                                <i class="ph-plus-circle"></i>
                                                            </span>
                                                            <span class="button-text">
                                                                {{ __('add') }}
                                                            </span>
                                                        </span>
                                                    </button>
                                                @else
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <button type="submit"
                                                                class="text-center btn btn-primary rt-mr-10">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-icon align-icon-right">
                                                                        <i class="ph-pencil-simple"></i>
                                                                    </span>
                                                                    <span class="button-text">
                                                                        {{ __('update') }}
                                                                    </span>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('company.bookmark.category.index') }}"
                                                                class="text-center btn btn-warning rt-mr-10">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-icon align-icon-right">
                                                                        <i class="ph-arrow-left"></i>
                                                                    </span>
                                                                    <span class="button-text">
                                                                        {{ __('back') }}
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500">
            <x-website.footer-copyright />
        </div>
    </div>
@endsection

@section('script')
    <script>
        function DataDelete(id) {
            if (confirm("{{ __('are_you_sure') }}") == true) {
                $('#' + id).submit();
            } else {
                return false;
            }
        }
    </script>
@endsection
