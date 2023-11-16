<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement(array_column(ProjectStatus::cases(), 'value')),
            'next_evaluation_date' => $this->faker->dateTime,
        ];
    }
}
