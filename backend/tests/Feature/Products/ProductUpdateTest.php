<?php declare(strict_types=1);

namespace Tests\Feature\products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_product_authorized(): void
    {
        $product = Product::factory()->create();
        $user = $product->get_author();

        $data = [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
        ];

        $response = $this->actingAs($user)->postJson("/api/product/{$product->id}", $data);

        $response->assertSuccessful();

        $this->assertDatabaseHas('products', ['id' => $product->id, ...$data]);
    }

    public function test_update_product_unauthorized(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
        ];

        $response = $this->actingAs($user)->postJson("/api/product/{$product->id}", $data);

        $response->assertForbidden();
        $this->assertDatabaseMissing('products', ['id' => $product->id, ...$data]);
    }

    public function test_update_product_meta(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasproductMeta(3)->create();

        // $data = [
        //     "name" => fake()->name(),
        //     "description" => fake()->paragraph(),
        //     "meta" => [[
        //         "meta_key" => "",
        //         "meta_value" => ""
        //     ]]
        // ];
        $data = $product->toArray();

        $response = $this->actingAs($user)->postJson("/api/product/{$product->id}", $data);

        $response->assertSuccessful();
    }
}