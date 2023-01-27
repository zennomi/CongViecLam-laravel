<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Engineer/Architects',
            'Garments/Textile',
            'Design/Creative',
            'Hospitality/ Travel/ Tourism',
            'IT & Telecommunication',
            'Medical/Pharma',
            'Driving/Motor Technician',
            'Law/Legal',
            'Others'
        ];

        $icons = [
            'fas fa-hammer',
            'fas fa-tshirt',
            'fas fa-pen',
            'fas fa-hospital',
            'fas fa-desktop',
            'fas fa-user-md',
            'fas fa-car',
            'fas fa-gavel',
            'fas fa-ellipsis-v',
        ];

        foreach ($categories as $key => $category) {
            JobCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => 'backend/image/default.png',
                'icon' => $icons[$key]
            ]);
        }
    }
}
