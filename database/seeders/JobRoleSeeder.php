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
            'Trưởng nhóm', 'Giám đốc', 'Trợ lý giám đốc', 'Quản lý', 'Giám đốc', 'Quản trị viên'
        ];

        foreach ($educations as $education) {
            JobRole::create([
                'name' => $education,
                'slug' => Str::slug($education)
            ]);
        }
    }
}
