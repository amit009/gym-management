<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Personal Training', 'fee' => 50],
            ['name' => 'Yoga Classes', 'fee' => 25],
            ['name' => 'Nutrition Consultation', 'fee' => 30],
            ['name' => 'Zumba Session', 'fee' => 20],
            ['name' => 'CrossFit Training', 'fee' => 45],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
