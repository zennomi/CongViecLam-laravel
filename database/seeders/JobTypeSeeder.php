<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Toàn thời gian', 'Bán thời gian', 'Theo hợp đồng', 'Thực tập', 'Tự do'
        ];

        foreach ($types as $type) {
            JobType::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
