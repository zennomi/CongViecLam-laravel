<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'slug' => Str::slug($this->faker->unique()->name()),
            'image' => $this->faker->imageUrl(128, 128),
            'icon' => ''
        ];
    }
}
