<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name') }} | Invoice </title>
    <style>
        /* Font Include */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        .main-body {
            font-family: 'Roboto', sans-serif;
            background: #E6E6E6;
        }

        .invoice {
            font-family: 'Roboto', sans-serif;
            background: #FFFFFF;
            /* padding: 30px 2px; */
            margin: 0 auto;
        }

        .invoice[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            padding: 0;
            margin: 0;
            width: 705px;
        }

        .bb {
            border-bottom: 3px solid var(--darkWhite);
        }

        /* Top Section */
        .top-content {
            font-family: 'Roboto', sans-serif;
            padding-bottom: 20px;
            margin-bottom: 30px;
            border-bottom: 1px solid #D2D5D9;
        }

        .top-left h4 {
            padding-top: 10px;
        }

        .top-left p {
            color: #21232A;
            margin: 0px;
            font-size: 14px;
        }

        .logo {
            background: #F0F5FE;
            max-width: 200px;
            margin-left: auto;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        /* User Store Section */
        .bill-to-content {
            padding-bottom: 25px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .bill-to-content-left p {
            color: #21232A;
            margin: 0;
            font-size: 14px;
        }

        .bill-to-content h2 {
            font-family: 'Roboto', sans-serif;
        }

        .bill-to-content-left,
        .bill-to-content-right,
        .balance-info-left,
        .balance-info-right,
        .top-left,
        .top-right {
            width: 49.6%;
            margin: 0;
            display: inline-block;
        }

        .bill-to-content-right {
            margin-top: 20px;
        }

        .bill-to-content-right table,
        .balance-info-right table {
            width: max-content;
            margin-left: auto;
        }

        .balance-info-right table tbody tr td:last-child {
            text-align: right;
        }

        .bill-to-content-right td,
        .balance-info-right td {
            padding: 8px 18px;
        }

        .bill-to-content-right h4,
        .balance-info-right h4 {
            margin: 0px;
        }

        .table-row-bg {
            color: #000;
            background: #D2D5D9;
        }

        /* Product Section */
        .table {
            width: calc(100% - 10px);
            width: 100%;
            overflow: scroll;
        }

        .product-area .table thead tr {
            color: #000;
            font-weight: 700;
            background: #D2D5D9;
        }

        .item-col {
            max-width: 120px;
        }

        .description-col {
            max-width: 200px;
        }

        .table tr td {
            overflow: hidden;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            font-size: 14px;
            padding: 10px 15px;
            margin: 0px;
            border-bottom: 1px solid #D2D3D9;
        }

        /* Balance Info Section */
        .balance-info {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-top: 100px;
        }

        #invoice-text {
            width: 140px !important;
        }
    </style>
</head>

<body class="main-body">
    <div class="invoice page-break" size="A4">
        <section class="top-content bb">
            <div class="top-left">
                <div>
                    <h4>Company Information:</h4>
                </div>
                <div>
                    <p>{{ $transaction->company->user->name }}</p>
                    <p>{{ $transaction->company->user->email }}</p>
                    <p>{{ $transaction->company->user->contactInfo->address }}</p>
                </div>
            </div>
            <div class="top-right">
                <div class="logo">
                    <img src="{{ $logo }}" alt="" class="img-fluid">
                </div>
            </div>
        </section>

        <section class="bill-to-content mt-5">
            <div class="bill-to-content-right">
                <table cellspacing="0">
                    <tr>
                        <td id="invoice-text">
                            <h4>INVOICE</h4>
                        </td>
                        <td>
                            #{{ $transaction->order_id }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>INVOICE DATE</h4>
                        </td>
                        <td>
                            {{ formatTime($transaction->created_at, 'M d, Y') }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="product-area mt-4">
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <td class="item-col">Plan</td>
                        <td class="description-col">Description</td>
                        <td>Payment</td>
                        <td>Benefits</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="item-col">
                            {{ $transaction->plan->label }}
                        </td>
                        <td class="description-col">
                            {{ $transaction->plan->description }}
                        </td>
                        <td>
                            {{ ucfirst($transaction->payment_provider) }}
                        </td>
                        <td>
                            <span>Job Limit : {{ $transaction->plan->job_limit }}</span> <br>
                            <span>Featured Job Limit : {{ $transaction->plan->featured_job_limit }}</span> <br>
                            <span>Highlight Job Limit : {{ $transaction->plan->highlight_job_limit }}</span> <br>
                            <span>Candidate CV View Limit : {{ $transaction->plan->candidate_cv_view_limit }}</span>
                            <br>
                        </td>
                        <td>
                            {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="balance-info">
            <div class="balance-info-right">
                <table cellspacing="0">
                    <tr class="table-row-bg">
                        <td>
                            <h4>TOTAL</h4>
                        </td>
                        <td>
                            {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
