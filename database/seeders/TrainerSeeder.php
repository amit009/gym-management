<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'gender' => 'male',
                'date_of_birth' => '1990-01-01',
                'address' => '123 Main St, City',
                'specialization' => 'Strength Training',
                'profile_photo' => 'profiles/john.jpg',
                'status' => 'active',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'phone' => '0987654321',
                'gender' => 'female',
                'date_of_birth' => '1992-05-15',
                'address' => '456 High St, City',
                'specialization' => 'Yoga',
                'profile_photo' => 'profiles/jane.jpg',
                'status' => 'active',
            ],
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
