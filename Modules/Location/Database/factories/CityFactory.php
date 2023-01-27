<?php

namespace Modules\Location\Database\factories;

use Illuminate\Support\Str;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Location\Entities\City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'https://picsum.photos/id/' . rand(1, 300) . '/700/600';
        $city = $this->faker->city();

        return [
            'state_id' => 1,
            'name' => $city,
            'slug' => Str::slug($city),
        ];
    }
}
