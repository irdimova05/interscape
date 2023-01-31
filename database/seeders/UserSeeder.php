<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->state(fn (array $attributes) => [
                'name' => 'Test',
                'email' => 'test1@test.com',
                'password' => Hash::make('test1'),
            ])
            ->create();
        User::factory()
            ->count(10)
            ->create();
    }
}
