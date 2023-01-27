<?php
namespace Modules\Contact\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Contact\Entities\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'subject' => $this->faker->name,
            'message' => $this->faker->sentence,
        ];
    }
}

