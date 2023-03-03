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
            ],
            [
                'name' => 'Корабостроителен факултет',
            ],
            [
                'name' => 'Електротехнически факултет',
            ],
            [
                'name' => 'Факултет по изчислителна техника и автоматизация',
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
