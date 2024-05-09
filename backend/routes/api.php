<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// TODO refactor into seprate routes
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get("/producer", [ProducerController::class, "index"])->middleware("auth");
    Route::get("/producer/{id}", [ProducerController::class, "show"])->middleware("auth");
    Route::post("/producer/create", [ProducerController::class, "store"])->middleware("auth");

    Route::get("/product", [ProductController::class, "index"])->middleware("auth");
    Route::get("/product/{id}", [ProductController::class, "show"])->middleware("auth");
    Route::post("/product/create", [ProductController::class, "store"])->middleware("auth");
    Route::post("/product/{id}", [ProductController::class, "update"])->middleware("auth");
    Route::delete("/product/{id}", [ProductController::class, "destroy"])->middleware("auth");
});