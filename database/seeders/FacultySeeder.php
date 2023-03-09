<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = [
            [
                'name' => 'Машинно-технологичен факултет',
                'slug' => 'mtf',
                'university_id' => 1,
            ],
            [
                'name' => 'Корабостроителен факултет',
                'slug' => 'kf',
                'university_id' => 1,
            ],
            [
                'name' => 'Електротехнически факултет',
                'slug' => 'ef',
                'university_id' => 1,
            ],
            [
                'name' => 'Факултет по изчислителна техника и автоматизация',
                'slug' => 'fita',
                'university_id' => 1,
            ],
            [
                'name' => 'Добруджански технологичен колеж',
                'slug' => 'dtk',
                'university_id' => 1,
            ],
            [
                'name' => 'Колеж в структурата на ТУ-Варна',
                'slug' => 'kstuv',
                'university_id' => 1,
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
