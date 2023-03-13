<?php

namespace Database\Seeders;

use App\Models\AdStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Активна',
                'slug' => 'active',
            ],
            [
                'name' => 'Неактивна',
                'slug' => 'inactive',
            ],
            [
                'name' => 'Блокирана',
                'slug' => 'blocked',
            ],
        ];

        foreach ($statuses as $status) {
            AdStatus::create($status);
        }
    }
}
