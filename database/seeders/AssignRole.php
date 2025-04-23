<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
            echo "Role assigned to User ID 1\n";
        } else {
            echo "User not found\n";
        }
    }
}
