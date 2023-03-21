<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Apply;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ApplySeeder extends Seeder
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
            ->where('roles.name', 'student')
            ->select('users.*')
            ->get();

        $ads = Ad::all();

        foreach ($ads as $ad) {
            foreach ($users as $user) {
                Apply::factory()
                    ->state(new Sequence(
                        fn ($sequence) => [
                            'ad_id' => $ad->id,
                            'user_id' => $user->id,
                        ],
                    ))
                    ->create();
            }
        }
    }
}
