<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Notifications\MembershipUpgradeNotification;

class PaystackController extends Controller
{
    use PaymentTrait;

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);
        $amount = currencyConversion($plan->price, null, 'ZAR');

        session(['order_payment' => [
            'payment_provider' => 'paystack',
            'amount' => $amount,
            'currency_symbol' => '₦',
            'usd_amount' =>  $converted_amount,
        ]]);

        $secret_key = config('zakirsoft.paystack_key');
        $curl = curl_init();
        $callback_url = route('paystack.success'); // url to go to after payment

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount * 100,
                'email' => auth('user')->user()->email,
                'callback_url' => $callback_url,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . $secret_key, //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            return redirect()->back()->with('error', $err);
        }

        $tranx = json_decode($response, true);
        session(['paystack_request' => $request->all()]);
        if (!$tranx['status']) {
            session(['transaction_id' => $request['reference'] ?? null]);

            return redirect()->back()->with("error", $tranx['message']);
        }
        return redirect($tranx['data']['authorization_url']);
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function successPaystack(Request $request)
    {
        $paystack_request = session('paystack_request');

        if ($request['trxref'] === $request['reference']) {
            $this->orderPlacing();
        }

        session()->flash('error', 'Something went wrong.');
        return back();
    }
}
