<?php

namespace Tests\Feature\products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductsCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_create_product(): void
    {
        $user = User::factory()->create();
        $reqBody = [
            "name" => fake()->name(),
            "description" => fake()->paragraph(),
            "producer_id" => fake()->uuid()
        ];

        $response = $this->actingAs($user)->postJson('/api/product/create', $reqBody);

        $response->assertCreated();

        $this->assertDatabaseHas("products", $reqBody);
    }

    public function test_user_create_product_with_meta(): void
    {
        $user = User::factory()->create();
        $reqBody = [
            "name" => fake()->name(),
            "description" => fake()->paragraph(),
            "producer_id" => fake()->uuid(),
            "meta" => [
                [
                    "meta_key" => "price",
                    "meta_value" => "100$"
                ]
            ]
        ];

        $response = $this->actingAs($user)->postJson('/api/product/create', $reqBody);

        $response->assertSuccessful();
        
        $this->assertDatabaseHas("products", $reqBody);
        $this->assertDatabaseHas("product_meta", [$reqBody["meta"]]);
    }
}