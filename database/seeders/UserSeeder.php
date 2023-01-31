<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            ->create()
            ->assignRole(Role::findByName('admin'));

        $users = User::factory()
            ->count(10)
            ->create();

        $roles = Role::whereIn('name', ['student', 'employer'])->get();

        foreach ($users as $user) {
            $user->assignRole($roles->random());
        }
    }
}
