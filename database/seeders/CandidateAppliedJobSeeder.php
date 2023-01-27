<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Candidate;
use App\Models\CandidateResume;
use Illuminate\Database\Seeder;
use App\Models\ApplicationGroup;
use Illuminate\Support\Facades\DB;

class CandidateAppliedJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidates = Candidate::all();
        $jobs = Job::all();

        foreach ($candidates as $candidate) {
            foreach ($jobs->random(15) as $job) {
                DB::table('applied_jobs')->insert([
                    'candidate_id' => $candidate->id,
                    'job_id' => $job->id,
                    'cover_letter' => 'lorem ipsum dolor sit amet',
                    'candidate_resume_id' => CandidateResume::inRandomOrder()->first()->id,
                    'application_group_id' => $job->company->applicationGroups()->inRandomOrder()->value('id'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
