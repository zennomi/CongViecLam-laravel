<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Candidate;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class AllAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // student
        $student = new Student();
        $student->name = 'student';
        $student->email = 'student@mail.com';
        $student->password = bcrypt('password');
        $student->save();

        // teacher
        $teacher = new Teacher();
        $teacher->name = 'teacher';
        $teacher->email = 'teacher@mail.com';
        $teacher->password = bcrypt('password');
        $teacher->save();

        // user
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@mail.com';
        $user->password = bcrypt('password');
        $user->save();

        // customer
        $user = new Customer();
        $user->name = 'customer';
        $user->email = 'customer@mail.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
