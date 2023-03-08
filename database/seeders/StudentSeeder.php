<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'student')
            ->select('users.*')
            ->get();


        $universities = University::all();
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $courses = Course::all();

        foreach ($users as $user) {
            Student::factory()
                ->state(new Sequence(
                    fn ($sequence) => [
                        'university_id' => $universities->random(),
                        'faculty_id' => $faculties->random(),
                        'specialty_id' => $specialties->random(),
                        'course_id' => $courses->random(),
                        'user_id' => $user->id,
                    ],
                ))
                ->create();
        }
    }
}
