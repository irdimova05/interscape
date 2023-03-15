<?php

namespace Database\Seeders;

use App\Models\AdCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Софтуерни науки',
                'slug' => 'programming',
            ],
            [
                'name' => 'Хардуерни науки',
                'slug' => 'hardware',
            ],
            [
                'name' => 'Маркетинг',
                'slug' => 'marketing',
            ],
            [
                'name' => 'Мениджмънт',
                'slug' => 'management',
            ],
            [
                'name' => 'Финанси',
                'slug' => 'finance',
            ],
            [
                'name' => 'Администрация',
                'slug' => 'administration',
            ],
            [
                'name' => 'Право, Юридически услуги',
                'slug' => 'law',
            ],
        ];

        foreach ($categories as $category) {
            AdCategory::create($category);
        }
    }
}
