<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;  

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
    Route::delete("/product/{id}", [ProductController::class, "destroy"])->middleware("auth");
});


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});