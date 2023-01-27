<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\IndustryType;
use Illuminate\Database\Seeder;

class IndustryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industry_types = [
            "Agro Based Industry",
            "Archi/Enggr/Construction",
            "Automobile/Industrial Machine",
            "Bank/Mon-Bank Fin. Institute",
            "Electronics/Consumer Durables",
            "Energy/Power/Fuel",
            "Garments/Textile",
            "Govt./Semi-Govt./Autonomous",
            "Pharmaceuticals",
            "Hospital/Diagnostic Center",
            "Airline/Travel/Tourism",
            "Manufacturing (Light Industry)",
            "Manufacturing (Heavy Industry)",
            "Hotel/Restaurant",
            "Information Technology",
            "Logistics/Transportation",
            "Entertainment/Recreation",
            "Media/Advertising/Event Mgt.",
            "NGO/Development",
            "Real Estate/Development",
            "Wholesale/Retail/Export-Import",
            "Telecommunication",
            "Food & Beverage Industry",
            "Security Service",
            "Fire, Safety & Protection"
        ];

        foreach ($industry_types as $type) {
            IndustryType::create([
                'name' => $type,
                'slug' => Str::slug($type),
            ]);
        }
    }
}
