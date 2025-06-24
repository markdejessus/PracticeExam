<?php

use App\Http\Controllers\Api\PositionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('positions', PositionController::class);

Route::get('/positions/{position}/subordinates', [PositionController::class, 'subordinates']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
