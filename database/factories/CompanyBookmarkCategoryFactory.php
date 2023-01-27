<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyBookmarkCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id'  => Company::inRandomOrder()->first()->id,
            'name' => Arr::random(['Cat 1', 'Cat 2', 'Cat 3', 'Cat 4', 'Cat 5']),
        ];
    }
}
