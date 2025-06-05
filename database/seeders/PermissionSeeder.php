<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Add memeber
            'member index',
            'member create',
            'member show',
            'member edit',
            'member update',
            'member destroy',
            'member search',
            'member updateFee',
            'member updateFee',
            // Add service
            'service index',
            'service create',
            'service show',
            'service edit',
            'service update',
            'service destroy',
            // Add trainer
            'trainer index',
            'trainer create',
            'trainer show',
            'trainer edit',
            'trainer update',
            'trainer destroy',
            'trainer delete',
            'trainer restore',
            // Add dashboard
            'dashboard index',
            'dashboard create',
            'dashboard show',
            'dashboard edit',
            'dashboard update',
            'dashboard destroy',
            // Add user role
            'user-role index',
            'user-role create',
            'user-role update',
            'user-role delete',
            // Add user role
            'roles-permission index',
            'roles-permission create',
            'roles-permission update',
            'roles-permission delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
