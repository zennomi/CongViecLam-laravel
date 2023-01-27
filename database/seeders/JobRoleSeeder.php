<?php

namespace Database\Seeders;

use App\Models\JobRole;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            'Team Leader', 'Manager', 'Assistant Manager', 'Executive', 'Director', 'Administrator'
        ];

        foreach ($educations as $education) {
            JobRole::create([
                'name' => $education,
                'slug' => Str::slug($education)
            ]);
        }
    }
}
