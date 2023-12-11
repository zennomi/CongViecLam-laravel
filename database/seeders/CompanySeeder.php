<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Company;
use App\Models\JobRole;
use App\Models\TeamSize;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profession;
use App\Models\SocialLink;
use App\Models\ContactInfo;
use App\Models\Nationality;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\IndustryType;
use Illuminate\Database\Seeder;
use App\Models\OrganizationType;
use Spatie\Permission\Models\Role;
use Modules\Location\Entities\State;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Company
        $company = new User();
        $company->name = 'Paato Group';
        $company->username = 'paato';
        $company->email = 'company@mail.com';
        $company->password = bcrypt('password');
        $company->role = 'company';
        $company->email_verified_at = Carbon::now();
        $company->is_demo_field = true;
        $company->save();
        $company->company()->create([
            'industry_type_id' =>  IndustryType::inRandomOrder()->value('id'),
            'lat' => 23,
            'long' => 90,
            'organization_type_id' =>  OrganizationType::inRandomOrder()->value('id'),
            'team_size_id'  =>  TeamSize::inRandomOrder()->value('id'),
            'nationality_id' => Nationality::inRandomOrder()->value('id'),
            'bio' => 'Paato là web tìm việc làm hàng đầu Viet Nam.',
            'profile_completion' => 1,
            'logo' => 'https://telegraph-image-bak.pages.dev/file/700f4027dc52382ddb627.png',
            'banner' => 'https://telegraph-image-bak.pages.dev/file/11bcaa4842a1d6a490d28.jpg',
            'vision' => 'Paato là web tìm việc làm hàng đầu Viet Nam.',
        ]);
        $company->socialInfo()->create([
            'social_media' => 'facebook',
            'url' => 'https://www.facebook.com/Zennomi',
            // 'google' => 'https://www.google.com/search?q=zakirsoft',
            // 'facebook' => 'https://www.facebook.com/zakirsoft',
            // 'twitter' => 'https://www.twitter.com/zakirsoft',
            // 'instagram' => 'https://www.instagram.com/zakirsoft',
            // 'linkedin' => 'https://www.linkedin.com/zakirsoft',
            // 'youtube' => 'https://www.youtube.com/zakirsoft',
        ]);
        $company->contactInfo()->create([
            'phone' => '+394299564',
            'email' => 'bk@gmail.com',
        ]);

        Company::factory(20)->create();
        // User::factory(10)->create();
        // User::factory(100)->create();
    }
}
