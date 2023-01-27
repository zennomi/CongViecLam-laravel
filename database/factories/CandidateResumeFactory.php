<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateResumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'candidate_id' => Candidate::inRandomOrder()->value('id'),
            'name' => $this->faker->unique()->jobTitle(),
            'file' => 'frontend/assets/images/demo_cv.pdf',
        ];
    }
}
