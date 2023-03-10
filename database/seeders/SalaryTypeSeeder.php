<?php

namespace Database\Seeders;

use App\Models\SalaryType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SalaryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Tháng', 'Theo dự án', 'Giờ', 'Năm'
        ];

        foreach ($types as $type) {
            SalaryType::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
