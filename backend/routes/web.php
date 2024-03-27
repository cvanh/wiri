<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get("/producer", ProducerController::class)->middleware("auth");

require __DIR__ . '/auth.php';