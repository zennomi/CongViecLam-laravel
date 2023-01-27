<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Candidate;
use App\Models\SocialLink;
use App\Models\ContactInfo;
use App\Models\Education;
use App\Models\Experience;
use App\Models\IndustryType;
use App\Models\JobRole;
use App\Models\Nationality;
use App\Models\OrganizationType;
use App\Models\Profession;
use App\Models\TeamSize;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Modules\Location\Entities\City;
use Illuminate\Support\Facades\Hash;
use Modules\Location\Entities\Country;
use Illuminate\Support\Arr;
use Modules\Location\Entities\State;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Candidate
        $candidate = new User();
        $candidate->name = 'Candidate';
        $candidate->username = 'candidate';
        $candidate->email = 'candidate@mail.com';
        $candidate->password = bcrypt('password');
        $candidate->role = 'candidate';
        $candidate->email_verified_at = Carbon::now();
        $candidate->save();
        Candidate::create([
            'user_id' => $candidate->id,
            'role_id' => JobRole::inRandomOrder()->value('id'),
            'profession_id' => Profession::inRandomOrder()->value('id'),
            'experience_id' => Experience::inRandomOrder()->value('id'),
            'education_id' => Education::inRandomOrder()->value('id'),
            'gender' => Arr::random(['male', 'female', 'other']),
            'website' => 'https://zakirsoft.com',
            'title' => 'This is Candidate Title !',
            'birth_date' => Carbon::now(),
            'marital_status' => 'married',
            'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/800px-Gull_portrait_ca_usa.jpg?20101128165003',
            'bio' => 'Sometimes you may wish to stop running validation rules on an attribute after the first validation  failure. To do so, assign the bail rule to the attribute:',
        ]);
        SocialLink::create([
            'user_id' => $candidate->id,
            'google' => 'https://www.google.com/search?q=zakirsoft',
            'facebook' => 'https://www.facebook.com/zakirsoft',
            'twitter' => 'https://www.twitter.com/zakirsoft',
            'instagram' => 'https://www.instagram.com/zakirsoft',
            'linkedin' => 'https://www.linkedin.com/zakirsoft',
            'youtube' => 'https://www.youtube.com/zakirsoft',
        ]);
        ContactInfo::create([
            'user_id' => $candidate->id,
            'phone' => '+880123456789',
            'email' => 'zakirsoft20@gmail.com',
        ]);

        // Company
        $company = new User();
        $company->name = 'Zakirsoft';
        $company->username = 'company';
        $company->email = 'company@mail.com';
        $company->password = bcrypt('password');
        $company->role = 'company';
        $company->email_verified_at = Carbon::now();
        $company->save();
        Company::create([
            'user_id' => $company->id,
            'industry_type_id' =>  IndustryType::inRandomOrder()->value('id'),
            'organization_type_id' =>  OrganizationType::inRandomOrder()->value('id'),
            'team_size_id'  =>  TeamSize::inRandomOrder()->value('id'),
            'nationality_id' => Nationality::inRandomOrder()->value('id'),
            'bio' => 'This is bio',
            'profile_completion' => 1,
        ]);
        SocialLink::create([
            'user_id' => $company->id,
            'google' => 'https://www.google.com/search?q=zakirsoft',
            'facebook' => 'https://www.facebook.com/zakirsoft',
            'twitter' => 'https://www.twitter.com/zakirsoft',
            'instagram' => 'https://www.instagram.com/zakirsoft',
            'linkedin' => 'https://www.linkedin.com/zakirsoft',
            'youtube' => 'https://www.youtube.com/zakirsoft',
        ]);
        ContactInfo::create([
            'user_id' => $company->id,
            'phone' => '+880123456789',
            'email' => 'zakirsoft20@gmail.com',
        ]);

        // Admin
        $role = Role::first();
        $admin = new Admin();
        $admin->name = "Zakir Soft";
        $admin->email = "developer@mail.com";
        $admin->image = "backend/image/default.png";
        $admin->password = bcrypt('password');
        $admin->email_verified_at = Carbon::now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole($role);

        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "admin@mail.com";
        $admin->image = "backend/image/default.png";
        $admin->password = bcrypt('password');
        $admin->email_verified_at = Carbon::now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole($role);
    }
}
