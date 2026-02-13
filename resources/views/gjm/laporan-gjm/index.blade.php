@extends('layouts.app')

@section('page-title', 'Laporan GJM Fakultas')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted">Ketua Fakultas dapat mengakses rankuman laporan hasil monitoring GKM satu fakultas.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Laporan Bulanan Fakultas - Februari 2026</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Kepatuhan upload materi:</strong> 83%
                    </div>
                    <div class="mb-3">
                        <strong>Rata-rata nilai evaluasi dosen:</strong> 3.5
                    </div>
                    <div class="mb-3">
                        <strong>Prodi Bermasalah:</strong> 1
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm">
                            <i class="bi bi-file-earmark-pdf"></i> Generate Laporan Bulanan
                        </button>
                        <button class="btn btn-info btn-sm">Export PDF</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Laporan Tahunan Fakultas - 2025</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Rata-rata Kepatuhan:</strong> 85%
                    </div>
                    <div class="mb-3">
                        <strong>Rata-rata Evaluasi Dosen:</strong> 3.6
                    </div>
                    <div class="mb-3">
                        <strong>Total Temuan:</strong> 8
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning btn-sm">
                            <i class="bi bi-file-earmark-pdf"></i> Generate Laporan Tahunan
                        </button>
                        <button class="btn btn-info btn-sm">Export PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Arsip Laporan Fakultas</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#bulanan" data-bs-toggle="tab">Laporan Bulanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tahunan" data-bs-toggle="tab">Laporan Tahunan</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="bulanan">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Periode</th>
                                            <th>Unduh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Laporan_Kuisioner_Januari_2026</td>
                                            <td>Januari 2026</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Unduh PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Laporan_Kuisioner_Desember_2025</td>
                                            <td>Desember 2025</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Unduh PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Laporan_Kuisioner_November_2025</td>
                                            <td>November 2025</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Unduh PDF</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tahunan">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Periode</th>
                                            <th>Unduh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Laporan_Tahunan_2025</td>
                                            <td>Tahun 2025</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Unduh PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Laporan_Tahunan_2024</td>
                                            <td>Tahun 2024</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Unduh PDF</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
