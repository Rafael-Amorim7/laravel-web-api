<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Auth\AuthenticatedTokenAPIController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/series', SeriesController::class);
    Route::get('/series/{series}/episodes', [SeriesController::class, 'episodes']);

    Route::post('/upload', [ImageUploadController::class, 'upload']);

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index']);

    Route::patch('/episodes/{episode}', [EpisodesController::class, 'watched']);
});

Route::post('/login', [AuthenticatedTokenAPIController::class, 'login']);
