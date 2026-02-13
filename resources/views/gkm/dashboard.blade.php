@extends('layouts.app')

@section('title', 'Dashboard GKM')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="mb-4">
        <h3>Selamat Datang, {{ $user->nama_user }} 👋</h3>
        <p class="text-muted mb-0">Periode: {{ $periode }}</p>
    </div>

    <!-- Status Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-secondary mb-3">Status Upload Materi</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1">
                                <span class="badge bg-success">✓</span>
                                <span>Sudah Upload: {{ $stats['materi_uploaded'] }} Dosen</span>
                            </p>
                            <p class="mb-0">
                                <span class="badge bg-danger">✕</span>
                                <span>Belum Upload: {{ $stats['materi_belum'] }} Dosen</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-secondary mb-3">Status RPS</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1">
                                <span class="badge bg-success">✓</span>
                                <span>Lengkap: {{ $stats['rps_lengkap'] }} Mata Kuliah</span>
                            </p>
                            <p class="mb-0">
                                <span class="badge bg-danger">✕</span>
                                <span>Belum Lengkap: {{ $stats['rps_belum'] }} Mata Kuliah</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-secondary mb-3">Reminder Terkikim</h6>
                    <p class="mb-0 h5">
                        {{ $stats['reminders_pending'] }} dari 4 Reminder
                    </p>
                    <div class="mt-2">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-secondary mb-3">Status Kuisioner</h6>
                    <p class="mb-0">
                        <i class="bi bi-star-fill text-warning"></i>
                        Sedang Berjalan
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('gkm.pelaporan.index') }}" class="btn btn-primary w-100">
                <i class="bi bi-file-earmark-pdf"></i> Generate Laporan Bulanan
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('gkm.reminder-agent.jadwal') }}" class="btn btn-success w-100">
                <i class="bi bi-check-circle"></i> Kirim Reminder Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
