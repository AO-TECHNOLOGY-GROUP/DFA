<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
            'create_users' => 'Creates users',
            'manage_users' => 'Manage users', //(edit, delete)
            'view_users' => '',
            'show_user' => 'View user details',
            'verify_user' => 'Verifies user',
            'user_delete' => 'delete user',
            'restore_user' => 'restore delete user',

            'view_configs' => 'can view system configurations',

            'access_uploads' => 'Access uploads',
            'perform_uploads' => 'Performs uploads',
            'verify_uploads' => 'Verifies uploads',

            'create_role' => 'Create role',
            'manage_role' => 'Manage roles',
            'view_roles' => 'View roles',
            'verify_roles' => 'Verifies roles',
            'view_permissions' => '',

            'create_branch' => 'capture new branch',
            'view_branch' => 'view branches listing',
            'manage_branch' => 'manage (edit/update) branches',
            'create_location' => 'capture new location',
            'view_location' => 'view locations listing',
            'manage_location' => 'manage (edit/update) locations',

            'change_password' => 'change own password'
        ];

        foreach ($permissions as $name => $desc) {
            Permission::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);
        }

        #####################################################################################################

        $perms = Permission::all();
        $excludePerms = Arr::except($perms, ['inquire_balance', 'make_deposits', 'make_withdrawal']);
        $roles = ['super-admin' => "Administrator (All access)"];

        foreach ($roles as $name => $desc) {
            $role = Role::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);
            $role->syncPermissions($excludePerms);
        }

        #####################################################################################################

        //Admin
        $name = 'administrator';
        $desc = 'System administrator (Selected access functionality)';
        $admin_role = Role::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);

        $admin_permissions = ['create_branch', 'manage_users', 'view_users', 'verify_user', 'show_user', 'view_permissions',
            'manage_branch', 'view_branch', 'manage_branch', 'create_location', 'view_location', 'manage_location',
            'change_password', 'view_roles', 'access_uploads', 'perform_uploads', 'verify_uploads', 'view_configs'];
        $admin_permissions = Permission::whereIn('name', $admin_permissions)->get();
        $admin_role->syncPermissions($admin_permissions);

        #####################################################################################################

        //Maker
        $name = 'relationship-manager';
        $desc = 'Initializes processes ';
        $rm_role = Role::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);

        $rm_permissions = ['access_uploads', 'perform_uploads', 'change_password'];
        $rm_permissions = Permission::whereIn('name', $rm_permissions)->get();
        $rm_role->syncPermissions($rm_permissions);

        #####################################################################################################



    }
}
