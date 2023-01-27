<?php

namespace Modules\Location\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Location\Entities\City;

class TownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Location\Entities\Town::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => City::inRandomOrder()->first()->id,
            'name' => $this->faker->unique()->state(),
        ];
    }
}
