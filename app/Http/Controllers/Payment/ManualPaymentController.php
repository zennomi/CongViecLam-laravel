<?php

namespace App\Http\Controllers\Payment;

use App\Models\Admin;
use AmrShawky\Currency;
use App\Models\Earning;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use App\Models\ManualPayment;
use Modules\Plan\Entities\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\NewPlanPurchaseNotification;
use App\Notifications\Website\Company\PaymentMarkPaidNotification;

class ManualPaymentController extends Controller
{
    public function paymentPlace(Request $request)
    {
        $plan = Plan::findOrFail($request->plan_id);
        $payment = ManualPayment::findOrFail($request->payment_id);
        $usd_amount = currencyConversion($plan->price);


        Earning::create([
            'order_id' => uniqid(),
            'transaction_id' => uniqid('tr_'),
            'payment_provider' => 'offline',
            'plan_id' => $plan->id,
            'company_id' => auth('user')->user()->company->id,
            'amount' => $plan->price,
            'currency_symbol' => config('jobpilot.currency_symbol'),
            'usd_amount' => $usd_amount,
            'manual_payment_id' => $payment->id,
        ]);

        session()->flash('success', 'Payment is placed waiting for approval.');
        return redirect()->route('company.plan');
    }

    public function markPaid(Earning $order)
    {
        $order->update([
            'payment_status' => 'paid',
        ]);
        $plan = Plan::findOrFail($order->plan_id);
        $user_plan = UserPlan::where('company_id', $order->company_id)->first();

        $user_plan->update([
            'plan_id' => $plan->id,
            'job_limit' => $user_plan->job_limit + $plan->job_limit,
            'featured_job_limit' => $user_plan->featured_job_limit + $plan->featured_job_limit,
            'highlight_job_limit' => $user_plan->highlight_job_limit + $plan->highlight_job_limit,
            'candidate_cv_view_limit' => $user_plan->candidate_cv_view_limit + $plan->candidate_cv_view_limit,
        ]);
        $user = $order->company->user;

        if (checkMailConfig()) {
            // make notification to admins for approved
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Notification::send($admin, new NewPlanPurchaseNotification($admin, $order, $plan, $user));
            }
        }

        $order->company->user->notify(new PaymentMarkPaidNotification());

        session()->flash('success', 'Payment is mark as paid.');
        return back();
    }
}
