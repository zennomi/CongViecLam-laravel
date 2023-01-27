@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                                <a href="{{ route('module.city.index') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                                </a>
                            </div>
                            <div class="row pt-3 pb-4">
                                <div class="col-md-6 offset-md-3">
                                    <form class="form-horizontal" action="{{ route('module.city.update', $city->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                State
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <select id="stateId" name="state"
                                                    class="form-control @error('state') is-invalid @enderror select2bs4 w-100-p">
                                                    <option value="">
                                                        {{ __('select_state') }}
                                                    </option>
                                                    @foreach ($states as $state)
                                                        <option {{ $city->state_id == $state->id ? 'selected' : '' }}
                                                            value="{{ $state->id }}">
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('state')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                {{ __('city') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <select id="city" name="city"
                                                    class="form-control @error('city') is-invalid @enderror select2bs4 w-100-p">
                                                </select>
                                                @error('city')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-4">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    &nbsp; {{ __('update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- Custom Link -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

    </style>
@endsection
@section('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        var idState = $('#stateId').val();
        Ajax(idState);

        $(document).ready(function() {

            $('#stateId').on('change', function() {
                var idState = this.value;
                Ajax(idState);
            });
        });

        function Ajax(idState) {

            $.ajax({
                url: "{{ route('module.city.state') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(cities) {
                    $('#city').html('');
                    var city = {!! json_encode($city) !!};
                    $.each(cities, function(key, value) {
                        if (cities.length > 0) {
                            $("#city").append('<option id="city' + value.id + '" value="' + value.name +
                                '">' + value.name + '</option>');
                        } else {
                            $('#city').html('<option value="">No City Available !</option>');
                        }
                    });
                    $('#city' + city.id).prop('selected', true);
                    if ($('#city').val() == null) {
                        $('#city').html('<option value="">Select State</option>');
                    }
                }
            });
        }
    </script>
@endsection
