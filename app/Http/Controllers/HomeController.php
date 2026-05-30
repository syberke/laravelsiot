<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Sensor;
use App\Models\SensorLog;
use Illuminate\Routing\Controllers\HasMiddleware; // Tambahkan ini
use Illuminate\Routing\Controllers\Middleware;    // Tambahkan ini

class HomeController extends Controller implements HasMiddleware
{
    /**
     * Mengatur middleware menggunakan standard baru Laravel 11/12
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'), // Menggantikan $this->middleware('auth')
        ];
    }

    public function index()
    {
       
        $devices = Device::all();

        
        $totalDevices = Device::count();

       
        $totalSensors = Sensor::count();

      
        $latestLog = SensorLog::latest()->first();
        $lastUpdate = $latestLog ? $latestLog->created_at->timezone('Asia/Jakarta')->format('H:i:s') : '--:--:--';

      
        return view('home', compact('devices', 'totalDevices', 'totalSensors', 'lastUpdate'));
    }
}