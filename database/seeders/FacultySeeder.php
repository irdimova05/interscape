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
                'abbreviation' => 'mtf',
                'university_id' => 1,
            ],
            [
                'name' => 'Корабостроителен факултет',
                'abbreviation' => 'kf',
                'university_id' => 1,
            ],
            [
                'name' => 'Електротехнически факултет',
                'abbreviation' => 'ef',
                'university_id' => 1,
            ],
            [
                'name' => 'Факултет по изчислителна техника и автоматизация',
                'abbreviation' => 'fita',
                'university_id' => 1,
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
