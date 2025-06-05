<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'trainer']);
        Role::firstOrCreate(['name' => 'member']);

        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'view workouts']);

        $role = Role::findByName('admin');
        $role->givePermissionTo('manage users');

        $trainer = Role::findByName('trainer');
        $trainer->givePermissionTo('view workouts');

        $this->call([
            ServiceSeeder::class,
        ]);

        $this->call([
            TrainerSeeder::class,
        ]);
    }
}
