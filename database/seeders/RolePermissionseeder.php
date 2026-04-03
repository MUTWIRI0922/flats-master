<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RolePermission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed roles
        $roles = [
            'Admin',
            'Agent',
            'Tenant',
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
        //seed permissions
        $permissions = [
            'manage properties',
            'manage tenants',
            'manage agents',
            'view properties',
            'view tenants',
            'view agents',
            'manage leases',
            'view leases',
            'manage payments',
            'view payments',
            'manage maintenance requests',
            'view maintenance requests',
            'manage lease renewals',
            'view lease renewals',
            'manage users',
            'view users',
            'manage roles',
            'manage permissions',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }


    }
}
