<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experiences = [
            'Không kinh nghiệm', '1 Năm kinh nghiệm', '2 Năm kinh nghiệm', '3+ Năm kinh nghiệm', '5+ Năm kinh nghiệm', '8+ Năm kinh nghiệm', '10+ Năm kinh nghiệm', '15+ Năm kinh nghiệm'
        ];

        foreach ($experiences as $experience) {
            Experience::create([
                'name' => $experience,
                'slug' => Str::slug($experience)
            ]);
        }
    }
}
