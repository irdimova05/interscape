<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobTypes = [
            [
                'name' => 'Стаж',
                'slug' => 'internship',
            ],
            [
                'name' => 'Постоянна работа',
                'slug' => 'permanent',
            ],
        ];

        foreach ($jobTypes as $jobType) {
            JobType::create($jobType);
        }
    }
}
