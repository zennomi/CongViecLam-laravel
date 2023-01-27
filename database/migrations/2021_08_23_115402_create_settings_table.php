<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('logo_image2')->nullable();
            $table->string('favicon_image')->nullable();
            $table->text('header_css')->nullable();
            $table->text('header_script')->nullable();
            $table->text('body_script')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->string('nav_color')->nullable();
            $table->string('sidebar_txt_color')->nullable();
            $table->string('nav_txt_color')->nullable();
            $table->string('main_color')->nullable();
            $table->string('accent_color')->nullable();
            $table->string('frontend_primary_color')->nullable();
            $table->string('frontend_secondary_color')->nullable();
            $table->string('working_process_step1_title')->nullable();
            $table->text('working_process_step1_description')->nullable();
            $table->string('working_process_step2_title')->nullable();
            $table->text('working_process_step2_description')->nullable();
            $table->string('working_process_step3_title')->nullable();
            $table->text('working_process_step3_description')->nullable();
            $table->string('working_process_step4_title')->nullable();
            $table->text('working_process_step4_description')->nullable();
            $table->boolean('dark_mode')->default(false);
            $table->boolean('default_layout')->default(true);
            $table->unsignedInteger('default_plan')->default(1);
            $table->unsignedInteger('job_limit')->default(1);
            $table->unsignedInteger('featured_job_limit')->default(1);
            $table->unsignedInteger('highlight_job_limit')->default(1);
            $table->string('timezone')->default('UTC');
            $table->boolean('language_changing')->default(true);
            $table->boolean('email_verification')->default(false);
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
        Schema::dropIfExists('settings');
    }
}
