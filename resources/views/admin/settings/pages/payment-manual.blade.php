@extends('admin.settings.setting-layout')

@section('title')
    {{ __('manual_payment_methods') }}
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
                <li class="breadcrumb-item active">{{ __('payment_gateway_setting') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">{{ __('manual_payment_methods') }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('payment_type') }}</th>
                                <th width="10%">{{ __('status') }}</th>
                                <th width="15%">{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($manual_payment_gateways as $payment)
                                <tr>
                                    <td>
                                        {{ $payment->name }}
                                    </td>
                                    <td>{{ ucfirst(Str::replace('_', ' ', $payment->type)) }}</td>
                                    <td tabindex="0">
                                        <a href="#">
                                            <label class="switch ">
                                                <input data-id="{{ $payment->id }}" type="checkbox"
                                                    class="success status-switch"
                                                    {{ $payment->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="contactDetail({{ json_encode($payment) }})"
                                            class="btn btn-warning mt-0 mr-2"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('settings.payment.manual.edit', $payment->id) }}"
                                            class="btn btn-info mt-0 mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('settings.payment.manual.delete', $payment->id) }}"
                                            class="d-inline" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button data-toggle="tooltip" data-placement="top" title="{{ __('delete') }}"
                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-admin.not-found word="language" route="" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if (!empty($manual_payment))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                        <a href="{{ route('settings.payment.manual') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left mr-1"></i>{{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @if (userCan('job_role.create'))
                            <form class="form-horizontal"
                                action="{{ route('settings.payment.manual.update', $manual_payment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <x-forms.label name="name" for="name" :required="true" />
                                    <input id="name" type="text" name="name"
                                        placeholder="{{ __('enter') }} {{ __('name') }}"
                                        value="{{ old('name', $manual_payment->name) }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">
                                        {{ __('payment_type') }}
                                    </label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option {{ $manual_payment->type == 'bank_payment' ? 'selected' : '' }}
                                            value="bank_payment">Bank Payment</option>
                                        <option {{ $manual_payment->type == 'cash_payment' ? 'selected' : '' }}
                                            value="cash_payment">Cash Payment</option>
                                        <option {{ $manual_payment->type == 'check_payment' ? 'selected' : '' }}
                                            value="check_payment">Check Payment</option>
                                        <option {{ $manual_payment->type == 'custom_payment' ? 'selected' : '' }}
                                            value="custom_payment">Custom Payment</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="pt-2">{{ __('description') }}<span
                                            class="text-red font-weight-bold">*</span></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="10">{{ old('description', $manual_payment->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group m-auto">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-plus mr-1"></i>
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <p>{{ __('dont_have_permission') }}</p>
                        @endif
                    </div>
                </div>
            @endif
            @if (empty($manual_payment))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                    </div>
                    <div class="card-body">
                        @if (userCan('job_role.create'))
                            <form class="form-horizontal" action="{{ route('settings.payment.manual.store') }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <x-forms.label name="name" for="name" :required="true" />
                                    <input id="name" type="text" name="name"
                                        placeholder="{{ __('enter') }} {{ __('name') }}"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">
                                        {{ __('payment_type') }}
                                    </label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="bank_payment">Bank Payment</option>
                                        <option value="cash_payment">Cash Payment</option>
                                        <option value="check_payment">Check Payment</option>
                                        <option value="custom_payment">Custom Payment</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="pt-2">{{ __('description') }}<span
                                            class="text-red font-weight-bold">*</span></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group m-auto">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-plus mr-1"></i>
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <p>{{ __('dont_have_permission') }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Message Modal --}}
        <div class="modal fade" id="contactModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('details') }}</h5>
                        <button type="button" class="close" onclick="HideModal()" data-bs-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('name') }}</label>
                            <input class="form-control" id="contact-modal-name" readonly>
                        </div>
                        <div class="form-group">
                            <label>{{ __('payment_type') }}</label>
                            <input type="text" class="form-control" id="contact-modal-type" readonly>
                        </div>
                        <div class="form-group">
                            <label>{{ __('description') }}</label>
                            <textarea class="form-control" rows="10" id="contact-modal-description" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                url: '{{ route('settings.payment.manual.status') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        function HideModal() {
            $("#contactModal").modal('hide');
        }

        function contactDetail(contact) {
            $('#contact-modal-name').val(contact.name);
            $('#contact-modal-type').val(contact.type);
            $('#contact-modal-description').val(contact.description);
            $('#contactModal').modal('show');
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 250px;
        }

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
