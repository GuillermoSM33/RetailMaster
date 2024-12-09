<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = Permission::pluck('name')->toArray();

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'), 
            ]
        );

        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $adminRole->syncPermissions($permissions);
        $adminUser->assignRole($adminRole);

        $cashierUser = User::firstOrCreate(
            ['email' => 'cashier@example.com'], 
            [
                'name' => 'Cajero',
                'password' => Hash::make('password'), 
            ]
        );

        $cashierRole = Role::firstOrCreate(['name' => 'Cajero', 'guard_name' => 'web']);
        $cashierUser->assignRole($cashierRole);
    }
}
