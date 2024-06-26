<?php declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ProductGetTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->hasProductMeta(3)->count(5)->create();

        $response = $this->actingAs($user)->get('/api/product');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'description',
                'producer_id',
            ],
        ]);
    }

    public function test_get_single_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(3)->create();

        $response = $this->actingAs($user)->get("/api/product/{$product->getAttribute('id')}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $product->id]);
        $response->assertJsonStructure([
            'id',
            'description',
            'producer_id',
            'product_meta' => [
                '*' => [
                    'id',
                    'meta_key',
                    'meta_value',
                ],
            ],
        ]);
    }
}
