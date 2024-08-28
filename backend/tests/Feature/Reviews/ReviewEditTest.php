<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * ReviewEditTest
 * @group Reviews 
 */
class ReviewEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    /** @test */
    public function test_edit_product_review()
    {
        // create review owned by testing user and get the id of this review
        $product = Product::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $product->reviews->first();

        $edited_review = ['content' => fake()->paragraph()];

        $response = $this->actingAs($this->user)->patch("/api/product/comment/{$review->id}", $edited_review);
        $response->dump();

        $response->assertAccepted();
        $this->assertDatabaseHas('reviews',["id"=>$review->id, 'content'=> $edited_review['content']]);
    }

    /** @test */
    public function test_edit_company_review()
    {
        // create review owned by testing user and get the id of this review
        $company = Company::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $company->reviews->first();

        $edited_review = ['content' => 'editedcontent'];

        $response = $this->actingAs($this->user)->patch("/api/company/comment/{$review->id}", $edited_review);

        $response->assertAccepted();
    }

    /** @test */
    public function test_edit_company_review_unauthorized()
    {
        // create review owned by testing user and get the id of this review
        // $company = Company::factory()->hasReviews(1)->create();
        $company = Company::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $company->reviews->first();
        $review = $company->reviews->first();

        $edited_review = ['content' => 'editedcontent'];

        $response = $this->actingAs($this->user)->patch("/api/company/comment/{$review->id}", $edited_review);

        $response->assertUnauthorized();
    }


    /** @test */
    public function test_edit_company_review_grading()
    {
        // create review owned by testing user and get the id of this review
        // $company = Company::factory()->hasReviews(1)->create();
        $company = Company::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $company->reviews->first();

        $edited_review = ['content' => 'editedcontent','rating'=> fake()->numberBetween(0,100)];

        $response = $this->actingAs($this->user)->patch("/api/company/comment/{$review->id}", $edited_review);

        $response->assertAccepted();
    }

    /** @test */
    public function test_edit_company_review_unmodified()
    {
        // create review owned by testing user and get the id of this review
        // $company = Company::factory()->hasReviews(1)->create();
        $company = Company::factory()->hasReviews(1, ['author_id' => $this->user->id])->create();
        $review = $company->reviews->first();

        $edited_review = ['content' => $review->content];

        $response = $this->actingAs($this->user)->patch("/api/company/comment/{$review->id}", $edited_review);

        $response->assertNotModified();
    }
}
