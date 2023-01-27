<?php

namespace Modules\Blog\Database\factories;

use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Entities\PostCategory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(30, 600);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';
        $title = $this->faker->sentence($nbWords = 5, $variableNbWords = true);

        return [
            'category_id' => PostCategory::inRandomOrder()->value('id'),
            'author_id' => Admin::inRandomOrder()->value('id'),
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $image,
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(50),
            'status' => Arr::random(['published', 'draft']),
        ];
    }
}
