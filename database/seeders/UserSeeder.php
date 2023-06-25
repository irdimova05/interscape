<?php

namespace Database\Seeders;

use App\Models\Status;
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
            ->state(fn (array $attributes) =>
            [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('admin'),
                'status_id' => Status::where('slug', Status::ACTIVE)->first()->id,
            ])
            ->create()
            ->assignRole(Role::findByName('admin'));

        User::factory()
            ->state(fn (array $attributes) =>
            [
                'name' => 'student',
                'email' => 'student@test.com',
                'password' => Hash::make('student'),
                'status_id' => Status::where('slug', Status::ACTIVE)->first()->id,
            ])
            ->create()
            ->assignRole(Role::findByName('student'));

        User::factory()
            ->state(fn (array $attributes) =>
            [
                'name' => 'employer',
                'email' => 'employer@test.com',
                'password' => Hash::make('employer'),
                'status_id' => Status::where('slug', Status::ACTIVE)->first()->id,
            ])
            ->create()
            ->assignRole(Role::findByName('employer'));

        User::factory()
            ->state(fn (array $attributes) =>
            [
                'name' => 'inactive',
                'email' => 'inactive@test.com',
                'password' => Hash::make('inactive'),
                'status_id' => Status::where('slug', Status::INACTIVE)->first()->id,
            ])
            ->create()
            ->assignRole(Role::findByName('employer'));

        User::factory()
            ->state(fn (array $attributes) =>
            [
                'name' => 'complete',
                'email' => 'complete@test.com',
                'password' => Hash::make('complete'),
                'is_profile_completed' => false,
                'status_id' => Status::where('slug', Status::INACTIVE)->first()->id,
            ])
            ->create()
            ->assignRole(Role::findByName('employer'));

        $users = User::factory()
            ->count(30)
            ->state(new Sequence(
                fn ($sequence) => ['status_id' => Status::all()->random()],
            ))
            ->create();

        $roles = Role::whereIn('name', ['student', 'employer'])->get();

        foreach ($users as $user) {
            $user->assignRole($roles->random());
        }
    }
}
