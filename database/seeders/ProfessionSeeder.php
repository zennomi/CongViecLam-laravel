<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            'Physician', 'Engineer', 'Chef', 'Lawyer', 'Designer', 'Labourer', 'Dentist', 'Accountant', 'Dental Hygienist', 'Actor', 'Electrician', 'Software Developer', 'Pharmacist', 'Technician', 'Artist', 'Teacher', 'Journalist', 'Cashier', 'Secretary', 'Scientist', 'Soldier', 'Gardener', 'Farmer', 'Librarian', 'Driver', 'Fishermen', 'Police Officer ', 'Tailor'
        ];

        foreach ($professions as $profession) {
            Profession::create([
                'name' => $profession,
                'slug' => Str::slug($profession),
            ]);
        }
    }
}
