<?php

namespace Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Currency\Entities\Currency;

class CurrencyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $currencies = [
            [
                'name' => 'United State Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Indian Rupee	',
                'code' => 'INR',
                'symbol' => '₹',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Australian Dollar',
                'code' => 'AUD',
                'symbol' => '$',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Bangladeshi Taka',
                'code' => 'BDT',
                'symbol' => '৳',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Bitcoin',
                'code' => 'BTC',
                'symbol' => '₿',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Ethereum',
                'code' => 'ETH',
                'symbol' => '⟠',
                'symbol_position' => 'left',
            ],
            [
                'name' => 'Litecoin',
                'code' => 'LTC',
                'symbol' => 'Ł',
                'symbol_position' => 'left',
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
