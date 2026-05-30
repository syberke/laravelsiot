@extends('layouts.app')

@section('title', 'Manajemen Device')

@section('content')
<div class="container py-3 py-lg-4">

    <div class="row mb-4 align-items-center">
        <div class="col-12 mb-3 mb-md-0">
            <h3 class="mb-1 fw-bold text-dark">
                <i class="bi bi-router text-primary me-2"></i> Manajemen Device
            </h3>
            <p class="text-muted mb-0">Kelola perangkat keras (hardware) dan topik MQTT yang terhubung ke sistem.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white py-3 border-0 rounded-top-4">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-plus-circle me-1"></i> Tambah Device Baru</h6>
                </div>
                <div class="card-body p-3 p-md-4">
                    <form action="{{ route('device.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 mb-md-4">
                            <label class="form-label fw-medium text-secondary">Serial Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-hash"></i></span>
                                <input type="number" name="serial_number" class="form-control bg-light border-0 @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}" placeholder="Contoh: 102938">
                                @error('serial_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 mb-md-4">
                            <label class="form-label fw-medium text-secondary">Topic MQTT</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-broadcast"></i></span>
                                <input type="text" name="topic" class="form-control bg-light border-0 @error('topic') is-invalid @enderror" value="{{ old('topic') }}" placeholder="Contoh: home/livingroom/temp">
                                @error('topic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-medium shadow-sm">Simpan Device</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-7 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white py-2 py-md-3 border-bottom-0">
                    <h6 class="mb-0 fw-bold text-dark">Daftar Perangkat Terdaftar</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3 ps-md-4 py-2 py-md-3 text-muted">Serial Number</th>
                                    <th class="py-2 py-md-3 text-muted">Topic MQTT</th>
                                    <th class="py-2 py-md-3 text-muted d-none d-md-table-cell">Time</th>
                                    <th class="text-center py-2 py-md-3 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($devices as $dev)
                                <tr>
                                    <td class="ps-3 ps-md-4 fw-semibold text-dark">{{ $dev->serial_number }}</td>
                                    <td>
                                        <span class="badge bg-dark bg-opacity-10 text-dark border border-secondary border-opacity-25 rounded-pill px-2 px-md-3 py-1 py-md-2 fw-normal font-monospace small">
                                            {{ $dev->topic }}
                                        </span>
                                    </td>
                                    <td class="text-muted d-none d-md-table-cell">
                                        {{ $dev->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center flex-wrap gap-1">
                                            <a href="{{ route('device.edit', $dev->id) }}" class="btn btn-light btn-sm text-warning border-warning border-opacity-25" title="Edit">
                                                <i class="bi bi-pencil-square"></i><span class="d-none d-sm-inline">edit</span>
                                            </a>
                                            <form action="{{ route('device.destroy', $dev->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus device ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-light btn-sm text-danger border-danger border-opacity-25" title="Hapus">
                                                    <i class="bi bi-trash3"></i><span class="d-none d-sm-inline">hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 py-md-5">
                                        <div class="text-muted">
                                            <i class="bi bi-hdd-network fs-1 d-block mb-2"></i>
                                            <p class="mb-1 fs-5 fw-medium">Belum ada device.</p>
                                            <small>Tambahkan device melalui form di atas.</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection