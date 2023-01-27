<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSomeColumnsFromCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->dropColumn('home_page_banner_title');
            $table->dropColumn('home_page_banner_subtitle');
            $table->dropColumn('about_title');
            $table->dropColumn('about_sub_title');
            $table->dropColumn('about_description');
            $table->dropColumn('contact_title');
            $table->dropColumn('contact_subtitle');
            $table->dropColumn('contact_description');
            $table->dropColumn('mission_title');
            $table->dropColumn('mission_sub_title');
            $table->dropColumn('mission_description');
            $table->dropColumn('page403_title');
            $table->dropColumn('page403_type');
            $table->dropColumn('page403_subtitle');
            $table->dropColumn('page404_title');
            $table->dropColumn('page404_type');
            $table->dropColumn('page404_subtitle');
            $table->dropColumn('page500_title');
            $table->dropColumn('page500_type');
            $table->dropColumn('page500_subtitle');
            $table->dropColumn('page503_title');
            $table->dropColumn('page503_type');
            $table->dropColumn('page503_subtitle');
            $table->dropColumn('comingsoon_title');
            $table->dropColumn('comingsoon_subtitle');
            $table->dropColumn('maintenance_title');
            $table->dropColumn('maintenance_subtitle');
            $table->dropColumn('account_setup_title');
            $table->dropColumn('account_setup_subtitle');
            $table->dropColumn('employers_description');
            $table->dropColumn('employers_title');
            $table->dropColumn('candidate_description');
            $table->dropColumn('candidate_title');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms', function (Blueprint $table) {
            //
        });
    }
}
