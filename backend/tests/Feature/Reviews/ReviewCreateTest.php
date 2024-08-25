<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * ReviewCreateTest
 * @group Reviews
 */
class ReviewCreateTest extends TestCase
{
    use RefreshDatabase;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function test_create_product_review(): void
    {
        $product = Product::factory()->create();

        $data = [
            'content' => 'content',
            'rating' => random_int(0, 100),
        ];

        $response = $this->actingAs($this->user)->postJson("/api/product/{$product->id}/comment/create", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('reviews', $data);
    }

    /** @test */
    public function test_create_company_review(): void
    {
        $company = Company::factory()->create();

        $data = [
            'content' => 'content',
            'rating' => random_int(0, 100),
        ];

        $response = $this->actingAs($this->user)->postJson("/api/company/{$company->id}/comment/create", $data);
        $response->assertCreated();
        $this->assertDatabaseHas('reviews', $data);
    }
    /**@test */
    public function test_unauthorized_create_review(): void
    {
        $company = Company::factory()->create();

        $data = [
            'content' => 'contentt',
            'rating' => 50,
        ];

        $response = $this->postJson("/api/company/{$company->id}/comment/create", $data);

        $response->assertUnauthorized();
    }
}
