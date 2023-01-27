<?php

use App\Models\ApplicationGroup;
use App\Models\CandidateResume;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAppliedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applied_jobs', function (Blueprint $table) {
            $table->foreignIdFor(CandidateResume::class)->constrained()->cascadeOnDelete()->after('job_id');
            $table->longText('cover_letter')->nullable()->after('candidate_resume_id');
            $table->foreignIdFor(ApplicationGroup::class)->constrained()->cascadeOnDelete()->after('cover_letter');
            $table->smallInteger('order')->default(0);

            // $table->foreignId('application_group_id')->default(1)->constrained('application_groups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applied_jobs', function (Blueprint $table) {
            //
        });
    }
}
