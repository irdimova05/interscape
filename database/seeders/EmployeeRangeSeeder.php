<?php

namespace Database\Seeders;

use App\Models\EmployeeRanges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranges = [
            [
                'range' => '1-50',
                'slug' => 'range_1_50',
            ],
            [
                'range' => '51-100',
                'slug' => 'range_51_100',
            ],
            [
                'range' => '101-500',
                'slug' => 'range_101_500',
            ],
            [
                'range' => 'Over 500',
                'slug' => 'range_over_500',
            ],
        ];

        foreach ($ranges as $range) {
            EmployeeRanges::create($range);
        }
    }
}
