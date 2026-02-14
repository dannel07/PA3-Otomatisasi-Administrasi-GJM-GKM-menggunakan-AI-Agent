@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h4 class="fw-semibold mb-1">
                            Selamat Datang, {{ auth()->user()->name }}
                        </h4>
                        <p class="text-muted mb-0">
                            Periode: {{ now()->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="row g-4">

            {{-- Status Upload Materi --}}
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Status Upload Materi</h6>

                        <div class="mb-2">
                            <span class="badge bg-success">
                                Sudah Upload: 12 Dosen
                            </span>
                        </div>

                        <div>
                            <span class="badge bg-danger">
                                Belum Upload: 6 Dosen
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status RPS --}}
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Status RPS</h6>

                        <div class="mb-2">
                            <span class="badge bg-success">
                                Lengkap: 15 Mata Kuliah
                            </span>
                        </div>

                        <div>
                            <span class="badge bg-danger">
                                Belum Lengkap: 3 Mata Kuliah
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reminder --}}
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Status Reminder</h6>

                        <h3 class="fw-bold mb-1">2 dari 4</h3>
                        <small class="text-muted">Reminder masih pending</small>
                    </div>
                </div>
            </div>

            {{-- Status Kuisioner --}}
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Status Kuisioner</h6>

                        <span class="badge bg-warning text-dark">
                            Sedang Berjalan
                        </span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Action Button --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body d-flex flex-wrap gap-2">
                        <a href="{{ route('gkm.pelaporan.index') }}" class="btn btn-primary">
                            <i class="bi bi-file-text"></i>
                            Generate Laporan Bulanan
                        </a>

                        <button class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Kirim Reminder Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
