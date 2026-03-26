<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RolePermission;


class RolePermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed roles
        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Agent', 'guard_name' => 'web'],
            ['name' => 'Tenant', 'guard_name' => 'web'],    
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
        //seed permissions
        $permissions = [
            ['name' => 'manage properties', 'guard_name' => 'web'],
            ['name' => 'manage tenants', 'guard_name' => 'web'],
            ['name' => 'manage agents', 'guard_name' => 'web'],
            ['name' => 'view properties', 'guard_name' => 'web'],
            ['name' => 'view tenants', 'guard_name' => 'web'],
            ['name' => 'view agents', 'guard_name' => 'web'],
            ['name' => 'manage leases', 'guard_name' => 'web'],
            ['name' => 'view leases', 'guard_name' => 'web'],
            ['name' => 'manage payments', 'guard_name' => 'web'],
            ['name' => 'view payments', 'guard_name' => 'web'],
            ['name' => 'manage maintenance requests', 'guard_name' => 'web'],
            ['name' => 'view maintenance requests', 'guard_name' => 'web'],
            ['name' => 'manage lease renewals', 'guard_name' => 'web'],
            ['name' => 'view lease renewals', 'guard_name' => 'web'],
            ['name' => 'manage users', 'guard_name' => 'web'],
            ['name' => 'view users', 'guard_name' => 'web'],
            ['name' => 'manage roles', 'guard_name' => 'web'],
            ['name' => 'manage permissions', 'guard_name' => 'web'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        //assign permissions to roles
        $adminRole = Role::where('name', 'Admin')->first();
        $adminRole->syncPermissions(Permission::all());

    }
}
