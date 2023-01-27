@extends('admin.settings.setting-layout')
@section('title')
    {{ __('custom_css_and_js') }}
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
                <li class="breadcrumb-item active">{{ __('custom_css_and_js') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('custom_css_and_JS') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('custom_css_and_JS') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="alert alert-warning mb-3">
        Use this feature to integrate any third party integration tool using their verification method. For Example, 
        <a target="_blank" href="https://search.google.com/search-console"> Google Search Console</a>, 
        <a target="_blank" href="https://analytics.google.com/"> Google Analytics</a>, 
        <a target="_blank" href="https://www.facebook.com/business/tools/meta-pixel"> Facebook Pixel</a>, 
        <a target="_blank" href="https://www.hubspot.com/"> Hubspot Verification</a>, 
        <a target="_blank" href="https://zoho.com"> Zoho Verification</a>, 
        <a target="_blank" href="https://help.pinterest.com/en/business/article/claim-your-website"> Pinterest verification</a>, and many more
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('custom_css_and_js') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-12">
                <div class="">
                    <div class="card-body">
                        <form action="{{ route('settings.custom.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <x-forms.label name="header_custom_style_before_head_end" :required="false" />
                                <textarea name="header_css" id="headerCss" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_css }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_style_with_style_tag_like') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;style&gt;
                                        .header-custom-style {
                                        color: red;
                                        }
                                        &lt;/style&gt;
                                    </code>
                                </span>
                            </div>
                            <div class="form-group">
                                <x-forms.label name="header_custom_script_before_head_end" :required="false" />
                                <textarea name="header_script" id="headerScript" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_script }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_script_with_script_tag_like') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;script&gt;
                                        console.log('Hello World');
                                        &lt;/script&gt;
                                    </code>
                                </span>
                            </div>
                            <div class="form-group">
                                <x-forms.label name="footer_custom_script_before_body_end" :required="false" />
                                <textarea name="body_script" id="bodyScript" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->body_script }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_script_with_script_tag') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;script&gt;
                                        console.log('Hello World');
                                        &lt;/script&gt;
                                    </code>
                                </span>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group">
                                    <button class="btn btn-primary">{{ __('update') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- Create a simple CodeMirror instance -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/addon/foldgutter.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/monokai.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/material.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/material-ocean.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/yonce.css">
@endsection
@section('script')
    <!-- Create a simple CodeMirror instance -->
    <script src="{{ asset('backend') }}/plugins/codemirror/codemirror.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/mode/javascript/javascript.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/mode/css/css.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/addon/active-line.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/addon/closebrackets.js"></script>
    <script>
        let headerCss = document.getElementById('headerCss');
        let headerScript = document.getElementById('headerScript');
        let bodyScript = document.getElementById('bodyScript');

        var editor = CodeMirror.fromTextArea(headerCss, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "css",
        });
        var editor = CodeMirror.fromTextArea(headerScript, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "javascript",
        });
        var editor = CodeMirror.fromTextArea(bodyScript, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "javascript",
        });
    </script>
@endsection
