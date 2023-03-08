<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            [
                'name' => 'Бакалавър',
                'slug' => 'bachelor',
            ],
            [
                'name' => 'Професионален бакалавър',
                'slug' => 'professional_bachelor',
            ],
            [
                'name' => 'Магистър',
                'slug' => 'master',
            ],

            [
                'name' => 'Докторант',
                'slug' => 'doctorant',
            ],
            [
                'name' => 'Доктор',
                'slug' => 'doctor',
            ],
        ];

        foreach ($educations as $education) {
            Education::create($education);
        }
    }
}
