<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarkCompanyCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmark_company_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookmark_id')->constrained('bookmark_company')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('company_bookmark_categories')->cascadeOnDelete();
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
        Schema::dropIfExists('bookmark_company_category');
    }
}
