<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ver',
            'crear',
            'editar',
            'eliminar',
        ];

        $permissionsChasier = [
            'ver',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $adminRole->givePermissionTo($permissions);

        $chasierRole = Role::firstOrCreate(['name' => 'Cajero', 'guard_name' => 'web']);
        $chasierRole->givePermissionTo($permissionsChasier);
    }
}
