<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullAddressToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('locality')->nullable();
            $table->string('place')->nullable();
            $table->string('district')->nullable();
            $table->string('postcode')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->double('long')->nullable();
            $table->double('lat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
        });
    }
}
