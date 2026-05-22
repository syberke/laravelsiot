@extends('layouts.app')

@section('title', 'Edit Device')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-warning bg-gradient py-3 border-0 rounded-top-4">
                    <h6 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-pencil-square me-2"></i>Update Data Device
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('device.update', $device->id) }}" method="POST">
                        @csrf 
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Serial Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-hash"></i></span>
                                <input type="number" name="serial_number" class="form-control bg-light border-0" value="{{ $device->serial_number }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Topic MQTT</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-broadcast"></i></span>
                                <input type="text" name="topic" class="form-control bg-light border-0" value="{{ $device->topic }}" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('device.index') }}" class="btn btn-light px-4 text-muted fw-medium rounded-pill">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning px-4 fw-bold rounded-pill shadow-sm">
                                Update Data <i class="bi bi-check2 me-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection