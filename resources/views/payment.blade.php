<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ __('payment') }}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            {{-- Paypal --}}
            @if (config('paypal.active') &&
                ((config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret')) ||
                    (config('paypal.live.client_id') && config('paypal.sandbox.client_secret'))))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('paypal_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('paypal')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Stripe --}}
            @if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('stripe_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('stripe')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Razorpay --}}
            @if (config('zakirsoft.razorpay_active') &&
                config('zakirsoft.razorpay_key') &&
                config('zakirsoft.razorpay_secret'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('razor_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('razorpay')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- SSL Commerz --}}
            @if (config('zakirsoft.ssl_active') && config('zakirsoft.ssl_id') && config('zakirsoft.ssl_pass'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('ssl_commerz_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('sslcommerz')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Paystack --}}
            @if (config('zakirsoft.paystack_active') &&
                config('zakirsoft.paystack_key') &&
                config('zakirsoft.paystack_secret'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('paystack_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('paystack')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Flutterwave --}}
            @if (config('zakirsoft.flw_active') &&
                config('zakirsoft.flw_public_key') &&
                config('zakirsoft.flw_secret') &&
                config('zakirsoft.flw_secret_hash'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('flutterwave_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button onclick="pay('flutterwave')" class="btn btn-primary">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Midtrans --}}
            @if (config('zakirsoft.flw_active') &&
                config('zakirsoft.flw_public_key') &&
                config('zakirsoft.flw_secret') &&
                config('zakirsoft.flw_secret_hash'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('midtrans_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" id="pay-button">{{ __('pay_now') }}</button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Mollie --}}
            @if (config('zakirsoft.mollie_key') && config('zakirsoft.mollie_active'))
                <div class="col-xl-6 my-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('mollie_payment') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('mollie.payment') }}" class="btn btn-primary">
                                {{ __('pay_now') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Paypal Form --}}
            <form action="{{ route('paypal.post') }}" method="POST" class="d-none" id="paypal-form">
                @csrf
                <input type="hidden" name="amount" value="100">
                <input type="hidden" name="plan_id" value="1">
            </form>

            {{-- Stripe Form --}}
            <form action="{{ route('stripe.post') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="amount" value="100">
                <input type="hidden" name="plan_id" value="1">

                <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('zakirsoft.stripe_key') }}" data-amount="100 * 100" data-name="{{ config('app.name') }}"
                    data-description="{{ __('money_pay_with_stripe') }}" data-locale="en"
                    data-currency="{{ config('zakirsoft.currency') }}"></script>
            </form>

            {{-- Razorpay Form --}}
            <form action="{{ route('razorpay.post') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="amount" value="100">
                <input type="hidden" name="plan_id" value="1">

                <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ config('zakirsoft.razorpay_key') }}" data-amount="1000" data-buttontext="Pay with Razorpay"
                    data-name="{{ config('app.name') }}" data-description="{{ __('money_pay_with_razorpay') }}"
                    data-prefill.name="Arif" data-prefill.email="arif@mail.com" data-theme.color="#2980b9"
                    data-currency="{{ config('zakirsoft.currency') }}"></script>
            </form>

            {{-- paystack_btn Form --}}
            <form action="{{ route('paystack.post') }}" method="POST" class="d-none" id="paystack-form">
                @csrf
                <input type="hidden" name="amount" value="100">
                <input type="hidden" name="plan_id" value="1">
            </form>

            {{-- SSL Form --}}
            <form method="POST" class="needs-validation d-none" novalidate>
                <input type="hidden" value="100" name="amount" id="total_amount" />
                <input id="ssl_plan_id" type="hidden" name="plan_id" value="1">
                <button class="btn btn-primary" id="sslczPayBtn"
                    token="{{ __('if_you_have_any_token_validation') }}"
                    postdata="{{ __('your_javascript_arrays_or_objects_which_requires_in_backend') }}"
                    order="{{ __('if_you_already_have_the_transaction_generated_for_current_order') }}"
                    endpoint="{{ route('ssl.pay') }}"> {{ __('pay_now') }}
                </button>
            </form>

            {{-- flutterwave Form --}}
            <form action="{{ route('flutterwave.pay') }}" method="POST" class="d-none" id="flutter-form">
                @csrf
                <input type="hidden" name="amount" value="500">
                <input type="hidden" name="plan_id" value="1">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        function pay(method) {
            switch (method) {
                case 'paypal':
                    document.getElementById("paypal-form").submit();
                    break;
                case 'stripe':
                    document.querySelector('.stripe-button-el').click();
                    break;
                case 'razorpay':
                    document.querySelector(".razorpay-payment-button").click();
                    break;
                case 'paystack':
                    document.getElementById("paystack-form").submit();
                    break;
                case 'sslcommerz':
                    document.getElementById("sslczPayBtn").click();
                    break;
                case 'flutterwave':
                    document.getElementById("flutter-form").submit();
                    break;
            }
        }

        // sslcommerz
        var obj = {};
        obj.amount = document.getElementById('total_amount').value;
        obj.plan_id = document.getElementById('ssl_plan_id').value;

        document.getElementById('sslczPayBtn').postdata = obj;

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                @if (config('zakirsoft.ssl_mode') == 'live')
                    // USE THIS FOR LIVE
                    script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(7);
                @else
                    // USE THIS FOR SANDBOX
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(
                            7);
                @endif
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);


        // Midtrans
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
</body>

</html>
