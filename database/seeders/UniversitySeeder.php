<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            [
                'name' => 'Технически университет - Варна',
                'abbreviation' => 'ТУ-Варна',
            ]
        ];

        foreach ($universities as $university) {
            University::create($university);
        }
    }
}
