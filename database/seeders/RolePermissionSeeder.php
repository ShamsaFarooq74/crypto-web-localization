<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);

        $permissions = [
            'package-create',
            'package-edit',
            'package-delete',
            'package-view',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'customer-view',
        ];
        foreach ($permissions as $permissionName) {
            $check =   Permission::where('name', $permissionName)->first();
            if (!$check) {
                $permissionName = Permission::create(['name' => $permissionName]);
            }
            $adminRole->givePermissionTo($permissionName);
        }
    }
}
