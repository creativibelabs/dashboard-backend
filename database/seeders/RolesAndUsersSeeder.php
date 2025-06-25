<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            'admin',
            'client',
            'project-manager',
            'team-lead-developer',
            'team-lead-designer',
            'developer',
            'designer',
            'sales-manager',
            'sales-person',
            'team-lead-seo',
            'seo-specialist',
            'team-lead-smm',
            'smm-specialist',
            'team-lead-qa',
            'qa-engineer',
        ];

        // Create roles
        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            $permission = Permission::create(['name' => 'view ' . $roleName]);

            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }

        // Create users with each role
        foreach ($roles as $index => $roleName) {
            $user = User::create([
                'name' => ucwords(str_replace('-', ' ', $roleName)),
                'email' => $roleName . '@example.com',
                'password' => Hash::make('password'), // default password
                'email_verified_at' => now(),
            ]);

            $user->assignRole($roleName);
        }
    }
}
