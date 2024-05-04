<?php

namespace Database\Factories;

use App\Models\Producer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producer>
 */
class ProducerFactory extends Factory
{
    protected $model = Producer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'type' => fake()->randomElement(["producer", "store"]),
            'author_id' => User::factory()->create()->getAttribute("id"),
            'name' => fake()->name(),
            'about' => fake()->paragraph()
        ];
    }
}