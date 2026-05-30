<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IoT Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 1rem 0;
        }
        .card {
            border: none;
            border-radius: 1rem;
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 0.6rem;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .form-control {
            padding: 0.6rem 0.75rem 0.6rem 2.5rem;
            border-radius: 0.5rem;
        }
        .input-group-custom {
            position: relative;
        }
        .input-group-custom i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 10;
        }
        @media (max-width: 576px) {
            body { padding: 0.5rem 0; }
            .text-center h2 { font-size: 1.5rem; }
            .card { border-radius: 0.75rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5 col-xl-4">

                <div class="text-center mb-4 text-white">
                    <h2 class="fw-bold m-0"><i class="bi bi-cpu text-primary"></i> IOT MANAGER</h2>
                    <p class="text-muted small mt-1">Sistem Otomasi dan Monitoring Terintegrasi</p>
                </div>

                <div class="card shadow-lg p-3 p-md-4">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-1">Selamat Datang</h4>
                        <p class="text-muted small mb-4">Silakan masuk menggunakan akun terdaftar Anda.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 small shadow-sm mb-4" style="border-radius: 0.5rem;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary small fw-semibold">Alamat Email</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-envelope"></i>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label text-secondary small fw-semibold">Kata Sandi</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-lock"></i>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                Masuk Aplikasi <i class="bi bi-box-arrow-in-right ms-1"></i>
                            </button>
                        </form>
                    </div>

                    <div class="card-footer bg-transparent border-0 text-center pb-3">
                        <span class="text-muted small">Belum punya akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Daftar sekarang</a></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>