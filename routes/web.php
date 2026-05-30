<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitleContoller;
use App\Http\Controllers\RouteContoller;
use App\Http\Controllers\QueryContoller;
use App\Http\Controllers\PostContoller;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('sensor', SensorController::class);
    Route::resource('device', DeviceController::class);
});