<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployerAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'employer')
            ->select('users.*')
            ->get();

        foreach ($users as $user) {
            Employer::factory()
                ->hasAds(2)
                ->create([
                    'user_id' => $user->id,
                ]);
        }
    }
}
