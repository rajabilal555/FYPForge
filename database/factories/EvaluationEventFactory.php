<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advisor>
 */
class EvaluationEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
         'name',
        'start_datetime',
        'per_project_duration',
        'total_marks',
        'is_final_evaluation',
        'shuffle_evaluation_panels',
        'active',
        'result_generated',
        */
        return [
            'name' => fake()->name(),
            'start_datetime' => fake()->dateTimeBetween('-1 year', '+5 day'),
            'per_project_duration' => fake()->numberBetween(1, 5),
            'total_marks' => fake()->numberBetween(50, 100),
            'is_final_evaluation' => fake()->boolean(),
            'shuffle_evaluation_panels' => fake()->boolean(),
            'active' => fake()->boolean(),
            'result_generated' => fake()->boolean(),
        ];
    }
}
