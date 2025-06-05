<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trainer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\trainer>
 */
class TrainerFactory extends Factory
{
    protected $model = Trainer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'      => fake()->firstName(),
            'last_name'       => fake()->lastName(),
            'email'           => fake()->unique()->safeEmail(),
            'phone'           => fake()->phoneNumber(),
            'gender'          => fake()->randomElement(['male', 'female', 'other']),
            'date_of_birth'   => fake()->date('Y-m-d', '-20 years'), // ensures adult
            'address'         => fake()->address(),
            'specialization'  => fake()->randomElement(['Yoga', 'Strength Training', 'Cardio', 'Zumba']),
            'profile_photo'   => fake()->imageUrl(200, 200, 'people'), // use faker image url
            'status'          => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
