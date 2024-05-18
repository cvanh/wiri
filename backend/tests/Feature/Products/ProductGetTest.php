<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductGetTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->count(5)->create();

        $response = $this->actingAs($user)->get('/api/product');

        $response->assertStatus(200);

        $response->assertJsonCount(5);
    }

    public function test_get_single_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get("/api/product/{$product->getAttribute('id')}");

        $response->assertStatus(200);

        $response->assertJsonFragment(["id" => $product->getAttribute("id")]);

        $response->assertJsonIsArray("meta");
    }
}