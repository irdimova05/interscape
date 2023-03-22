<?php

namespace Database\Seeders;

use App\Models\ApplyStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplyStatusSeeder extends Seeder
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
                'name' => 'Одобрена',
                'slug' => 'approved',
            ],
            [
                'name' => 'Отхвърлена',
                'slug' => 'rejected',
            ],
            [
                'name' => 'Чака одобрение',
                'slug' => 'awaiting',
            ],
        ];

        foreach ($statuses as $status) {
            ApplyStatus::create($status);
        }
    }
}
