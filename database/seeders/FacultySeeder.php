<?php

namespace Database\Seeders;

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
            ],
            [
                'name' => 'Корабостроителен факултет',
                'slug' => 'kf',
            ],
            [
                'name' => 'Електротехнически факултет',
                'slug' => 'ef',
            ],
            [
                'name' => 'Факултет по изчислителна техника и автоматизация',
                'slug' => 'fita',
            ],
        ];

        foreach ($faculties as $faculty) {
            \App\Models\Faculty::create($faculty);
        }
    }
}
