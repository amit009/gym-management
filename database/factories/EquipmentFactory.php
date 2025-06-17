<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Machine',
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'quantity' => $this->faker->numberBetween(1, 10),
            'equipment_type' => $this->faker->randomElement(['Cardio', 'Strength', 'Flexibility', 'Balance']),
            'vendor' => $this->faker->company(),
            'phone_no' => $this->faker->phoneNumber(),
            'brand' => $this->faker->word(),
            'description' => $this->faker->sentence(10),
            'address' => $this->faker->address(),
            'purchase_date' => $this->faker->date(),
        ];
    }
}
