<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Seeder;

class CandidateBookmarks extends Seeder
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
            foreach ($jobs->random(5) as $job) {
                $candidate->bookmarkJobs()->attach($job->id);
            }
        }
    }
}
