<?php

use App\Http\Controllers\API\SensorController;
use App\Http\Controllers\API\DeviceController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;



Route::post('/webhook', [WebhookController::class, 'handle']);

Route::get('/sensor', [SensorController::class, 'index']);
Route::get('/sensor/{id}', [SensorController::class, 'show']);


Route::get('/device', [DeviceController::class, 'index']);
Route::get('/device/{id}', [DeviceController::class, 'show']);