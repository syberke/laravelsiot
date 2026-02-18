<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4 mb-4">
    <span class="navbar-brand fw-bold">Sensor Monitoring</span>
    <a href="#" class="nav-link text-white">Home</a>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Sensor</h3>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Sensor
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-primary">
            <tr>
                <th>Nama Sensor</th>
                <th>Data</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sensors as $sensor)
            <tr>
                <td>{{ $sensor->nama_sensor }}</td>
                <td>{{ $sensor->data }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $sensor->id }}">
                        Edit
                    </button>

                    <form action="/sensor/{{ $sensor->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form method="POST" action="/sensor" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Sensor</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input name="nama_sensor" class="form-control mb-3" placeholder="Nama Sensor" required>
                <input name="data" type="number" class="form-control" placeholder="Data Sensor" required>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($sensors as $sensor)
<div class="modal fade" id="modalEdit{{ $sensor->id }}">
    <div class="modal-dialog">
        <form method="POST" action="/sensor/{{ $sensor->id }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Sensor</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input name="nama_sensor" class="form-control mb-3" value="{{ $sensor->nama_sensor }}" required>
                <input name="data" type="number" class="form-control" value="{{ $sensor->data }}" required>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
