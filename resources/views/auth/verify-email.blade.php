@extends('layouts.app')

@section('title', 'Verifikasi Email Anda')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm mt-3 mt-md-5" style="border-radius: 0.75rem;">
            <div class="card-body p-3 p-md-5 text-center">
                <div class="text-primary mb-4">
                    <i class="bi bi-envelope-check-fill" style="font-size: 3rem;"></i>
                </div>
                <h3 class="fw-bold mb-3">Verifikasi Email Anda</h3>
                <p class="text-muted mb-4">
                    Terima kasih telah mendaftar! Sebelum melanjutkan, silakan periksa email Anda untuk mengklik tautan verifikasi yang baru saja kami kirimkan.
                </p>

                <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 w-md-auto fw-semibold py-2 px-4">
                        <i class="bi bi-arrow-clockwise"></i> Kirim Ulang Link Verifikasi
                    </button>
                </form>

                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link text-secondary text-decoration-none btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Keluar Aplikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection