@extends('admin.settings.setting-layout')

@section('title')
    {{ __('orders_details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>
                                    {{ __('orders_details') }}: #{{ $order->order_id }}
                                </h5>
                                <h5>
                                    {{ __('transaction_no') }}: {{ $order->transaction_id }}
                                </h5>
                                <p class="">
                                    {{ Carbon\Carbon::parse($order->created_at)->format('F d, Y, H:i A') }}
                                </p>

                                @if ($order->payment_status == 'paid')
                                    <span class="badge badge-pill bg-success">{{ __('paid') }}</span>
                                @else
                                    <span class="badge badge-pill bg-warning">{{ __('unpaid') }}</span>
                                @endif
                            </div>
                            <form action="{{ route('admin.transaction.invoice.download', $order->id) }}" method="POST"
                                id="invoice_download_form">
                                @csrf
                                <a target="_blank" onclick="$('#invoice_download_form').submit()" href="javascript:void(0)"
                                    class="">
                                    <b><i class="fas fa-download"></i>
                                        {{ __('download_invoice') }}
                                    </b>
                                </a>
                                @if ($order->payment_status == 'unpaid')
                                    <div class="mt-5">
                                        <a onclick="return confirm('{{ __('are_you_sure') }}')"
                                            href="{{ route('manual.payment.mark.paid', $order->id) }}">
                                            {{ __('mark_as_paid') }}
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                                <h5 class="mb-3">{{ __('billing_address') }}</h5>
                                <h6 class="mb-2">{{ $order->company->user->name }}</h6>
                                <p class="mb-0"> <strong>{{ __('email') }}: </strong><a
                                        href="mailto:{{ $order->company->user->email }}">{{ $order->company->user->email }}</a>
                                </p>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <h5 class="mb-3">{{ __('payment_method') }}</h5>
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h6 class="mb-0">{{ __('method') }}: <strong>

                                                @if ($order->payment_provider == 'offline')
                                                    Offline
                                                    @if (isset($order->manualPayment) && isset($order->manualPayment->name))
                                                        (<b>{{ $order->manualPayment->name }}</b>)
                                                    @endif
                                                @else
                                                    {{ ucfirst($order->payment_provider) }}
                                                @endif
                                            </strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h5 class="mb-3">{{ __('plan_details') }}</h5>
                                <h6 class="mb-2">{{ __('name') }}:
                                    <strong>{{ $order->plan->label }}</strong>
                                </h6>
                                <p class="mb-1">{{ __('description') }}: {{ $order->plan->description }}</p>
                                <p class="mb-0">{{ __('price') }}:
                                    <strong>{{ $order->currency_symbol }}{{ $order->amount }}</strong>
                                </p>

                            </div>
                            <div class="col-md-12 col-lg-12 mt-5">
                                <h5 class="mb-3">{{ __('plan_benefits') }}</h5>
                                <h6 class="mb-2">{{ __('job_limit') }}:
                                    <strong>{{ $order->plan->job_limit }} {{ __('jobs') }}</strong>
                                </h6>
                                <p class="mb-1">{{ __('featured_job_limit') }}:
                                    <strong>{{ $order->plan->featured_job_limit }} {{ __('jobs') }}</strong>
                                </p>
                                <p class="mb-1">{{ __('highlight_job_limit') }}:
                                    <strong>{{ $order->plan->highlight_job_limit }} {{ __('jobs') }}</strong>
                                </p>
                                <p class="mb-1">{{ __('candidate_cv_preview_limit') }}:
                                    <strong>{{ $order->plan->candidate_cv_view_limit }} {{ __('times') }}</strong>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #343a40;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #343a40;
        }
    </style>
@endsection
