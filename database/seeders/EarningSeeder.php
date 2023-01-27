<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Earning;
use Illuminate\Support\Arr;
use App\Models\ManualPayment;
use Illuminate\Database\Seeder;
use Modules\Plan\Entities\Plan;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Earning::factory(5)->create();

        for ($i = 0; $i < 5; $i++) {
            Earning::create([
                'order_id'   => rand(1000000, 999999999),
                'transaction_id'   => uniqid('tr_'),
                'payment_provider' => 'offline',
                'manual_payment_id' => ManualPayment::inRandomOrder()->first()->id,
                'plan_id'      => Plan::inRandomOrder()->value('id'),
                'company_id'  => Company::inRandomOrder()->value('id'),
                'amount'       => Arr::random([20, 50, 100]),
                'currency_symbol' => Arr::random(['$', '£', '€']),
                'created_at'  => now(),
                'usd_amount'       => Arr::random([20, 50, 100]),
                'payment_status' => Arr::random(['paid', 'unpaid']),
            ]);
        }
    }
}
