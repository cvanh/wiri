<?php

declare(strict_types=1);

use App\Http\Controllers\AppController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', static function (Request $request) {
    return $request->user();
});

// TODO refactor into seprate routes
Route::middleware('auth:sanctum')->name('api.')->group(static function () {
    Route::get('/company', [ProducerController::class, 'index'])->middleware('auth');
    Route::get('/company/{id}', [ProducerController::class, 'show'])->middleware('auth');
    Route::post('/company/create', [ProducerController::class, 'store'])->middleware('auth');

    Route::get('/product', [ProductController::class, 'index'])->middleware('auth');
    Route::get('/product/{id}', [ProductController::class, 'show'])->middleware('auth');
    Route::post('/product/create', [ProductController::class, 'store'])->middleware('auth');
    Route::post('/product/{id}', [ProductController::class, 'update'])->middleware('auth');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->middleware('auth');

    Route::get('/app/search/', [AppController::class, 'search'])->middleware('auth');

    Route::controller(CommentController::class)->group(function () {
        Route::get('/{model}/{id}/comment', 'index')->whereIn('model', ['product', 'company']);
        Route::post('/{model}/{model_id}/comment/create', 'store')->whereIn('model', ['product', 'company']);
        Route::patch('/{model)/comment/{id)',  'update')->whereIn('model', ['product', 'company']);
        Route::delete('/{model}/comment/{id}',  'destroy')->whereIn('model', ['product', 'company']);
    })->middleware("auth");
});
