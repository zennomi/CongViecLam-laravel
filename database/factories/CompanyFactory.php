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
            'logo'                  =>  $this->faker->randomElement([
                'https://telegraph-image-bak.pages.dev/file/e6a97ffedb55c2a39e232.png',
                'https://telegraph-image-bak.pages.dev/file/05a1a5109c1004a9d1f19.png',
                'https://telegraph-image-bak.pages.dev/file/b282894adcbfe9f1b0910.png',
                'https://telegraph-image-bak.pages.dev/file/676fb334006c0711c9c56.png',
                'https://telegraph-image-bak.pages.dev/file/ef6c01703d9ff2a4f9dc4.png',
                'https://telegraph-image-bak.pages.dev/file/dba40aeb50d33000bf305.png',
                'https://telegraph-image-bak.pages.dev/file/3e8b2ca9e95b59e9227c7.png',
                'https://telegraph-image-bak.pages.dev/file/aa5cb2979950819eee401.png',
                'https://telegraph-image-bak.pages.dev/file/ab5ab60307f3bcbc5f4ff.png',
                'https://telegraph-image-bak.pages.dev/file/b24b33c5651a1a12f9acd.png',
                'https://telegraph-image-bak.pages.dev/file/289e44d3fd9a5cc4e3746.png',
                'https://telegraph-image-bak.pages.dev/file/5c009c4938b3221cfca99.png',
                'https://telegraph-image-bak.pages.dev/file/0b067d1cf1f17ef01ab7d.png',
                'https://telegraph-image-bak.pages.dev/file/98f72d73be19c0c21db91.png',
                'https://telegraph-image-bak.pages.dev/file/dba40aeb50d33000bf305.png',
                'https://telegraph-image-bak.pages.dev/file/ef6c01703d9ff2a4f9dc4.png',
            ]),
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
