<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use App\Models\SocialLink;
use App\Models\ContactInfo;
use Illuminate\Support\Str;
use App\Models\IndustryType;
use App\Models\OrganizationType;
use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use App\Models\CompanyBookmarkCategory;
use App\Models\Nationality;
use App\Models\TeamSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company();

        $company = User::create([
            'name' => $name,
            'username' => Str::slug($name),
            'email' => $this->faker->unique()->safeEmail,
            'role' => 'company',
            'password' => bcrypt('password'), // password
            'email_verified_at' => now(),
            'is_demo_field' => true,
        ]);
        $company->socialInfo()->create([
            'social_media' => 'facebook',
            'url' => 'https://www.facebook.com/zakirsoft',
            // 'twitter' => 'https://www.twitter.com/zakirsoft',
            // 'instagram' => 'https://www.instagram.com/zakirsoft',
            // 'linkedin' => 'https://www.linkedin.com/zakirsoft',
            // 'youtube' => 'https://www.youtube.com/zakirsoft',
        ]);

        $company->contactInfo()->create([
            'phone' => '+880123456789',
            'email' => $this->faker->unique()->safeEmail,
        ]);

        return [
            'user_id'               =>  $company->id,
            'industry_type_id' => IndustryType::inRandomOrder()->value('id'),
            'organization_type_id'     =>  OrganizationType::inRandomOrder()->value('id'),
            'team_size_id'             => TeamSize::inRandomOrder()->value('id'),
            'nationality_id' => Nationality::inRandomOrder()->value('id'),
            'bio'                 =>  $this->faker->text(),
            'logo'                  =>  $this->faker->imageUrl,
            'banner'                =>  $this->faker->imageUrl(1024, 300),
            'vision'                 =>  $this->faker->text(),
            'establishment_date'         =>  $this->faker->date(),
            'website'                =>  $this->faker->url,
            'profile_completion' => 1,
            'country' => $this->faker->country(),
            'lat' => $this->faker->latitude(-90, 90),
            'long' => $this->faker->longitude(-90, 90)
        ];
    }
}
