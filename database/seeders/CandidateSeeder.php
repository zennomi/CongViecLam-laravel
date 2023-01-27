<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\JobRole;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profession;
use App\Models\SocialLink;
use App\Models\ContactInfo;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;

class CandidateSeeder extends Seeder
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
        $candidate->name = 'John Doe';
        $candidate->username = 'johndoe';
        $candidate->email = 'candidate@mail.com';
        $candidate->password = bcrypt('password');
        $candidate->role = 'candidate';
        $candidate->email_verified_at = Carbon::now();
        $candidate->is_demo_field = true;
        $candidate->save();
        $candidate->candidate()->create([
            'role_id' => JobRole::inRandomOrder()->value('id'),
            'profession_id' => Profession::inRandomOrder()->value('id'),
            'experience_id' => Experience::inRandomOrder()->value('id'),
            'education_id' => Education::inRandomOrder()->value('id'),
            'gender' => 'male',
            'website' => 'https://johndoe.com',
            'title' => 'This is candidate Title !',
            'birth_date' => Carbon::now(),
            'marital_status' => 'married',
            'photo' => 'frontend/assets/images/all-img/model-image.jpg',
            'bio' => 'Sometimes you may wish to stop running validation rules on an attribute after the first validation  failure. To do so, assign the bail rule to the attribute:',
            'profile_complete' => 0,
        ]);
        $candidate->socialInfo()->create([
            'social_media' => 'facebook',
            'url' => 'https://www.facebook.com/zakirsoft',
            // 'google' => 'https://www.google.com/search?q=zakirsoft',
            // 'facebook' => 'https://www.facebook.com/zakirsoft',
            // 'twitter' => 'https://www.twitter.com/zakirsoft',
            // 'instagram' => 'https://www.instagram.com/zakirsoft',
            // 'linkedin' => 'https://www.linkedin.com/zakirsoft',
            // 'youtube' => 'https://www.youtube.com/zakirsoft',
        ]);
        $candidate->contactInfo()->create([
            'phone' => '+880123456789',
            'secondary_phone' => '+880123456789',
            'email' => 'jhondoe@gmail.com',
            'secondary_email' => 'doejhon@gmail.com',
        ]);

        Candidate::factory(50)->create();
    }
}
