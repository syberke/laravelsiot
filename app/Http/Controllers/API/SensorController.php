<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Mengambil semua data sensor (GET /api/sensor)
     */
    public function index()
    {
        $sensor = Sensor::all();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil mendapatkan semua data sensor',
            'data' => $sensor
        ], 200);
    }

    /**
     * Mengambil detail satu data sensor berdasarkan ID (GET /api/sensor/{id})
     */
    public function show($id)
    {
        // Cari data berdasarkan ID, jika tidak ketemu langsung return error 404 otomatis
        $sensor = Sensor::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil mendapatkan data sensor dengan ID ' . $id,
            'data' => $sensor
        ], 200);
    }
}