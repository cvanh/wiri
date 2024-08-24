<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company> */
final class CompanyFactory extends Factory
{
    protected $model = Company::class;

    protected static $companies = [
        "THRIVE Cannabis Marketplace Downtown",
        "The Apothecarium",
        "Medizin",
        "New Amsterdam Naturals Las Vegas",
        "Reef Dispensaries - Las Vegas Strip,",
        "Reef Dispensaries - Las Vegas North",
        "THRIVE Cannabis Marketplace",
        "TheDispensaryNV - West Las Vegas",
        "TheDispensaryNV - Henderson",
        "The Clinic",
        "Pisos - The Strip",
        "BLUM Las Vegas - Decatur",
        "Kanna Reno",
        "RISE Carson City",
        "JardÃn Premium Cannabis Dispensary",
        "Top Notch THC",
        "Shango Las Vegas",
    ];

    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'type' => fake()->randomElement(['producer', 'store']),
            'author_id' => User::factory()->create()->getAttribute('id'),
            'name' => fake()->randomElement(static::$companies),
            'about' => fake()->paragraph(),
            'latitude' => fake()->latitude(51, 53),
            'longitude' => fake()->longitude(4, 7),
        ];
    }
}
