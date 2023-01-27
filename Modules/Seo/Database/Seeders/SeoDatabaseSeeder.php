<?php

namespace Modules\Seo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Seo\Entities\Seo;

class SeoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Welcome To Jobpilot',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'jobs',
                'title' => 'Jobs',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'job-details',
                'title' => 'Job Details',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'candidates',
                'title' => 'Candidates',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'candidate-details',
                'title' => 'Candidate Details',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company',
                'title' => 'Company',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company-details',
                'title' => 'Company Details',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'post-details',
                'title' => 'Post Details',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'login',
                'title' => 'Login',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'register',
                'title' => 'Register',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'about',
                'title' => 'About',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Contact',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'terms-condition',
                'title' => 'Terms Condition',
                'description' => 'Jobpilot is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],


        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
