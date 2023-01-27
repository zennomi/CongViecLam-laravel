<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('about_title');
            $table->string('about_sub_title');
            $table->text('about_description');
            $table->string('about_brand_logo')->default('frontend/assets/images/all-img/brand-1.png');
            $table->string('about_brand_logo1')->default('frontend/assets/images/all-img/brand-2.png');
            $table->string('about_brand_logo2')->default('frontend/assets/images/all-img/brand-3.png');
            $table->string('about_brand_logo3')->default('frontend/assets/images/all-img/brand-1.png');
            $table->string('about_brand_logo4')->default('frontend/assets/images/all-img/brand-2.png');
            $table->string('about_brand_logo5')->default('frontend/assets/images/all-img/brand-3.png');
            $table->string('about_banner_img')->default('frontend/assets/images/banner/about-banner-1.jpg');
            $table->string('about_banner_img1')->default('frontend/assets/images/banner/about-banner-1.jpg');
            $table->string('about_banner_img2')->default('frontend/assets/images/banner/about-banner-1.jpg');
            $table->string('about_banner_img3')->default('frontend/assets/images/banner/about-banner-1.jpg');

            // $table->string('client_logo')->default('frontend/assets/images/all-img/brand-2.png');
            // $table->string('image')->default('frontend/assets/images/banner/about-banner-1.jpg');

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
        Schema::dropIfExists('abouts');
    }
}
