@extends('admin.settings.setting-layout')

@section('title')
    {{ __('seo') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('seo') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
<div class="alert alert-warning mb-3">
    Improve your site ranking by adding SEO information to your pages.
    <hr class="my-2">
    SEO is crucial because it makes your website more visible, and that means more traffic and more opportunities to convert prospects into customers. Check out the SEO tools you can use for optimal ranking.
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3 class="card-title line-height-36">{{ __('Seo Page List') }}</h3>
            <div>
                <a href="{{ route('settings.generateSitemap') }}" class="btn btn-primary">Generate Sitemap</a>
                <a target="_blank" href="/sitemap.xml" class="btn btn-info">View Sitemap</a>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap table-bordered">
            <thead class="text-center">
                <tr>
                    <th width="50">#</th>
                    <th style="max-width: 300px;"> Page Name </th>
                    <th style="max-width: 300px;"> Meta Title </th>
                    <th style="max-width: 500px;"> Meta Description </th>
                    <th width="250">Page Preview Image </th>
                    <th width="100">{{ __('action') }}</th>
                </tr>
            </thead>
            <tbody>
                @if ($seos->count() > 0)
                    @foreach ($seos as $seo)
                        <tr class="text-center">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <div class="badge badge-primary">{{ $seo->page_slug }}</div>
                            </td>
                            <td style="max-width: 300px; white-space: normal">{{ $seo->title }}</td>
                            <td style="max-width: 500px; white-space: normal">
                                {{ $seo->description }}
                            </td>
                            <td>
                                <img style="height: auto; width: 200px; object-fit: contain" src="{{ asset($seo->image) }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('settings.seo.edit', $seo->id) }}"
                                    class="btn btn-secondary mr-2">
                                    <i class="fas fa-cog"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-center">
                            <x-admin.not-found word="{{ __('SEO') }}" route="module.seo.index"
                                method="GET" />
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
