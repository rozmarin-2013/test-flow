<?php

namespace Database\Factories;

use App\Enum\TaskStatus;
use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(5),
            'description' => fake()->text(),
            'status' =>  $this->faker->randomElement(TaskStatus::cases())->value
        ];
    }
}
