<?php

namespace Modules\Plan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Plan\Entities\Plan;

class PlanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $plans = [
            [
                'label' => 'Trial',
                'description' => 'This is the trial plan',
                'price' => '0',
                'job_limit' => '1',
                'featured_job_limit' => '1',
                'highlight_job_limit' => '1',
                'candidate_cv_view_limit' => '3',
                'recommended' => false,
                'frontend_show' => false,
            ],
            [
                'label' => 'Basic',
                'description' => 'This is the basic plan',
                'price' => '20',
                'job_limit' => '5',
                'featured_job_limit' => '3',
                'highlight_job_limit' => '2',
                'candidate_cv_view_limit' => '10',
                'recommended' => false,
                'frontend_show' => true,
            ],
            [
                'label' => 'Standard',
                'description' => 'This is the standard plan',
                'price' => '50',
                'job_limit' => '20',
                'featured_job_limit' => '8',
                'highlight_job_limit' => '4',
                'candidate_cv_view_limit' => '20',
                'recommended' => true,
                'frontend_show' => true,
            ],
            [
                'label' => 'Premium',
                'description' => 'This is the premium plan',
                'price' => '100',
                'job_limit' => '100',
                'featured_job_limit' => '20',
                'highlight_job_limit' => '10',
                'candidate_cv_view_limit' => '50',
                'recommended' => false,
                'frontend_show' => true,
            ]
        ];

        collect($plans)->each(function ($plan) {
            Plan::create($plan);
        });
    }
}
