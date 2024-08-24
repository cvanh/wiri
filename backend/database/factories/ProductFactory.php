<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product> */
final class ProductFactory extends Factory
{
    protected static $strains = [
        'Black Diesel',
        'Blue Bayou',
        'Blue Satellite',
        'Brainstorm Haze',
        'Candy Jack',
        'Cannalope Haze',
        'Cat Piss',
        'Charlotte\'s Web',
        'Chocolope',
        'Cracker Jack',
        'Crystal Coma',
        'Django',
        'Double Diesel',
        'Dr. Grinspoon',
        'Durban Poison',
        'Dutch Dragon',
        'Dutch Hawaiian',
        'East Coast Sour Diesel',
        'Fire Haze',
    ];
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->randomElement(static::$strains),
            'description' => fake()->paragraph(),
            'producer_id' => Company::factory()->create()->getAttribute('id'),
        ];
    }

    public function producer($id): static
    {
        return $this->state(static fn(array $attributes) => [
            'producer_id' => $id,
        ]);
    }
}
