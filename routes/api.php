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

    Route::get('/olts/temperature_and_uptime', [SmartOltController::class, 'getTemperatureAndUptime']);

    Route::get('/speed_profiles/listing', [SmartOltController::class, 'getSpeedProfiles']);

    Route::get('/onu_types/listing', [SmartOltController::class, 'getOnuTypes']);

    Route::get('/onus/onu_details/{id}', [SmartOltController::class, 'getOnuDetails']);

    Route::get('/onus/unconfigured_onus', [SmartOltController::class, 'getUnconfiguredOnus']);

    Route::get('/onus/unconfigured_onus_for_olt/{id}', [SmartOltController::class, 'getUnconfiguredOnusByOlt']);

    Route::get('/zones/listing', [SmartOltController::class, 'getZones']);

    Route::get('/odbs/listing', [SmartOltController::class, 'getOdbs']);

});



