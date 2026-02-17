@extends('layouts.app')

@section('page-title', 'Reminder Agent')

@section('content')
<div style="padding: 1.5rem;">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check" style="font-size: 40px; color: #1e3c72;"></i>
                    <h6 class="mt-3 mb-2">Pengaturan Jadwal Reminder</h6>
                    <p class="text-muted small mb-3">Atur jadwal pengiriman email reminder otomatis ke dosen</p>
                    <a href="{{ route('gkm.reminder-agent.jadwal') }}" class="btn btn-primary btn-sm">Atur Jadwal</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-envelope-open" style="font-size: 40px; color: #28a745;"></i>
                    <h6 class="mt-3 mb-2">Log Pengiriman Email</h6>
                    <p class="text-muted small mb-3">Lihat riwayat pengiriman email reminder</p>
                    <a href="{{ route('gkm.reminder-agent.log') }}" class="btn btn-success btn-sm">Lihat Log</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Daftar Jadwal Reminder</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tipe Reminder</th>
                                    <th>Jadwal Pengiriman</th>
                                    <th>Status</th>
                                    <th>Penerima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Reminder RPS</td>
                                    <td>Setiap Minggu, Senin 09:00</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>Semua Dosen</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Reminder Upload Materi</td>
                                    <td>Setiap Hari, 08:00</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>Dosen Pengajar</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Reminder Perwalian</td>
                                    <td>Setiap 2 Minggu, Jumat 10:00</td>
                                    <td><span class="badge bg-warning">Tertunda</span></td>
                                    <td>PA (Pembimbing Akademik)</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary">Edit</button>
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
@endsection
