<?php

use App\Http\Controllers\SmartOltController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// https://api.thomas-talk.me/olt/get_olts

Route::middleware(ApiKeyMiddleware::class)->group(function(){

    Route::get('/olts/listing', [SmartOltController::class, 'getOlts']);

    Route::get('/speed_profiles/listing', [SmartOltController::class, 'getSpeedProfiles']);


});



