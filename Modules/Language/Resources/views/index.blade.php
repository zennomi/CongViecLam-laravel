@extends('admin.settings.setting-layout')

@section('title')
    {{ __('language_list') }}
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
                <li class="breadcrumb-item active">{{ __('language_list') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 mb-3">
                @php
                    $current_language = currentLanguage() ? currentLanguage() : $defaultLanguage;
                @endphp
                <form action="{{ route('setDefaultLanguage') }}" method="POST">
                    @csrf
                    @method('put')
                    <x-forms.label name="set_default_language" for="inlineFormCustomSelect" class="mr-sm-2" />
                    <div class="d-flex">
                        <select name="code" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option value="" hidden>{{ __('language') }}</option>
                            @foreach ($languages as $language)
                                <option {{ $current_language->code === $language->code ? 'selected' : '' }} value="{{ $language->code }}">
                                    {{ $language->name }}({{ $language->code }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('language_list') }}</h3>
                        <a href="{{ route('languages.create') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-plus"></i>
                            {{ __('create') }}
                        </a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('direction') }}</th>
                                    <th>{{ __('flag') }}</th>
                                    <th width="15%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languages as $key => $language)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $language->name }}
                                            @if (config('zakirsoft.default_language') == $language->code)
                                                <span class="badge badge-pill badge-primary">{{ __('default') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $language->code }}</td>
                                        <td>{{ __($language->direction) }}</td>
                                        <td><i class="flag-icon {{ $language->icon }}"></i></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('languages.view', $language->code) }}" class="btn btn-secondary mr-2">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                            @if ($language->code == 'en')
                                                <a href="javascript:void(0)" class="btn btn-warning mt-0 mr-2"
                                                    data-toggle="tooltip" title="You can't delete or edit this language">
                                                    <i class="fas fa-lock"></i>
                                                </a>
                                            @endif
                                            @if ($language->code != 'en')
                                                <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-info mt-0 mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if ($language->code !== 'en')
                                                    <form action="{{ route('languages.destroy', $language->id) }}"
                                                        class="d-inline" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_language') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            @if (userCan('setting.update'))
                                                <x-admin.not-found word="{{ __('language') }}" route="languages.create" />
                                            @else
                                                <x-admin.not-found word="language" route="" />
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
