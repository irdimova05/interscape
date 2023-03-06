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
                'name' => 'Първи курс',
                'slug' => 'first',
            ],
            [
                'name' => 'Втори курс',
                'slug' => 'second',
            ],
            [
                'name' => 'Трети курс',
                'slug' => 'third',
            ],
            [
                'name' => 'Четвърти курс',
                'slug' => 'fourth',
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
