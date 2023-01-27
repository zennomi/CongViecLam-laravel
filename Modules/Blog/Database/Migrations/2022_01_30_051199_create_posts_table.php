<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('author_id');
            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('CasCade');
            $table->foreign('author_id')->references('id')->on('admins')->onDelete('CasCade');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('short_description');
            $table->longText('description');
            $table->enum('status', ['draft', 'published'])->nullable()->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
