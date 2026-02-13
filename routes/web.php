<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GKM\DashboardController as GKMDashboardController;
use App\Http\Controllers\GKM\DataMasterController;
use App\Http\Controllers\GKM\MonitoringRPSController;
use App\Http\Controllers\GKM\MonitoringPerkuliahanController;
use App\Http\Controllers\GKM\PelaporanController;
use App\Http\Controllers\GKM\ReminderAgentController;
use App\Http\Controllers\GJM\DashboardController as GJMDashboardController;
use App\Http\Controllers\GJM\RecapLaporanController;
use App\Http\Controllers\GJM\ValidasiLaporanController;
use App\Http\Controllers\GJM\LaporanGJMController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        if (auth()->user()->isGKM()) {
            return redirect()->route('gkm.dashboard');
        } elseif (auth()->user()->isGJM()) {
            return redirect()->route('gjm.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // GKM Routes
    Route::prefix('gkm')->name('gkm.')->group(function () {
        Route::get('/dashboard', [GKMDashboardController::class, 'index'])->name('dashboard');

        // Data Master
        Route::prefix('data-master')->name('data-master.')->group(function () {
            Route::get('/', [DataMasterController::class, 'index'])->name('index');
            Route::get('/dosen-pengajar', [DataMasterController::class, 'dosenPengajar'])->name('dosen');
            Route::get('/matakuliah', [DataMasterController::class, 'matakuliah'])->name('matakuliah');
            Route::get('/template-laporan', [DataMasterController::class, 'templateLaporan'])->name('template');
        });

        // Monitoring RPS & Materi
        Route::prefix('monitoring-rps')->name('monitoring-rps.')->group(function () {
            Route::get('/', [MonitoringRPSController::class, 'index'])->name('index');
            Route::get('/ceklist-rps', [MonitoringRPSController::class, 'ceklistRPS'])->name('ceklist');
            Route::get('/history-reminder', [MonitoringRPSController::class, 'historyReminder'])->name('history');
        });

        // Monitoring Perkuliahan
        Route::prefix('monitoring-perkuliahan')->name('monitoring-perkuliahan.')->group(function () {
            Route::get('/', [MonitoringPerkuliahanController::class, 'index'])->name('index');
            Route::get('/reminder-perwalian', [MonitoringPerkuliahanController::class, 'reminderPerwalian'])->name('perwalian');
            Route::get('/reminder-materi', [MonitoringPerkuliahanController::class, 'reminderMateri'])->name('materi');
            Route::get('/reminder-review-soal', [MonitoringPerkuliahanController::class, 'reminderReviewSoal'])->name('soal');
        });

        // Pelaporan
        Route::prefix('pelaporan')->name('pelaporan.')->group(function () {
            Route::get('/', [PelaporanController::class, 'index'])->name('index');
            Route::get('/artefak', [PelaporanController::class, 'laporanArtefak'])->name('artefak');
            Route::get('/kuisioner', [PelaporanController::class, 'laporanKuisioner'])->name('kuisioner');
            Route::post('/generate', [PelaporanController::class, 'generate'])->name('generate');
        });

        // Reminder Agent
        Route::prefix('reminder-agent')->name('reminder-agent.')->group(function () {
            Route::get('/', [ReminderAgentController::class, 'index'])->name('index');
            Route::get('/jadwal', [ReminderAgentController::class, 'jadwal'])->name('jadwal');
            Route::get('/log-email', [ReminderAgentController::class, 'logEmail'])->name('log');
            Route::post('/jadwal', [ReminderAgentController::class, 'storeJadwal'])->name('jadwal.store');
        });
    });

    // GJM Routes
    Route::prefix('gjm')->name('gjm.')->group(function () {
        Route::get('/dashboard', [GJMDashboardController::class, 'index'])->name('dashboard');

        // Recap Laporan
        Route::prefix('recap-laporan')->name('recap.')->group(function () {
            Route::get('/', [RecapLaporanController::class, 'index'])->name('index');
            Route::get('/grafik-kepatuhan', [RecapLaporanController::class, 'grafikKepatuhan'])->name('grafik');
            Route::get('/evaluasi', [RecapLaporanController::class, 'evaluasi'])->name('evaluasi');
        });

        // Validasi & Verifikasi
        Route::prefix('validasi-laporan')->name('validasi.')->group(function () {
            Route::get('/', [ValidasiLaporanController::class, 'index'])->name('index');
            Route::get('/{id}', [ValidasiLaporanController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [ValidasiLaporanController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [ValidasiLaporanController::class, 'reject'])->name('reject');
        });

        // Laporan GJM Fakultas
        Route::prefix('laporan-gjm')->name('laporan.')->group(function () {
            Route::get('/', [LaporanGJMController::class, 'index'])->name('index');
            Route::get('/bulanan', [LaporanGJMController::class, 'laporanBulanan'])->name('bulanan');
            Route::get('/tahunan', [LaporanGJMController::class, 'laporanTahunan'])->name('tahunan');
            Route::post('/generate', [LaporanGJMController::class, 'generate'])->name('generate');
        });
    });
});
