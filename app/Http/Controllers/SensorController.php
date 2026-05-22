<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::all();
        return view('sensor.index', compact('sensors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required',
            'data' => 'required|numeric',
            'status' => 'required|integer' 
        ]);

        Sensor::create($request->all());

        return redirect()->back()->with('success', 'Data sensor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nama_sensor' => 'required',
            'data' => 'required|numeric',
            'status' => 'required|integer'
        ]);

        $sensor = Sensor::findOrFail($id);
        $sensor->update($request->all());

        return redirect()->route('sensor.index')->with('success', 'Data sensor berhasil diperbarui');
    }

    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->delete();

        return redirect()->back()->with('success', 'Data sensor berhasil dihapus');
    }
}