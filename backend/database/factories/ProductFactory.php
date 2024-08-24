<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product> */
final class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'producer_id' => Company::factory()->create()->getAttribute('id'),
        ];
    }

    public function producer($id): static
    {
        return $this->state(static fn (array $attributes) => [
            'producer_id' => $id,
        ]);
    }
}
