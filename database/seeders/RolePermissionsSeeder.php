<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions =
            [
                Permission::create(['name' => 'approve.student']),
                Permission::create(['name' => 'approve.ad']),
                Permission::create(['name' => 'approve.employer']),
                Permission::create(['name' => 'delete.student']),
                Permission::create(['name' => 'delete.employer'])
            ];

        $studentPermissions =
            [
                Permission::create(['name' => 'apply.ad'])
            ];

        $employerPermissions =
            [
                Permission::create(['name' => 'create.ad']),
                Permission::create(['name' => 'edit.ad']),
                Permission::create(['name' => 'delete.ad']),
                Permission::create(['name' => 'list.student'])
            ];

        $sharedStudentEmployerPermissions =
            [
                Permission::create(['name' => 'edit.profile']),
                Permission::create(['name' => 'delete.profile']),
                Permission::create(['name' => 'show.profile']),
                Permission::create(['name' => 'show.ad']),
                Permission::create(['name' => 'list.ad']),
                Permission::create(['name' => 'show.employer']),
                Permission::create(['name' => 'show.student'])
            ];


        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);
        $employerRole = Role::create(['name' => 'employer']);

        $adminRole->syncPermissions($adminPermissions, $studentPermissions, $employerPermissions, $sharedStudentEmployerPermissions);
        $studentRole->syncPermissions($studentPermissions, $sharedStudentEmployerPermissions);
        $employerRole->syncPermissions($employerPermissions, $sharedStudentEmployerPermissions);
    }
}
