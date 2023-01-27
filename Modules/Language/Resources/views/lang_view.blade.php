@extends('admin.settings.setting-layout')

@section('title')
    {{ __('translate_language') }}
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
                <li class="breadcrumb-item active">{{ __('translate_language') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">
                            {{ $language->name }} - {{ __('translate_language') }} (<span>Total : {{ count($translations) }}</span>)
                        </h3>
                        <a href="{{ route('languages.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('translation.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang_id" value="{{ $language->id }}">
                            <div class="row">
                                <table class="table table-striped table-bordered mt-0 pt-0" id="tranlation-table"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="48%">{{ __('english_text') }}</th>
                                            <th width="48%">
                                                <span class="d-flex justify-content-between">
                                                    <span>{{ __('translation_text') }}</span>
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($translations as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="key">{{ ucwords(str_replace('_', ' ', $key)) }}
                                                </td>
                                                <td>
                                                    <span class="d-flex">
                                                        <input type="text" class="form-control value  w-100" name="{{ $key }}" value="{{ $value }}">
                                                        <button type="button"
                                                            onclick="AutoTrans('{{ $key }}', '{{ $value }}', '{{ $language->code }}')"
                                                            class="btn btn-sm ml-1 bg-info">
                                                            {{ __('translate') }}
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="d-flex mx-auto">
                                    <button type="submit" class="lang-btn btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .lang-btn {
            position: fixed;
            left: 50%;
            bottom: 50px;
            width: 200px;
            padding: 15px;
            text-align: center;
            transform: translateX(-50%, 0);
        }

    </style>
@endsection

@section('script')
    <script>
        $('#translating_processing').attr("style", "display: none !important");

        function AutoTrans(key, value, lang) {
            $('#translating_processing').attr("style", "display: block !important");
            $('#translating_processing').show();
            $('.lang-btn').prop('disabled', true);

            $.ajax({
                url: "{{ route('translation.update.auto') }}",
                type: "POST",
                data: {
                    lang: lang,
                    text: value,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('input[name=' + key + ']').val(result);
                    $('.lang-btn').prop('disabled', false);
                    $('#translating_processing').attr("style", "display: none !important");

                    toastr.success('Translated Successfully', 'Success');
                },
                error: function(file, response) {
                    console.log(response);
                    $('#translating_processing').attr("style", "display: none !important");
                    toastr.error('Something went wrong while translating.Please try again', 'Error');
                    setTimeout(() => {
                        $('#translate_all').text('Translate All');
                        $('.lang-btn').prop('disabled', false);
                    }, 1000);
                }
            });
        }
    </script>
@endsection
