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
            'Trung học phổ thông', 'Trung cấp', 'Cử nhân', 'Thạc sĩ', 'Đã tốt nghiệp', 'Tiến sĩ', 'Khác'
        ];

        foreach ($educations as $education) {
            Education::create([
                'name' => $education,
                'slug' => Str::slug($education)
            ]);
        }
    }
}
