<?php

namespace Modules\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Testimonial\Entities\Testimonial;

class TestimonialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $testimonials = [
            [
                'name' => 'Zakir Hossain',
                'position' => 'Fullstack Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  5,
            ],
            [
                'name' => 'Ariful Islam',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  4,
            ],
            [
                'name' => 'Sraboni Akter',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  5,
            ],
            [
                'name' => 'Jannat Akter',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  5,
            ],
            [
                'name' => 'MD Khan',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  4,
            ],
            [
                'name' => 'Abiruzzaman Molla',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  4,
            ],
            [
                'name' => 'Hasibur Rahman',
                'position' => 'Backend Developer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Nulla facilisi. Ut euismod diam eu tristique.',
                'stars' =>  3,
            ]
        ];

        Testimonial::insert($testimonials);
    }
}
