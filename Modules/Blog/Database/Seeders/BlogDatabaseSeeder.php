<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Tag\Entities\Tag;
use Illuminate\Database\Seeder;
use Modules\Blog\Entities\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Entities\PostComment;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        PostCategory::factory(5)->create();
        Post::factory(50)->create();
        // PostComment::factory(200)->create();

        $posts = Post::all();
        foreach($posts as $post){
            PostComment::factory(5)->create([
                'post_id'   =>  $post->id,
            ]);
        }
    }
}
