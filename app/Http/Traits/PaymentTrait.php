<?php

namespace App\Http\Traits;

use App\Models\Admin;
use App\Models\Earning;
use App\Models\UserPlan;
use Modules\Plan\Entities\Plan;
use Illuminate\Support\Facades\Notification;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Notifications\Admin\NewPlanPurchaseNotification;

trait PaymentTrait
{
    public function orderPlacing($redirect = true)
    {
        $user_plan = UserPlan::companyData()->first();
        $plan = session('plan');
        $order_amount = session('order_payment');
        $transaction_id = session('transaction_id') ?? uniqid('tr_');

        $user_plan->update([
            'plan_id' => $plan->id,
            'job_limit' => $user_plan->job_limit + $plan->job_limit,
            'featured_job_limit' => $user_plan->featured_job_limit + $plan->featured_job_limit,
            'highlight_job_limit' => $user_plan->highlight_job_limit + $plan->highlight_job_limit,
            'candidate_cv_view_limit' => $user_plan->candidate_cv_view_limit + $plan->candidate_cv_view_limit,
        ]);

        $order = Earning::create([
            'order_id' => rand(1000, 999999999),
            'transaction_id' =>  $transaction_id,
            'plan_id' => $plan->id,
            'company_id' => auth('user')->user()->company->id,
            'payment_provider' => $order_amount['payment_provider'],
            'amount' => $order_amount['amount'],
            'currency_symbol' => $order_amount['currency_symbol'],
            'usd_amount' => $order_amount['usd_amount'],
            'payment_status' => 'paid',
        ]);

        if (checkMailConfig()) {
            // make notification to admins for approved
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Notification::send($admin, new NewPlanPurchaseNotification($admin, $order, $plan, auth('user')->user()));
            }
        }

        storePlanInformation();
        $this->forgetSessions();

        if ($redirect) {
            session()->flash('success', 'Plan purchased successfully.');
            return redirect()->route('company.plan')->send();
        }
    }

    private function forgetSessions()
    {
        session()->forget('plan');
        session()->forget('order_payment');
        session()->forget('transaction_id');
        session()->forget('stripe_amount');
        session()->forget('razor_amount');
    }
}
