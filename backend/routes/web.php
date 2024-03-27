<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// TODO add auth
Route::get("/producer", [ProducerController::class, "index"]);

require __DIR__ . '/auth.php';