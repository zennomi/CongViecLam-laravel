<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManualPayment;
use Illuminate\Http\Request;
use Modules\SetupGuide\Entities\SetupGuide;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autoPayment()
    {
        abort_if(!userCan('setting.view'), 403);
        return view('admin.settings.pages.payment');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->type) {
            case 'paypal':
               $this->paypalUpdate($request);
                break;
            case 'stripe':
                $this->stripeUpdate($request);
                break;
            case 'razorpay':
                $this->razorpayUpdate($request);
                break;
            case 'ssl_commerz':
                $this->sslcommerzUpdate($request);
                break;
            case 'paystack':
                $this->paystackUpdate($request);
                break;
            case 'flutterwave':
                $this->flutterwaveUpdate($request);
                break;
            case 'midtrans':
                $this->midtransUpdate($request);
                break;
            case 'mollie':
                $this->mollieUpdate($request);
                break;
            case 'instamojo':
                $this->instamojoUpdate($request);
                break;
        }

        SetupGuide::where('task_name', 'payment_setting')->update(['status' => 1]);
    }
    public function paypalUpdate(Request $request)
    {
        $request->validate([
            'paypal_client_id' => 'required',
            'paypal_client_secret' => 'required',
        ]);

        if ($request->paypal_live_mode) {
            checkSetEnv('PAYPAL_LIVE_CLIENT_ID', $request->paypal_client_id);
            checkSetEnv('PAYPAL_LIVE_CLIENT_SECRET', $request->paypal_client_secret);
        } else {
            checkSetEnv('PAYPAL_SANDBOX_CLIENT_ID', $request->paypal_client_id);
            checkSetEnv('PAYPAL_SANDBOX_CLIENT_SECRET', $request->paypal_client_secret);
        }

        setEnv('PAYPAL_MODE', $request->paypal_live_mode ? 'live' : 'sandbox');
        setEnv('PAYPAL_ACTIVE', $request->paypal ? 'true' : 'false');

        flashSuccess('Paypal Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function stripeUpdate(Request $request)
    {
        $request->validate([
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
        ]);

        checkSetEnv('STRIPE_KEY', $request->stripe_key);
        checkSetEnv('STRIPE_SECRET', $request->stripe_secret);
        setEnv('STRIPE_ACTIVE',  $request->stripe ? 'true' : 'false');

        flashSuccess('Stripe Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function razorpayUpdate(Request $request)
    {
        $request->validate([
            'razorpay_key' => 'required',
            'razorpay_secret' => 'required',
        ]);

        checkSetEnv('RAZORPAY_KEY', $request->razorpay_key);
        checkSetEnv('RAZORPAY_SECRET', $request->razorpay_secret);
        setEnv('RAZORPAY_ACTIVE', $request->razorpay ? 'true' : 'false');

        flashSuccess('RazorPay Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function sslcommerzUpdate(Request $request)
    {
        $request->validate([
            'store_id' => 'required',
            'store_password' => 'required',
        ]);

        checkSetEnv('SSLCOMMERZ_MODE', $request->ssl_mode ? 'live' : 'sandbox');
        checkSetEnv('STORE_ID', $request->store_id);
        checkSetEnv('STORE_PASSWORD', $request->store_password);
        setEnv('SSLCOMMERZ_ACTIVE', $request->ssl_commerz ? 'true' : 'false');

        flashSuccess('SSl Commerz Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function paystackUpdate(Request $request)
    {
        $request->validate([
            'paystack_public_key' => 'required',
            'paystack_secret_key' => 'required',
            'merchant_email' => 'required',
        ]);

        checkSetEnv('PAYSTACK_PUBLIC_KEY', $request->paystack_public_key);
        checkSetEnv('PAYSTACK_SECRET_KEY', $request->paystack_secret_key);
        checkSetEnv('MERCHANT_EMAIL', $request->merchant_email);
        setEnv('PAYSTACK_ACTIVE', $request->paystack ? 'true' : 'false');

        flashSuccess('Paystack Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function flutterwaveUpdate(Request $request)
    {
        $request->validate([
            'flw_public_key' => 'required',
            'flw_secret_key' => 'required',
            'flw_secret_hash' => 'required',
        ]);

        checkSetEnv('FLW_PUBLIC_KEY', $request->flw_public_key);
        checkSetEnv('FLW_SECRET_KEY', $request->flw_secret_key);
        checkSetEnv('FLW_SECRET_HASH', $request->flw_secret_hash);
        setEnv('FLW_ACTIVE', $request->flutterwave ? 'true' : 'false');

        flashSuccess('Paystack Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function midtransUpdate(Request $request)
    {
        $request->validate([
            'midtrans_merchat_id' => 'required',
            'midtrans_client_key' => 'required',
            'midtrans_server_key' => 'required',
        ]);

        checkSetEnv('MIDTRANS_MERCHAT_ID', $request->midtrans_merchat_id);
        checkSetEnv('MIDTRANS_CLIENT_KEY', $request->midtrans_client_key);
        checkSetEnv('MIDTRANS_SERVER_KEY', $request->midtrans_server_key);
        setEnv('MIDTRANS_ACTIVE', $request->midtrans ? 'true' : 'false');

        flashSuccess('Midtrans Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function mollieUpdate(Request $request)
    {
        $request->validate([
            'mollie_key' => 'required',
        ]);

        checkSetEnv('MOLLIE_KEY', $request->mollie_key);
        setEnv('MOLLIE_ACTIVE', $request->mollie ? 'true' : 'false');

        flashSuccess('Mollie Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function instamojoUpdate(Request $request)
    {
        $request->validate([
            'im_key' => 'required',
            'im_secret' => 'required',
        ], [
            'im_key.required' => 'Instamojo Key is required',
            'im_secret.required' => 'Instamojo Secret is required',
        ]);

        checkSetEnv('IM_API_KEY', $request->im_key);
        checkSetEnv('IM_AUTH_TOKEN', $request->im_secret);
        setEnv('IM_ACTIVE', $request->instamojo ? 'true' : 'false');

        flashSuccess('Instamojo Setting Updated Successfully');
        return redirect()->route('settings.payment')->send();
    }

    public function manualPayment()
    {
        abort_if(!userCan('setting.view'), 403);

        $manual_payment_gateways = ManualPayment::all();

        return view('admin.settings.pages.payment-manual', compact('manual_payment_gateways'));
    }

    public function manualPaymentStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        ManualPayment::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        flashSuccess('Manual Payment Created Successfully');
        return back();
    }

    public function manualPaymentEdit(ManualPayment $manual_payment)
    {
        $manual_payment_gateways = ManualPayment::all();

        return view('admin.settings.pages.payment-manual', compact('manual_payment_gateways', 'manual_payment'));
    }

    public function manualPaymentUpdate(Request $request, ManualPayment $manual_payment)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $manual_payment->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        flashSuccess('Manual Payment Updated Successfully');
        return back();
    }

    public function manualPaymentDelete(ManualPayment $manual_payment)
    {
        $manual_payment->delete();

        flashSuccess('Manual Payment Deleted Successfully');
        return redirect()->route('settings.payment.manual');
    }

    public function manualPaymentStatus(Request $request)
    {
        $manual_payment = ManualPayment::findOrFail($request->id);
        $manual_payment->update(['status' => $request->status]);

        return response()->json(['message' => 'Payment Status Updated Successfully']);
    }
}
