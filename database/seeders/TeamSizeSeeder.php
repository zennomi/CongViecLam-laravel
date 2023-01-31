<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team_sizes = [
            'Chỉ mình tôi','10 thành viên', '10-20 thành viên', '20-50 thành viên', '50-100 thành viên', '100-200 thành viên', '200-500 thành viên', '500+ thành viên'
        ];

        foreach ($team_sizes as $size) {
            TeamSize::create([
                'name' => $size,
                'slug' => Str::slug($size)
            ]);
        }
    }
}
