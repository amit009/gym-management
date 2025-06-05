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
            ['name' => 'Personal Training', 'fee' => 500],
            ['name' => 'Yoga Classes', 'fee' => 250],
            ['name' => 'Nutrition Consultation', 'fee' => 300],
            ['name' => 'Zumba Session', 'fee' => 200],
            ['name' => 'CrossFit Training', 'fee' => 450],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate($service);
        }
    }
}
