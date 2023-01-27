<?php

namespace Database\Seeders;

use App\Models\ManualPayment;
use Illuminate\Database\Seeder;

class ManualPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manual_payments = [
            [
                'type' => 'bank_payment',
                'name' => 'Bank',
                'description' => 'Payment made by bank',
            ],
            [
                'type' => 'cash_payment',
                'name' => 'Cash On',
                'description' => 'Payment made by cash',
            ],
            [
                'type' => 'check_payment',
                'name' => 'Check',
                'description' => 'Payment made by check',
            ],
            [
                'type' => 'custom_payment',
                'name' => 'Custom',
                'description' => 'Payment made by custom',
            ],
        ];

        foreach ($manual_payments as $manual_payment) {
            $manual_payment = ManualPayment::create($manual_payment);
        }
    }
}
