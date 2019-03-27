<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // --setup
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'edit announcement']);
        Permission::create(['name' => 'add slot']);
        Permission::create(['name' => 'edit slot']);
        Permission::create(['name' => 'delete slot']);
        Permission::create(['name' => 'add assignment']);
        Permission::create(['name' => 'edit assignment']);
        Permission::create(['name' => 'delete assignment']);
        Permission::create(['name' => 'add course']);
        Permission::create(['name' => 'edit course']);
        Permission::create(['name' => 'delete course']);
        // --personal coaching
        Permission::create(['name' => 'enrol counselee']);
        Permission::create(['name' => 'edit checklist']);
        Permission::create(['name' => 'schedule session']);
        Permission::create(['name' => 'approve session']);
        Permission::create(['name' => 'upload resume']);
        Permission::create(['name' => 'approve resume']);
        Permission::create(['name' => 'update status']);
        // --class
        Permission::create(['name' => 'enrol participant']);
        Permission::create(['name' => 'take attendance']);


        // create roles and assign created permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'student'])
            ->givePermissionTo(['edit checklist', 'schedule session', 'upload resume']);

        $role = Role::create(['name' => 'coach'])
            ->givePermissionTo(['add slot', 'edit slot', 'delete slot',
            'add assignment', 'edit assignment', 'delete assignment',
            'add course', 'edit course', 'delete course',
            'enrol counselee', 'approve session', 'approve resume', 'update status',
            'view user', 'add user',
            ]);
    }
}
