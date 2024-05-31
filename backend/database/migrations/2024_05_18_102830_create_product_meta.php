<?php

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_meta', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("product_id")->constrained();
            $table->string("meta_key");
            $table->string("meta_value");
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table("product_meta", function ($table) {
            $table->foreign("product_id")->references("id")->on("products");
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_meta');
    }
};