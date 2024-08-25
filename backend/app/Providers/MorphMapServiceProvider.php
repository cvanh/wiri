<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphMapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'product' => Product::class,
            'reviews' => Reviews::class,
            'company' => Company::class,
            'user' => User::class,
        ]);
    }
}
