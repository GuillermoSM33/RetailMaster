<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario Administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'), 
            ]
        );

        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
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
