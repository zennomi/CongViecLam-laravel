@extends('setupguide::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('setupguide.name') !!}
    </p>
@endsection

@extends('admin.settings.setting-layout')

@section('title')
    {{ __('language_list') }}
@endsection

@section('website-settings')
    <div class="container-fluid">

    </div>
@endsection
