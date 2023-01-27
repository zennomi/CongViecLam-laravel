<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    use PaymentTrait;

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize(Request $request)
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);
        $amount = currencyConversion($plan->price, null, 'NGN', 1);

        session(['order_payment' => [
            'payment_provider' => 'flutterwave',
            'amount' => $amount,
            'currency_symbol' => '₦',
            'usd_amount' =>  $converted_amount,
        ]]);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $amount,
            'email' => auth('user')->user()->email,
            'tx_ref' => $reference,
            'currency' => 'NGN',
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => auth('user')->user()->email,
                "phone_number" => '123456789',
                "name" => auth('user')->user()->name,
            ],

            "customizations" => [
                "title" => "payment for the job services",
                "description" => date('Y-m-d H:i:s'),
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            session(['transaction_id' => $transactionID ?? null]);
            $this->orderPlacing();
        } elseif ($status ==  'cancelled') {
            return back()->with('error', 'Payment was cancelled');
            //Put desired action/code after transaction has been cancelled here
        } else {
            return back()->with('error', 'Payment was cancelled');
            //Put desired action/code after transaction has failed here
        }
    }
}
