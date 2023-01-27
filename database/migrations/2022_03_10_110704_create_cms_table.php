<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('about_title');
            $table->string('about_sub_title');
            $table->text('about_description');
            $table->string('about_brand_logo')->nullable();
            $table->string('about_brand_logo1')->nullable();
            $table->string('about_brand_logo2')->nullable();
            $table->string('about_brand_logo3')->nullable();
            $table->string('about_brand_logo4')->nullable();
            $table->string('about_brand_logo5')->nullable();
            $table->string('about_banner_img')->nullable();
            $table->string('about_banner_img1')->nullable();
            $table->string('about_banner_img2')->nullable();
            $table->string('about_banner_img3')->nullable();
            $table->string('mission_title');
            $table->string('mission_sub_title');
            $table->text('mission_description');
            $table->string('mission_image')->nullable();
            $table->string('candidate_title');
            $table->text('candidate_description');
            $table->string('candidate_image')->nullable();
            $table->string('employers_title');
            $table->text('employers_description');
            $table->string('employers_image')->nullable();
            $table->string('contact_title');
            $table->string('contact_subtitle');
            $table->text('contact_description');
            $table->text('contact_map');
            $table->string('register_page_image')->nullable();
            $table->string('login_page_image')->nullable();
            $table->string('home_page_banner_title');
            $table->string('home_page_banner_subtitle');
            $table->string('home_page_banner_image')->nullable();
            $table->string('page403_title');
            $table->string('page403_type');
            $table->string('page403_subtitle');
            $table->string('page403_image')->nullable();
            $table->string('page404_title');
            $table->string('page404_type');
            $table->string('page404_subtitle');
            $table->string('page404_image')->nullable();
            $table->string('page500_title');
            $table->string('page500_type');
            $table->string('page500_subtitle');
            $table->string('page500_image')->nullable();
            $table->string('page503_title');
            $table->string('page503_type');
            $table->string('page503_subtitle');
            $table->string('page503_image')->nullable();
            $table->string('comingsoon_title');
            $table->string('comingsoon_subtitle');
            $table->string('comingsoon_image')->nullable();
            $table->string('footer_phone_no')->nullable();
            $table->text('footer_address')->nullable();
            $table->string('footer_facebook_link')->nullable();
            $table->string('footer_instagram_link')->nullable();
            $table->string('footer_twitter_link')->nullable();
            $table->string('footer_youtube_link')->nullable();
            $table->longText('privary_page')->nullable();
            $table->longText('terms_page')->nullable();
            $table->string('account_setup_title');
            $table->text('account_setup_subtitle');
            $table->string('maintenance_title');
            $table->text('maintenance_subtitle');
            $table->string('maintenance_image')->nullable();
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
        Schema::dropIfExists('cms');
    }
}
