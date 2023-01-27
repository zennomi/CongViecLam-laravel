<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        *:focus {
            outline: none;
        }

        body {

            font-family: "Public Sans", sans-serif;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            color: #000;
            background-color: #fff;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        a {
            text-decoration: none;
            display: inline-block;
        }

        .container {
            width: 100%;
            /* max-width: 1140px; */
            margin: 50px auto;
        }

        section {
            overflow: hidden;
            margin-bottom: 40px;
        }

        .address-details {
            float: right;
        }

        .invoice {
            background-color: #EFEFEF;
            color: #000;
            padding: 15px 10px;
        }

        .footer {
            text-align: center;
        }

        table {
            width: 100%;
        }

        table thead tr {
            background-color: #efefef;
            border: 1px solid gray;
        }

        .invoiced-to {
            padding: 10px
        }

        table tr td {
            border: 1px solid gray;
            padding: 10px;

        }

        .padding-10 {
            padding: 10px !important;
        }

        .invoice-address {
            background: #fff !important;
            width: 100% !important;
            items-align: left !important;
        }

        .invoice-logo {
            background: #fff !important;
            padding: 10px !important;
            width: 50% !important;
            items-align: left !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <section>
            <table class="">
                <thead class="">
                    <tr class="text-left">
                        <th class="invoice-logo">
                            <img src="{{ $logo->dark_logo_url }}" alt="">
                        </th>
                        <p class="invoice-address">
                            {{ $from->address . ' .' }} <br>
                        <p>
                            Phone: {{ $from->phone }}
                        </p>
                    </tr>
                </thead>
            </table>
        </section>
        <section>
            <div class="invoice">
                <h2>Invoice #{{ $transaction->order_id }}</h2>
                <h2>TRANSACTION NO {{ $transaction->transaction_id }}</h2>
                <p>Invoice Date: {{ date('D, M Y', strtotime($transaction->created_at)) }}</p>
                <p>Due Date: {{ date('D, M Y', strtotime($transaction->created_at)) }}</p>
            </div>
        </section>
        <section>
            <div class="invoiced-to">
                <h4>Invoiced To</h4>
                <p>
                    {{ $transaction->company->user->name }} <br />

                    {{ $transaction->company->user->contactInfo->address }}

                    {{ $transaction->company->user->contactInfo->city ? $transaction->company->user->contactInfo->city->name . ',' : '' }}

                    {{ $transaction->company->user->contactInfo->state ? $transaction->company->user->contactInfo->state->name . ',' : '' }}

                    {{ $transaction->company->user->contactInfo->country ? $transaction->company->user->contactInfo->country->name : '' }}
                    <br />
                    Phone: {{ $transaction->company->user->contactInfo->phone }} <br>
                    Email: {{ $transaction->company->user->contactInfo->email }} <br>
                </p>
            </div>
        </section>
        <section>
            <table>
                <thead>
                    <tr class="des">
                        <th class="padding-10">Plan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $transaction->plan->label }}
                        </td>
                        <td> {{ defaultCurrencySymbol() }}{{ $transaction->plan->price }}</td>
                    </tr>
                    <tr>
                        <td>
                            Total
                        </td>
                        <td> {{ defaultCurrencySymbol() }}{{ $transaction->amount }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
