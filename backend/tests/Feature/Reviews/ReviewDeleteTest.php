<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * ReviewDeleteTest
 * @group Reviews 
 */
class ReviewDeleteTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /** @test */
    public function test_delete_product_review()
    {
        // create review owned by testing user and get the id of this review
        $product = Product::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $product->reviews->first();


        $response = $this->actingAs($this->user)->delete("/api/product/comment/{$review->id}");

        $response->assertAccepted();
    }

    /** @test */
    public function test_delete_company_review()
    {
        // create review owned by testing user and get the id of this review
        $company = Company::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $company->reviews->first();


        $response = $this->actingAs($this->user)->delete("/api/company/comment/{$review->id}");

        $response->assertAccepted();
    }
}
