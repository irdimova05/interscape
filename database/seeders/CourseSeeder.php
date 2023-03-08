<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Първи',
                'slug' => 'first',
            ],
            [
                'name' => 'Втори',
                'slug' => 'second',
            ],
            [
                'name' => 'Трети',
                'slug' => 'third',
            ],
            [
                'name' => 'Четвърти',
                'slug' => 'fourth',
            ],
            [
                'name' => 'Пети',
                'slug' => 'fifth',
            ],
            [
                'name' => 'Шести',
                'slug' => 'sixth',
            ],
            [
                'name' => 'Завършил',
                'slug' => 'graduated',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
