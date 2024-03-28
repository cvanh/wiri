<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get("/producer", [ProducerController::class, "index"])->middleware("auth");
Route::get("/producer/{id}", [ProducerController::class, "show"])->middleware("auth");
Route::post("/producer/create", [ProducerController::class, "store"])->middleware("auth");


require __DIR__ . '/auth.php';