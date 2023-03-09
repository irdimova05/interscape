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

        $specialties = [];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
