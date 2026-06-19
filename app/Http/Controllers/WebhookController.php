<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorLog;
use App\Models\Sensor;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {

        $topic = $request->input('topic');     
        $payload = $request->input('payload'); 

      
        Log::info("Webhook Shiftr.io Masuk -> Topik: {$topic} | Nilai: {$payload}");


        $parts = explode('/', $topic);


        if (count($parts) >= 3 && $parts[0] == 'iot') {
            $tipeSensor = $parts[2]; 
            
           
            $targetSerialNumber = 123456; 

            $latestLog = SensorLog::latest()->first();

          
            if ($latestLog && $latestLog->created_at->diffInSeconds(now()) < 5) {
                if ($tipeSensor == 'suhu') {
                    $latestLog->update(['temperature' => floatval($payload)]);
                } elseif ($tipeSensor == 'kelembapan') {
                    $latestLog->update(['humidity' => floatval($payload)]);
                }
            } else {

                SensorLog::create([
                    'serial_number' => $targetSerialNumber, 
                    'temperature'   => $tipeSensor == 'suhu' ? floatval($payload) : 0,
                    'humidity'      => $tipeSensor == 'kelembapan' ? floatval($payload) : 0,
                ]);
            }

            if ($tipeSensor == 'suhu') {
                $sensorData = Sensor::where('nama_sensor', 'LIKE', '%Suhu%')->first();
                if ($sensorData) {
                    $sensorData->update(['data' => floatval($payload)]);
                }
            } elseif ($tipeSensor == 'kelembapan') {
                $sensorData = Sensor::where('nama_sensor', 'LIKE', '%Kelembapan%')->first();
                if ($sensorData) {
                    $sensorData->update(['data' => floatval($payload)]);
                }
            }

            return response()->json([
                'status' => 'success', 
                'message' => 'Webhook Shiftr.io sukses masuk database SQLite!'
            ], 200);
        }

        return response()->json([
            'status' => 'ignored', 
            'message' => 'Topik diabaikan oleh filter.'
        ], 200);
    }
}