@extends('admin.settings.setting-layout')

@section('title')
    {{ __('preferences') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('preferences') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('preferences') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
<div class="card">
    <div class="card-header">{{ __('contact_info') }}</div>
    <div class="card-body">
        <form action="{{ route('settings.general.update') }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="footer" value="true">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('phone_no') }}:</label>
                        <input type="text" class="form-control @error('footer_phone_no') is-invalid @enderror p-2"
                            name="footer_phone_no" value="{{ $cms_setting->footer_phone_no }}">
                        @error('footer_phone_no')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('address') }}:</label>
                        <textarea class="form-control @error('footer_address') is-invalid @enderror p-2" rows="5" name="footer_address">{{ $cms_setting->footer_address }}</textarea>
                        @error('footer_address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-warning">
                        Leave the social media input field empty to remove the link from website.
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>{{ __('facebook') }}:</label>
                        <input type="text"
                            class="form-control @error('footer_facebook_link') is-invalid @enderror p-2"
                            name="footer_facebook_link" value="{{ $cms_setting->footer_facebook_link }}">
                        @error('footer_facebook_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>{{ __('instagram') }}:</label>
                        <input type="text"
                            class="form-control @error('footer_instagram_link') is-invalid @enderror p-2"
                            name="footer_instagram_link" value="{{ $cms_setting->footer_instagram_link }}">
                        @error('footer_instagram_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>{{ __('twitter') }}:</label>
                        <input type="text"
                            class="form-control @error('footer_twitter_link') is-invalid @enderror p-2"
                            name="footer_twitter_link" value="{{ $cms_setting->footer_twitter_link }}">
                        @error('footer_twitter_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>{{ __('youtube') }}:</label>
                        <input type="text"
                            class="form-control @error('footer_youtube_link') is-invalid @enderror p-2"
                            name="footer_youtube_link" value="{{ $cms_setting->footer_youtube_link }}">
                        @error('footer_youtube_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    @if (userCan('setting.update'))
                        <div class="form-group row text-center justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row justify-content-between">
    <div class="col-md-6">
        <div class="card" id="mode_settings">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('application_mode') }}
                </h3>
            </div>
            <div class="card-body applied-job-on">
                <form class="form-horizontal" action="{{ route('settings.system.mode.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div
                    class="d-flex justify-content-between">
                        <div class="col-md-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="live-mode" name="app_mode" class="custom-control-input" value="live" {{ config('app.mode') == 'live' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="live-mode">
                                    {{ __('live_mode') }}
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="maintenance-mode" name="app_mode" class="custom-control-input" value="maintenance" {{ config('app.mode') == 'maintenance' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="maintenance-mode">
                                    {{ __('maintenance_mode') }}
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="comingsoon-mode" name="app_mode" class="custom-control-input" value="comingsoon" {{ config('app.mode') == 'comingsoon' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="comingsoon-mode">
                                    {{ __('coming_soon_mode') }}
                                </label>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        @if (userCan('setting.update'))
                            <div class="form-group row text-center justify-content-center">
                                <button type="submit" class="btn btn-success" id="setting_button">
                                    <i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("#app_debug").bootstrapSwitch();
        $("#google_analytics").bootstrapSwitch();
        $("#language_changing").bootstrapSwitch();
        $("#search_engine_indexing").bootstrapSwitch();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })


        $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {

            let oldData = event.target.attributes.oldvalue.value;
            let newData = event.currentTarget.checked ? 1 : 0;
            let button = event.target.attributes.button.value;

            if (oldData == newData) {
                $('#' + button).prop('disabled', true);
            } else {
                $('#' + button).prop('disabled', false);
            }
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
