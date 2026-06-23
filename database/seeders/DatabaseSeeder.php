<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $ownerRole = Role::firstOrCreate(['name' => 'owner', 'guard_name' => 'web']);
        $tenantRole = Role::firstOrCreate(['name' => 'tenant', 'guard_name' => 'web']);
        $staffRole = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        $admin = User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name'     => 'Admin',
                'type'     => 'admin',
                'avatar'   => 'default.png',
                'password' => Hash::make('codeastro.com'),
            ]
        );
        $admin->syncRoles([$adminRole]);

        $agent = User::updateOrCreate(
            ['email' => 'agent@mail.com'],
            [
                'name'     => 'Agent shad',
                'type'     => 'staff',
                'avatar'   => 'default.png',
                'password' => Hash::make('codeastro.com'),
            ]
        );
        $agent->syncRoles([$staffRole]);

        $user = User::updateOrCreate(
            ['email' => 'user@mail.com'],
            [
                'name'     => 'User Demo',
                'type'     => 'tenant',
                'avatar'   => 'default.png',
                'password' => Hash::make('codeastro.com'),
            ]
        );
        $user->syncRoles([$tenantRole]);
    }   
}   
