<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create user
        $user = User::create([
            'name' => 'Master Admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('123'),
            'email_verified_at' => Carbon::now(),
        ]);

        $role = Role::create(['name' => 'super-admin']);
        $user->assignRole($role);

        $role = Role::create(['name' => 'user']);
        // create permissions
        $arrayOfPermissionNames = ['delete user', 'edit user', 'add user', 'see user', 'create role', 'see role'];
    $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
        return ['name' => $permission, 'guard_name' => 'web', 'created_at' => now()];
    });
        Permission::insert($permissions->toArray());

    }
}