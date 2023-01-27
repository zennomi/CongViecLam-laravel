@props(['user'])

<form action="{{ route('company.profile.complete', auth()->user()->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="field" value="contact">
    <fieldset>
        <div class="form-card mb-4">
            <div class="dashboard-account-setting-item pb-0">
                <h6>{{ __('company_location') }}
                    <span class="text-danger">*</span>
                    <small class="h6">
                        ({{ __('click_to_add_a_pointer') }})
                    </small>
                </h6>
                <div class="row">
                    <x-website.map.map-warning/>
                    @php
                        $map = setting('default_map');
                    @endphp
                    <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}" id='map-box'>
                    </div>
                    <div id="google-map-div" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                        <input id="searchInput" class="mapClass" type="text" placeholder="Enter a location">
                        <div class="map mymap" id="google-map"></div>
                    </div>
                    @error('location')
                        <span class="ml-3 text-md text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="dashboard-account-setting-item">
                <h6>{{ __('phone_email') }}</h6>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('phone') }}
                            <x-forms.required />
                        </label>
                        <input class="phonecode @error('phone') is-invalid border-danger @enderror" name="phone"
                            type="number" value="{{ old('phone', $user->contactInfo->phone) }}"
                            placeholder="{{ __('phone') }}" />
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('email') }}
                            <x-forms.required />
                        </label>
                        <div class="fromGroup has-icon2">
                            <div class="form-control-icon">
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    type="email" placeholder="{{ __('email_address') }}"
                                    value="{{ old('email', $user->contactInfo->email) }}">
                                <div class="icon-badge-2">
                                    <x-svg.envelope-icon width="24" height="24" />
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback  d-block" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        <a href="{{ url('company/account-progress?social') }}">
            <button type="button" class="btn previous bg-gray-50 rt-mr-8">
                {{ __('previous') }}
            </button>
        </a>
        <button type="submit" class="btn next btn-primary hide-menu-btn">
            <span class="button-content-wrapper ">
                <span class="button-icon align-icon-right">
                    <i class="ph-arrow-right"></i>
                </span>
                <span class="button-text">
                    {{ __('save_next') }}
                </span>
            </span>
        </button>
    </fieldset>
</form>

<script>
    function getState(value) {
        var country_id = value;
        $.ajax({
            url: "{{ route('company.getStateByCountry') }}",
            type: "POST",
            data: {
                country_id: country_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#state_id').html(
                    '<option value="">{{ __('select_one') }}</option>');
                $.each(result, function(key, value) {
                    $("#state_id").append('<option value="' +
                        value.id + '">' + value.name +
                        '</option>');
                });
            }
        });
    }

    function getCity(value) {
        var state_id = value;
        $.ajax({
            url: "{{ route('company.getCityByCountry') }}",
            type: "POST",
            data: {
                state_id: state_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#city_id').html(
                    '<option value="">{{ __('select_one') }}</option>');
                $.each(result, function(key, value) {
                    $("#city_id").append('<option value="' +
                        value.id + '">' + value.name +
                        '</option>');
                });
            }
        });
    }
</script>
