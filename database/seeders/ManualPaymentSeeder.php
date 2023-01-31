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
                'name' => 'Ngân hàng',
                'description' => 'Thanh toán qua ngân hàng',
            ],
            [
                'type' => 'cash_payment',
                'name' => 'Tiền mặt',
                'description' => 'Thanh toán bằng tiền mặt',
            ],
            [
                'type' => 'check_payment',
                'name' => 'Chuyển khoản',
                'description' => 'Thanh toán bằng chuyển khoản',
            ],
            [
                'type' => 'custom_payment',
                'name' => 'Tùy chỉnh',
                'description' => 'Thanh toán tùy chỉnh',
            ],
        ];

        foreach ($manual_payments as $manual_payment) {
            $manual_payment = ManualPayment::create($manual_payment);
        }
    }
}
