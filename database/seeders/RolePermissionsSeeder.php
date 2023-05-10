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
                Permission::create(['name' => 'release.reported_ad']),
                Permission::create(['name' => 'block.reported_ad']),
            ];

        $studentPermissions =
            [

                Permission::create(['name' => 'list.employer']),
                Permission::create(['name' => 'show.employer']),
                Permission::create(['name' => 'employer.interest']),
                Permission::create(['name' => 'apply.ad']),
                Permission::create(['name' => 'add.favorites']),
                Permission::create(['name' => 'remove.favorites']),
                Permission::create(['name' => 'list.favorites']),
                Permission::create(['name' => 'report.ad'])
            ];

        $employerPermissions =
            [

                Permission::create(['name' => 'student.interest']),
                Permission::create(['name' => 'create.ad']),
                Permission::create(['name' => 'edit.ad']),
                Permission::create(['name' => 'activate.ad']),
                Permission::create(['name' => 'deactivate.ad']),
                Permission::create(['name' => 'list.student']),
                Permission::create(['name' => 'show.student']),
                Permission::create(['name' => 'list.applies']),
                Permission::create(['name' => 'show.apply']),
                Permission::create(['name' => 'approve.apply']),
                Permission::create(['name' => 'reject.apply']),
            ];

        $sharedStudentEmployerPermissions =
            [
                Permission::create(['name' => 'edit.profile']),
                Permission::create(['name' => 'show.profile']),
                Permission::create(['name' => 'show.ad']),
                Permission::create(['name' => 'list.ad']),
            ];


        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);
        $employerRole = Role::create(['name' => 'employer']);

        $adminRole->syncPermissions($adminPermissions);
        $studentRole->syncPermissions($studentPermissions, $sharedStudentEmployerPermissions);
        $employerRole->syncPermissions($employerPermissions, $sharedStudentEmployerPermissions);
    }
}
