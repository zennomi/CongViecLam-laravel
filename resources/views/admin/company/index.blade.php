@extends('admin.layouts.app')
@section('title')
    {{ __('company_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('company_list') }}</h3>
                           <div>
                                @if (userCan('company.create'))
                                    <a href="{{ route('company.create') }}"
                                        class="btn bg-primary"><i
                                            class="fas fa-plus mr-1"></i> {{ __('create') }}
                                    </a>
                                @endif
                                @if (request('keyword') || request('ev_status') || request('sort_by') || request('organization_type') || request('industry_type'))
                                    <a href="{{ route('company.index') }}"
                                        class="btn bg-danger"><i
                                            class="fas fa-times"></i>&nbsp; {{ __('clear') }}
                                    </a>
                                @endif
                           </div>
                        </div>
                    </div>

                    {{-- Filter  --}}
                    <form id="formSubmit"  action="{{ route('company.index') }}" method="GET" onchange="this.submit();">
                        <div class="card-body border-bottom row">
                            <div class="col-3">
                                <label>{{ __('search') }}</label>
                                <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control" value="{{ request('keyword') }}">
                            </div>
                            <div class="col-2">
                                <label>{{ __('organization_type') }}</label>
                                <select name="organization_type" class="form-control w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($organization_types as $organization_type)
                                        <option {{ request('organization_type') == $organization_type->slug ? 'selected' : '' }} value="{{ $organization_type->slug }}">
                                            {{ $organization_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label>{{ __('industry_type') }}</label>
                                <select name="industry_type" class="form-control w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($industry_types as $industry_type)
                                        <option {{ request('industry_type') == $industry_type->slug ? 'selected' : '' }} value="{{ $industry_type->slug }}">
                                            {{ $industry_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label>{{ __('email_verification') }}</label>
                                <select name="ev_status" class="form-control w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    <option {{ request('ev_status') == 'true' ? 'selected' : '' }} value="true">
                                        {{ __('verified') }}
                                    </option>
                                    <option {{ request('ev_status') == 'false' ? 'selected' : '' }} value="false">
                                        {{ __('not_verified') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label>{{ __('sort_by') }}</label>
                                <select name="sort_by" class="form-control w-100-p">
                                    <option {{ !request('sort_by') || request('sort_by') == 'latest' ? 'selected' : '' }}
                                        value="latest" selected>
                                        {{ __('latest') }}
                                    </option>
                                    <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                        {{ __('oldest') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="card-body table-responsive p-0">
                        @include('admin.layouts.partials.message')
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('logo') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('organization_type') }}</th>
                                    <th>{{ __('establishment_date') }}</th>
                                    @if (userCan('company.update'))
                                        <th>{{ __('account_activation') }}</th>
                                    @endif
                                    @if (userCan('company.update'))
                                        <th>{{ __('email_verification') }}</th>
                                    @endif
                                    @if (userCan('company.update') || userCan('compnay.delete'))
                                        <th width="12%">
                                            {{ __('action') }}
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ $company->logo_url }}" class="rounded" height="50px"
                                                width="50px" alt="">
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('company.show', $company->id) }}">
                                                {{ $company->user->name }}
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $company->organization->name }}</td>
                                        <td class="text-center">
                                            {{ $company->establishment_date ? date('j F, Y', strtotime($company->establishment_date)):'-' }}
                                        </td>
                                        @if (userCan('company.update'))
                                            <td class="text-center" tabindex="0">
                                                <a href="#">
                                                    <label class="switch ">
                                                        <input data-id="{{ $company->user_id }}" type="checkbox"
                                                            class="success status-switch"
                                                            {{ $company->user->status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </a>
                                            </td>
                                        @endif
                                        @if (userCan('company.update'))
                                            <td class="text-center" tabindex="0">
                                                <a href="#">
                                                    <label class="switch ">
                                                        <input data-userid="{{ $company->user_id }}" type="checkbox"
                                                            class="success email-verification-switch"
                                                            {{ $company->user->email_verified_at ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </a>
                                            </td>
                                        @endif
                                        @if (userCan('company.update') || userCan('compnay.delete'))
                                            <td class="text-center">
                                                @if (userCan('company.view'))
                                                    <a href="{{ route('company.show', $company->id) }}"
                                                        class="btn bg-primary"><i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('company.update'))
                                                    <a href="{{ route('company.edit', $company->id) }}"
                                                        class="btn bg-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('company.delete'))
                                                    <form action="{{ route('company.destroy', $company->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
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
                        @if ($companies->count())
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $companies->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $('.status-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });
        $('.email-verification-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('userid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.verify.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });
    </script>
@endsection
