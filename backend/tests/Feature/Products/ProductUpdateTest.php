<?php

namespace Tests\Feature\products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_product_authorized(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            "name" => fake()->name(),
            "description" => fake()->paragraph()
        ];

        $response = $this->actingAs($user)->postJson("/api/product/{$product->id}", $data);

        $response->assertSuccessful();

        $this->assertDatabaseHas("products", ["id" => $product->id, ...$data]);
    }

    public function test_update_product_unauthorized(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // check if the user doesnt own the product
        $this->assertNotEquals($user->id, $product->get_author()->id);

        $data = [
            "name" => fake()->name(),
            "description" => fake()->paragraph()
        ];

        $response = $this->actingAs($user)->postJson("/api/product/{$product->id}", $data);

        $response->assertUnauthorized();
        $this->assertDatabaseMissing("products", ["id" => $product->id, ...$data]);
    }
}