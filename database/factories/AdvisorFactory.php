<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advisor>
 */
class AdvisorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fields = ['Image Processing', 'Machine Learning', 'Web Development', 'Android Development', 'Artificial Intelligence'];
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'field_of_interests' => fake()->randomElements($fields, fake()->numberBetween(1, 3)),
            'room_no' => fake()->randomDigit() . fake()->randomLetter(),
            'extra_info' => '{}',
        ];
    }
}
