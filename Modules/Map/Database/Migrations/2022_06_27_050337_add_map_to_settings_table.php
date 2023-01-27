<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMapToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->enum('default_map', ['google-map', 'map-box'])->default('map-box');
            $table->string('google_map_key',)->nullable();
            $table->string('map_box_key',)->nullable();
            $table->double('default_long')->nullable();
            $table->double('default_lat')->nullable();
            $table->enum('app_country_type', ['single_base', 'multiple_base'])->default('multiple_base');
            $table->unsignedBigInteger('app_country')->nullable();
            $table->foreign('app_country')->references('id')->on('countries')->onDelete('casCade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
        });
    }
}
