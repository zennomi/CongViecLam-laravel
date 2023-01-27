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
            'Fresher', '1 Year', '2 Years', '3+ Years', '5+ Years', '8+ Years', '10+ Years', '15+ Years'
        ];

        foreach ($experiences as $experience) {
            Experience::create([
                'name' => $experience,
                'slug' => Str::slug($experience)
            ]);
        }
    }
}
