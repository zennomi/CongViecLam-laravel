<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\OrganizationType;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Chính quyền', 'Đa chính quyền', 'Công khai', 'Riêng tư', 'Tổ chức phi chính phủ', 'Cơ quan quốc tế'
        ];

        foreach ($types as $type) {
            OrganizationType::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
