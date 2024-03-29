<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get("/producer", [ProducerController::class, "index"])->middleware("auth");
    Route::get("/producer/{id}", [ProducerController::class, "show"])->middleware("auth");
    Route::post("/producer/create", [ProducerController::class, "store"])->middleware("auth");
});