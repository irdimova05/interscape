<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Company;
use App\Models\Employer;
use App\Models\User;
use Database\Factories\EmployerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyEmployerAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::factory()->count(3)->create();
        $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'employer')
            ->select('users.*')
            ->get();

        foreach ($users as $user) {
            $company = $companies->random();
            $employer = Employer::factory()->create([
                'user_id' => $user->id,
                'company_id' => $company->id,
            ]);

            Ad::factory()->count(2)->create([
                'employer_id' => $employer->id,
                'company_id' => $company->id,
            ]);
        }
    }
}
