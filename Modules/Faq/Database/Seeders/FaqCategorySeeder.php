<?php

namespace Modules\Faq\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Faq\Entities\FaqCategory;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        FaqCategory::create([
            'name' => 'Mobile',
            'slug' => 'mobile',
            'icon' => 'fas fa-mobile-alt'
        ]);
        FaqCategory::create([
            'name' => 'Computer',
            'slug' => 'computer',
            'icon' => 'fas fa-laptop'
        ]);
        FaqCategory::create([
            'name' => 'Car',
            'slug' => 'car',
            'icon' => 'fas fa-car'
        ]);
        FaqCategory::create([
            'name' => 'Food',
            'slug' => 'food',
            'icon' => 'fas fa-apple-alt'
        ]);
        FaqCategory::create([
            'name' => 'Clothes',
            'slug' => 'clothes',
            'icon' => 'fas fa-tshirt'
        ]);
    }
}
