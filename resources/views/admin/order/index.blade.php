@extends('admin.layouts.app')

@section('title')
    {{ __('orders') }}
@endsection

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('orders') }}</h3>
                            @if (request('company') || request('provider') || request('plan') || request('sort_by'))
                                <div>
                                    <a href="{{ route('order.index') }}"
                                        class="btn bg-danger"><i
                                            class="fas fa-times"></i> &nbsp;{{ __('clear') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form id="filterForm" action="{{ route('order.index') }}" method="GET">
                        <div class="card-body border-bottom row">
                            <div class="col-3">
                                <label>{{ __('companies') }}</label>
                                <select name="company" class="form-control select2bs4 w-100-p">
                                    <option {{ request('company') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($companies as $company)
                                        <option {{ request('company') == $company->id ? 'selected' : '' }}
                                            value="{{ $company->id }}">{{ $company->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label>{{ __('payment_provider') }}</label>
                                <select name="provider" id="filter" class="form-control w-100-p">
                                    <option {{ request('provider') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    <option {{ request('provider') == 'paypal' ? 'selected' : '' }} value="paypal">
                                        {{ __('paypal') }}
                                    </option>
                                    <option {{ request('provider') == 'stripe' ? 'selected' : '' }} value="stripe">
                                        {{ __('stripe') }}
                                    </option>
                                    <option {{ request('provider') == 'razorpay' ? 'selected' : '' }} value="razorpay">
                                        {{ __('razorpay') }}
                                    </option>
                                    <option {{ request('provider') == 'paystack' ? 'selected' : '' }} value="paystack">
                                        {{ __('paystack') }}
                                    </option>
                                    <option {{ request('provider') == 'sslcommerz' ? 'selected' : '' }} value="sslcommerz">
                                        {{ __('sslcommerz') }}
                                    </option>
                                    <option {{ request('provider') == 'instamojo' ? 'selected' : '' }} value="instamojo">
                                        {{ __('instamojo') }}
                                    </option>
                                    <option {{ request('provider') == 'flutterwave' ? 'selected' : '' }}
                                        value="flutterwave">
                                        {{ __('flutterwave') }}
                                    </option>
                                    <option {{ request('provider') == 'mollie' ? 'selected' : '' }} value="mollie">
                                        {{ __('mollie') }}
                                    </option>
                                    <option {{ request('provider') == 'midtrans' ? 'selected' : '' }} value="midtrans">
                                        {{ __('midtrans') }}
                                    </option>
                                    <option {{ request('provider') == 'offline' ? 'selected' : '' }} value="offline">
                                        {{ __('offline') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label>{{ __('plan') }}</label>
                                <select name="plan" class="form-control w-100-p">
                                    <option {{ request('plan') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($plans as $plan)
                                        @if ($plan->frontend_show)
                                            <option {{ request('plan') == $plan->id ? 'selected' : '' }}
                                                value="{{ $plan->id }}">{{ $plan->label }}</option>
                                        @endif
                                    @endforeach
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
                    <div class="card-body text-center table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('order_no') }}</th>
                                    <th>{{ __('transaction_no') }}</th>
                                    <th>{{ __('plan_name') }}</th>
                                    <th>{{ __('payment_provider') }}</th>
                                    <th>{{ __('company') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('created_time') }}</th>
                                    <th>{{ __('payment_status') }}</th>
                                    @if (userCan('order.download'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>
                                            #{{ $order->order_id }}
                                        </td>
                                        <td>
                                            {{ $order->transaction_id }}
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $order->plan->label }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($order->payment_provider == 'offline')
                                                Offline
                                                @if (isset($order->manualPayment) && isset($order->manualPayment->name))
                                                    (<b>{{ $order->manualPayment->name }}</b>)
                                                @endif
                                            @else
                                                {{ ucfirst($order->payment_provider) }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('company.show', $order->company->id) }}">
                                                {{ $order->company->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            ${{ $order->amount }}
                                        </td>
                                        <td class="text-muted">
                                            {{ formatTime($order->created_at, 'M d, Y') }}
                                        </td>
                                        <td>
                                            @if ($order->payment_status == 'paid')
                                                <span class="badge badge-pill bg-success">{{ __('paid') }}</span>
                                            @else
                                                <span class="badge badge-pill bg-warning">{{ __('unpaid') }}</span> <br>
                                                <a onclick="return confirm('{{ __('are_you_sure') }}')"
                                                    href="{{ route('manual.payment.mark.paid', $order->id) }}">{{ __('mark_as_paid') }}</a>
                                            @endif
                                        </td>
                                        <td class="d-flex ">
                                            <a href="{{ route('order.show', $order->id) }}" class="btn bg-primary mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if (userCan('order.download'))
                                                <form
                                                    action="{{ route('admin.transaction.invoice.download', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="empty py-5">
                                                <x-not-found message="{{ __('no_data_found') }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($orders->total() > $orders->count())
                        <div class="mt-3 d-flex justify-content-center">{{ $orders->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('#filterForm').on('change', function() {
            $(this).submit();
        })

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
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
