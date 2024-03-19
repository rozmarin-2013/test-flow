<?php

namespace Database\Factories;

use App\Enum\TaskStatus;
use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::random(5),
            'price' => $this->faker->randomFloat(2, 10, 100 )
        ];
    }
}
