@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-5 mb-4 bg-white border rounded-3 shadow-sm text-center">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang!</h1>
        <p class="col-md-8 fs-4 mx-auto text-muted">Aplikasi manajemen perangkat (Device) dan pembacaan sensor secara real-time.</p>
        <hr class="my-4">
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="{{ route('device.index') }}" class="btn btn-primary btn-lg px-4 gap-3">Kelola Device</a>
            <a href="{{ route('sensor.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cek Sensor</a>
        </div>
    </div>
</div>
@endsection