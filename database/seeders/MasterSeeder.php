<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Plan\Entities\Plan;
use Spatie\Permission\Models\Role;
use Modules\Faq\Entities\FaqCategory;
use Modules\Currency\Entities\Currency;
use Modules\Language\Entities\Language;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Plan Create
        Plan::create([
            'label' => 'Trial',
            'description' => 'This is the trial plan',
            'price' => '0',
            'job_limit' => '1',
            'featured_job_limit' => '1',
            'highlight_job_limit' => '1',
            'candidate_cv_view_limit' => '5',
            'recommended' => false,
            'frontend_show' => false,
        ]);

        // Admin Create
        $role = Role::first();
        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "admin@mail.com";
        $admin->image = "backend/image/default.png";
        $admin->password = bcrypt('password');
        $admin->email_verified_at = Carbon::now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole($role);

        // Faq Category Create
        FaqCategory::create([
            'name' => 'Job',
            'slug' => 'job',
            'icon' => 'fas fa-briefcase'
        ]);

        // Currency Create
        Currency::create([
            'name' => 'United State Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'symbol_position' => 'left',
        ]);

        // Language Create
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'icon' => 'flag-icon-gb',
            'direction' => 'ltr',
        ]);
    }
}
