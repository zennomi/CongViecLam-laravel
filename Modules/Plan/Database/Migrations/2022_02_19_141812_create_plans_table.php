<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->text('description');
            $table->float('price');
            $table->integer('job_limit');
            $table->integer('featured_job_limit');
            $table->integer('highlight_job_limit');
            $table->integer('candidate_cv_view_limit');
            $table->boolean('recommended')->default(false);
            $table->boolean('frontend_show')->default(false);
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
        Schema::dropIfExists('plans');
    }
}
