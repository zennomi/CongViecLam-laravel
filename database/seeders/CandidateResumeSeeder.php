<?php

namespace Database\Seeders;

use App\Models\CandidateResume;
use Illuminate\Database\Seeder;

class CandidateResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CandidateResume::factory(20)->create();
    }
}
