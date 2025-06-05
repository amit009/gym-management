<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Amit',
                'email' => 'amitrkumar715@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('Xgamer@009'),
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'John',
                'email' => 'john@example.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('password123'),
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate($user);
        }
    }
}
