<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            'High School', 'Intermediate', 'Bachelor Degree', 'Master Degree', 'Graduated', 'PhD', 'Any'
        ];

        foreach ($educations as $education) {
            Education::create([
                'name' => $education,
                'slug' => Str::slug($education)
            ]);
        }
    }
}
