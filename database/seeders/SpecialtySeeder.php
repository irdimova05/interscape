<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Faculty;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = Education::all()->pluck('id', 'slug');

        $specialties = [
            [
                'name' => 'Материалознание и технология на материалите',
                'slug' => 'mtm',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
