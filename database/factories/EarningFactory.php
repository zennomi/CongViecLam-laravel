<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Arr;
use Modules\Plan\Entities\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class EarningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // payment_status
        return [
            'order_id'   => rand(1000000, 999999999),
            'transaction_id'   => uniqid('tr_'),
            'payment_provider' => Arr::random(['flutterwave', 'mollie', 'midtrans', 'paypal', 'paystack', 'razorpay', 'sslcommerz', 'stripe', 'instamojo']),
            'plan_id'      => Plan::inRandomOrder()->value('id'),
            'company_id'  => Company::inRandomOrder()->first()->id,
            'amount'       => Arr::random([20, 50, 100]),
            'currency_symbol' => Arr::random(['$', '£', '€']),
            'created_at'  => $this->faker->dateTimeBetween('-1 year', 'now'),
            'usd_amount'       => Arr::random([20, 50, 100]),
            'payment_status' => 'paid',
        ];
    }
}
