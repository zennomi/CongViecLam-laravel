<?php
namespace Modules\Location\Database\factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Location\Entities\Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = 'https://picsum.photos/id/' . rand(1, 1000) . '/700/600';
        $country = $this->faker->country();

        return [
            'name' => $country,
            'slug' => Str::slug($country),
            'image' => $image,
        ];
    }
}

