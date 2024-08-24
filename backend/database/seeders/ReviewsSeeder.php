<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //TODO this can only create 1 review before fucking up
        Product::all()->each(function ($product) {
            $reviews = Reviews::factory()->count(1)->make();
            $product->reviews()->saveMany($reviews);
        });

        Company::all()->each(function ($company) {
            $reviews = Reviews::factory()->count(1)->make();
            $company->reviews()->saveMany($reviews);
        });
    }
}
