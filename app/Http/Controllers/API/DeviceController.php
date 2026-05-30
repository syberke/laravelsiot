<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Mengambil semua data device (GET /api/device)
     */
    public function index()
    {
        $devices = Device::all();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil mendapatkan semua data perangkat (device)',
            'data' => $devices
        ], 200);
    }

    /**
     * Mengambil detail satu data device berdasarkan ID (GET /api/device/{id})
     */
    public function show($id)
    {
        $device = Device::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil mendapatkan data device dengan ID ' . $id,
            'data' => $device
        ], 200);
    }
}