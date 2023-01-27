<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookies', function (Blueprint $table) {
            $table->id();
            $table->boolean('allow_cookies')->default(true);
            $table->string('cookie_name')->default('gdpr_cookie');
            $table->tinyInteger('cookie_expiration')->default(30);
            $table->boolean('force_consent')->default(false);
            $table->boolean('darkmode')->default(false);
            $table->string('language')->default('en');
            $table->string('title');
            $table->text('description');
            $table->string('approve_button_text');
            $table->string('decline_button_text');
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
        Schema::dropIfExists('cookies');
    }
}
