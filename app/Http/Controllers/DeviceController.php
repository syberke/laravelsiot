<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('device.index', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|numeric',
            'topic' => 'required'
        ]);

        Device::create($request->all());

        return redirect()->back()->with('success', 'Data device berhasil ditambahkan');
    }



    public function edit($id)
    {
    
        $device = Device::findOrFail($id);
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'serial_number' => 'required|numeric',
            'topic' => 'required'
        ]);

        $device = Device::findOrFail($id);
        $device->update($request->all());

        return redirect()->route('device.index')->with('success', 'Data device berhasil diperbarui');
    }



    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->back()->with('success', 'Data device berhasil dihapus');
    }
}