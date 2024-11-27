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

    Route::get('/onu_types/listing', [SmartOltController::class, 'getOnuTypes']);

    Route::get('/onus/onu_details/{id}', [SmartOltController::class, 'getOnuDetails']);

    Route::get('/zones/listing', [SmartOltController::class, 'getZones']);

    Route::get('/odbs/listing', [SmartOltController::class, 'getOdbs']);

    Route::get('/olts/unconfigured_onus/{id}', [SmartOltController::class, 'getUnconfiguredOnusByOlt']);


});



