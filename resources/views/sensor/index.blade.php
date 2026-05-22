@extends('layouts.app')

@section('title', 'Manajemen Data Sensor')

@section('content')
<div class="container py-4">
    
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h3 class="mb-1 fw-bold text-dark">
                <i class="bi bi-cpu text-primary me-2"></i> Data Sensor
            </h3>
            <p class="text-muted mb-0">Pantau dan kelola pembacaan data sensor secara real-time.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <button class="btn btn-primary shadow-sm rounded-pill px-4 fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Sensor
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%" class="text-center py-3 text-muted">No</th>
                            <th class="py-3 text-muted">Nama Sensor</th>
                            <th class="py-3 text-muted">Nilai Data</th>
                            <th class="py-3 text-center text-muted">Status</th>
                            <th width="15%" class="text-center py-3 text-muted">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sensors as $index => $sensor)
                        <tr>
                            <td class="text-center text-secondary">{{ $index + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $sensor->nama_sensor }}</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3 py-2 fs-6">
                                    {{ $sensor->data }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($sensor->status == 1)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-1">
                                        <i class="bi bi-circle-fill small me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-1">
                                        <i class="bi bi-dash-circle small me-1"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-light btn-sm text-warning border-warning border-opacity-25" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $sensor->id }}" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="if(confirm('Yakin ingin menghapus sensor ini?')) this.form.submit();" class="btn btn-light btn-sm text-danger border-danger border-opacity-25" title="Hapus">
                                            <i class="bi bi-trash3"></i> hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-1 fs-5 fw-medium">Belum ada data sensor.</p>
                                    <small>Klik tombol "Tambah Sensor" untuk memulai.</small>
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

{{-- MODAL TAMBAH SENSOR --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('sensor.store') }}" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title fw-bold text-dark">Tambah Data Sensor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Nama Sensor</label>
                    <input type="text" name="nama_sensor" class="form-control form-control-lg fs-6 bg-light border-0" placeholder="Contoh: Sensor Suhu DHT11" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Nilai Data</label>
                    <input type="number" step="any" name="data" class="form-control form-control-lg fs-6 bg-light border-0" placeholder="Contoh: 28.5" required>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-medium text-secondary">Status Sensor</label>
                    <select name="status" class="form-select form-select-lg fs-6 bg-light border-0" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4 fw-medium">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT SENSOR --}}
@foreach($sensors as $sensor)
<div class="modal fade" id="modalEdit{{ $sensor->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('sensor.update', $sensor->id) }}" class="modal-content border-0 shadow">
            @csrf
            @method('PUT')
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title fw-bold text-dark">Edit Data Sensor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Nama Sensor</label>
                    <input type="text" name="nama_sensor" class="form-control form-control-lg fs-6 bg-light border-0" value="{{ $sensor->nama_sensor }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Nilai Data</label>
                    <input type="number" step="any" name="data" class="form-control form-control-lg fs-6 bg-light border-0" value="{{ $sensor->data }}" required>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-medium text-secondary">Status Sensor</label>
                    <select name="status" class="form-select form-select-lg fs-6 bg-light border-0" required>
                        <option value="1" {{ $sensor->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $sensor->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning px-4 fw-medium">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection