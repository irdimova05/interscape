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
                Permission::create(['name' => 'create.student']),
                Permission::create(['name' => 'activate.student']),
                Permission::create(['name' => 'deactivate.student']),
                Permission::create(['name' => 'create.employer']),
                Permission::create(['name' => 'deactivate.employer']),
                Permission::create(['name' => 'list.reported_ad']),
                Permission::create(['name' => 'block.reported_ad']),
            ];

        $studentPermissions =
            [
                
                Permission::create(['name' => 'follow.employer']),
                Permission::create(['name' => 'show.employer']),
                Permission::create(['name' => 'apply.ad'])
            ];

        $employerPermissions =
            [
                
                Permission::create(['name' => 'follow.student']),
                Permission::create(['name' => 'create.ad']),
                Permission::create(['name' => 'edit.ad']),
                Permission::create(['name' => 'activate.ad']),
                Permission::create(['name' => 'deactivate.ad']),
                Permission::create(['name' => 'list.student']),
                Permission::create(['name' => 'show.student']),
                Permission::create(['name' => 'list.applications'])
            ];

        $sharedStudentEmployerPermissions =
            [
                Permission::create(['name' => 'edit.profile']),
                Permission::create(['name' => 'delete.profile']),
                Permission::create(['name' => 'show.profile']),
                Permission::create(['name' => 'show.ad']),
                Permission::create(['name' => 'list.ad']),
                Permission::create(['name' => 'report.ad']),
            ];


        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);
        $employerRole = Role::create(['name' => 'employer']);

        $adminRole->syncPermissions($adminPermissions, $studentPermissions, $employerPermissions, $sharedStudentEmployerPermissions);
        $studentRole->syncPermissions($studentPermissions, $sharedStudentEmployerPermissions);
        $employerRole->syncPermissions($employerPermissions, $sharedStudentEmployerPermissions);
    }
}
