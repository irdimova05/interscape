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
                'name' => 'Автоматика, информационни и управляващи компютърни системи',
                'abbreviation' => 'АИУКС',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Автомобилна техника',
                'abbreviation' => 'АТ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Агрономство',
                'abbreviation' => 'А',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Биомедицинска електроника',
                'abbreviation' => 'БМЕ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Възобновяеми енергийни източници',
                'abbreviation' => 'ВЕИ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Електроенергетика',
                'abbreviation' => 'ЕЕ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Електроника',
                'abbreviation' => 'Е',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Електрообзавеждане на кораба',
                'abbreviation' => 'ЕОК',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Електроснабдяване и електрообзавеждане',
                'abbreviation' => 'ЕСЕО',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Електротехника и електротехнологии',
                'abbreviation' => 'ЕТЕТ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Защита на населението при бедствия и аварии',
                'abbreviation' => 'ЗНБА',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Индустриален дизайн',
                'abbreviation' => 'ИД',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Индустриален мениджмънт',
                'abbreviation' => 'ИМ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Инженерна екология',
                'abbreviation' => 'ИЕ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Информационни и комуникационни технологии',
                'abbreviation' => 'ИКТ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Компютъризирани технологии в машиностроенето',
                'abbreviation' => 'КТМ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Компютърни системи и технологии',
                'abbreviation' => 'КСТ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Корабни машини и механизми (КММ)',
                'abbreviation' => 'КММ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Корабоводене',
                'abbreviation' => 'КВ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Корабостроене и морска техника',
                'abbreviation' => 'КМТ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Логистика на водния транспорт',
                'abbreviation' => 'ЛВТ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Машиностроителна техника и технологии',
                'abbreviation' => 'МТТ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Производствен инженеринг',
                'abbreviation' => 'ПИ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Роботика и мехатроника',
                'abbreviation' => 'РМ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Социален мениджмънт',
                'abbreviation' => 'СМ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Технологично предприемачество и иновации',
                'abbreviation' => 'ТПИ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Топлотехника и инвестиционно проектиране',
                'abbreviation' => 'ТИП',
                'faculty_id' => 2,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Транспортна техника и технологии',
                'abbreviation' => 'ТТТ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Софтуерни и интернет технологии',
                'abbreviation' => 'СИТ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::BACHELOR],
            ],
            [
                'name' => 'Безопасни и здравословни условия на труд',
                'abbreviation' => 'БЗУТ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'Възобновяеми енергийни източници',
                'abbreviation' => 'ВЕИ',
                'faculty_id' => 3,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'ДВГ и Автомобилна техника',
                'abbreviation' => 'ДВГ',
                'faculty_id' => 1,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'Екотехнологични системи в индустрията',
                'abbreviation' => 'ЕСИ',
                'faculty_id' => 2,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'Експлоатация на флота и пристанищата',
                'abbreviation' => 'ЕФП',
                'faculty_id' => 2,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'Киберсигурност',
                'abbreviation' => 'КС',
                'faculty_id' => 4,
                'education_id' => $educations[Education::MASTER],
            ],
            [
                'name' => 'Софтуерно инженерство',
                'abbreviation' => 'СИ',
                'faculty_id' => 4,
                'education_id' => $educations[Education::MASTER],
            ],

        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
