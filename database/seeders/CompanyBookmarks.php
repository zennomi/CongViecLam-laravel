<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyBookmarks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();
        $candidates = Candidate::all();

        foreach ($companies as $company) {
            foreach ($candidates->random(5) as $candidate) {
                $company->bookmarkCandidates()->attach($candidate->id);
            }
        }
    }
}
