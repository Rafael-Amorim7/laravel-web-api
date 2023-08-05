<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\EpisodesController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/series', SeriesController::class);
    Route::get('/series/{series}/episodes', [SeriesController::class, 'episodes']);

    Route::post('/upload', [ImageUploadController::class, 'upload']);

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index']);

    Route::patch('/episodes/{episode}', [EpisodesController::class, 'watched']);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (Auth::attempt($credentials) === false) {
        return response()->json('Unauthorized', 401);
    }

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['is_admin']);

    return response()->json($token->plainTextToken);
});
