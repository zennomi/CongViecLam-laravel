<?php
namespace Modules\Blog\Database\factories;

use App\Models\User;
use Modules\Blog\Entities\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\PostComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id'       =>  User::inRandomOrder()->first()->id,
            'post_id'       =>  Post::inRandomOrder()->first()->id,
            'body'          =>  $this->faker->text(100)
        ];
    }
}

