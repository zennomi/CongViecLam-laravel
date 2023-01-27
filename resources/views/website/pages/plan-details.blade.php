@extends('website.layouts.app')

@section('title')
    {{ __('plan') }} ({{ $plan->label }})
@endsection

@section('main')
    <!-- breedcrumb section end  -->
    <section class="section benefits bgcolor--gray-10 mt-5 pt-5">
        <div class="container">
            <div class="row mt-5 pt-5">
                <h4 class="text-info">{{ __('total_amount_to_pay') }}: {{ currencyPosition($plan->price) }}</h4>
            </div>
            <div class="row py-5">
                <h5>{{ __('online_payment_gatewats') }}</h5>
                @if (config('paypal.active') ||
                    config('zakirsoft.stripe_active') ||
                    config('zakirsoft.razorpay_active') ||
                    config('zakirsoft.paystack_active') ||
                    config('zakirsoft.ssl_active') ||
                    config('zakirsoft.flw_active') ||
                    config('zakirsoft.im_active') ||
                    config('zakirsoft.midtrans_active') ||
                    config('zakirsoft.mollie_active'))

                    {{-- Paypal payment --}}
                    @if (config('paypal.mode') == 'sandbox')
                        @if (config('paypal.active') && config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret'))
                            <div class="col-4 my-2">
                                <div class="card jobcardStyle1">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box">
                                            <div class="iconbox-content">
                                                <div class="body-font-1 rt-mb-12">
                                                    {{ __('paypal') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-info d-flex">
                                            <div class="flex-grow-1">
                                                <button id="paypal_btn" type="button" class="btn btn-primary2-50 d-block">
                                                    {{ __('pay_now') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if (config('paypal.active') && config('paypal.live.client_id') && config('paypal.live.client_secret'))
                            <div class="col-4 my-2">
                                <div class="card jobcardStyle1">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box">
                                            <div class="iconbox-content">
                                                <div class="body-font-1 rt-mb-12">
                                                    {{ __('paypal') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-info d-flex">
                                            <div class="flex-grow-1">
                                                <button id="paypal_btn" type="button" class="btn btn-primary2-50 d-block">
                                                    {{ __('pay_now') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Stripe payment --}}
                    @if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('stripe') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="stripe_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Razorpay payment --}}
                    @if (config('zakirsoft.razorpay_active') &&
                        config('zakirsoft.razorpay_key') &&
                        config('zakirsoft.razorpay_secret'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('razorpay') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="razorpay_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Paystack payment --}}
                    @if (config('zakirsoft.paystack_active') &&
                        config('zakirsoft.paystack_key') &&
                        config('zakirsoft.paystack_secret'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('paystack') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="paystack_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Flutterwave payment --}}
                    @if (config('zakirsoft.flw_public_key') &&
                        config('zakirsoft.flw_secret') &&
                        config('zakirsoft.flw_secret_hash') &&
                        config('zakirsoft.flw_active'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('flutterwave') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="flutter_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Mollie payment --}}
                    @if (config('zakirsoft.mollie_key') && config('zakirsoft.mollie_active'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('mollie') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="mollie_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Instamojo payment --}}
                    @if (config('zakirsoft.im_key') &&
                        config('zakirsoft.im_secret') &&
                        config('zakirsoft.im_url') &&
                        config('zakirsoft.im_active'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('instamojo') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="instamojo_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Midtrans payment --}}
                    @if (config('zakirsoft.midtrans_active') &&
                        config('zakirsoft.midtrans_merchat_id') &&
                        config('zakirsoft.midtrans_client_key') &&
                        config('zakirsoft.midtrans_server_key'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('midtrans') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="midtrans_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- SSl Commerz payment --}}
                    @if (config('zakirsoft.ssl_active') &&
                        config('zakirsoft.ssl_id') &&
                        config('zakirsoft.ssl_pass') &&
                        config('zakirsoft.ssl_mode'))
                        <div class="col-4 my-2">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12">
                                                {{ __('sslcommerz') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <button id="ssl_btn" type="button" class="btn btn-primary2-50 d-block">
                                                {{ __('pay_now') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center">
                        <x-svg.not-found-icon />
                        <h5 class="mt-4">{{ __('no_payment_method_available_here') }}</h5>
                    </div>
                @endif
            </div>
            @if ($manual_payments && count($manual_payments))
                <div class="row mb-5">
                    <h5>{{ __('manual_payment_gateways') }}</h5>
                    @foreach ($manual_payments as $payment)
                        <div class="col-6 my-2">
                            <form action="{{ route('manual.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <div class="card jobcardStyle1">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box">
                                            <div class="iconbox-content">
                                                <div class="body-font-1 rt-mb-12">
                                                    {{ $payment->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <p>{!! $payment->description !!}</p>
                                        <div class="post-info d-flex">
                                            <div class="flex-grow-1">
                                                <button type="submit" class="btn btn-primary2-50 d-block">
                                                    {{ __('confirm_payment') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>

        {{-- Paypal Form --}}
        <form action="{{ route('paypal.post') }}" method="POST" class="d-none" id="paypal-form">
            @csrf
        </form>

        {{-- Stripe Form --}}
        <form action="{{ route('stripe.post') }}" method="POST" class="d-none">
            @csrf
            <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ config('zakirsoft.stripe_key') }}" data-amount="{{ session('stripe_amount') }}"
                data-name="{{ config('app.name') }}" data-description="Money pay with stripe"
                data-locale="{{ app()->getLocale() == 'default' ? 'en' : app()->getLocale() }}" data-currency="USD"></script>
        </form>

        {{-- Razorpay Form --}}
        <form action="{{ route('razorpay.post') }}" method="POST" class="d-none">
            @csrf

            <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config('zakirsoft.razorpay_key') }}" data-amount="{{ session('razor_amount') }}"
                data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}" data-description="Money pay with razorpay"
                data-prefill.name="{{ auth('user')->user()->name }}" data-prefill.email="{{ auth('user')->user()->email }}"
                data-theme.color="#2980b9" data-currency="INR"></script>
        </form>

        {{-- paystack_btn Form --}}
        <form action="{{ route('paystack.post') }}" method="POST" class="d-none" id="paystack-form">
            @csrf
        </form>

        {{-- flutterwave Form --}}
        <form action="{{ route('flutterwave.pay') }}" method="POST" class="d-none" id="flutter-form">
            @csrf
        </form>

        {{-- mollie Form --}}
        <form action="{{ route('mollie.payment') }}" method="POST" class="d-none" id="mollie-form">
            @csrf
        </form>

        {{-- instamojo Form --}}
        <form action="{{ route('instamojo.pay') }}" method="POST" class="d-none" id="instamojo-form">
            @csrf
        </form>

        {{-- SSL Form --}}
        <form method="GET" class="needs-validation d-none" novalidate>
            <input type="hidden" value="{{ session('ssl_amount') }}" name="amount" id="total_amount" />
            <input id="ssl_plan_id" type="hidden" name="plan_id" value="{{ $plan->id }}">
            <button class="btn btn-primary" id="sslczPayBtn" token="if you have any token validation"
                postdata="your javascript arrays or objects which requires in backend"
                order="If you already have the transaction generated for current order"
                endpoint="{{ route('ssl.pay') }}"> {{ __('pay_now') }}
            </button>
        </form>
    </section>
@endsection

@section('script')
    @if (config('zakirsoft.midtrans_active') &&
        config('zakirsoft.midtrans_merchat_id') &&
        config('zakirsoft.midtrans_client_key') &&
        config('zakirsoft.midtrans_server_key'))
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('zakirsoft.midtrans_client_key') }}">
        </script>
    @endif
    <script>
        // Paypal
        $('#paypal_btn').on('click', function(e) {
            e.preventDefault();
            $('#paypal-form').submit();
        });

        // Stripe
        $('#stripe_btn').on('click', function(e) {
            e.preventDefault();
            $('.stripe-button-el').click();
        });

        // Razorpay
        $('#razorpay_btn').on('click', function(e) {
            e.preventDefault();
            $('.razorpay-payment-button').click();
        });

        // Paystack
        $('#paystack_btn').on('click', function(e) {
            e.preventDefault();
            $('#paystack-form').submit();
        });

        // Flutterwave
        $('#flutter_btn').on('click', function(e) {
            e.preventDefault();
            $('#flutter-form').submit();
        });

        // Mollie
        $('#mollie_btn').on('click', function(e) {
            e.preventDefault();
            $('#mollie-form').submit();
        });

        // Instamojo
        $('#instamojo_btn').on('click', function(e) {
            e.preventDefault();
            $('#instamojo-form').submit();
        });

        // Instamojo
        $('#ssl_btn').on('click', function(e) {
            e.preventDefault();
            $('#sslczPayBtn').click();
        });

        // Midtrans
        if (
            '{{ config('zakirsoft.midtrans_active') && config('zakirsoft.midtrans_merchat_id') && config('zakirsoft.midtrans_client_key') && config('zakirsoft.midtrans_server_key') }}'
        ) {

            const payButton = document.querySelector('#midtrans_btn');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                snap.pay('{{ $mid_token }}', {
                    onSuccess: function(result) {
                        successMidtransPayment();
                    },
                    onPending: function(result) {
                        alert('Transaction is in pending state');
                    },
                    onError: function(result) {
                        alert('Transaction is failed. Try again.');
                    }
                });
            });

            function successMidtransPayment() {
                $.ajax({
                    type: "post",
                    url: "{{ route('midtrans.success') }}",
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        window.location.href = response.redirect_url;
                    }
                });
            }
        }

        // ssl commerz
        var obj = {};
        obj.amount = $('#total_amount').val();
        obj.plan_id = $('#ssl_plan_id').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                if ('{{ config('zakirsoft.ssl_mode') }}' == 'sandbox') {
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(
                            7); // USE THIS FOR SANDBOX
                } else {
                    script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(7); // USE THIS FOR LIVE
                }
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>
@endsection
