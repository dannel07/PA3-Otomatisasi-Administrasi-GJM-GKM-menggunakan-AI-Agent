<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Materi;
use App\Models\RPS;
use App\Models\Reminder;
use App\Models\Kuisioner;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik untuk dashboard GKM - Simplified
        $stats = [
            'materi_uploaded' => Materi::where('status_upload_materi', 'Sudah Upload')->count(),
            'materi_belum' => Materi::where('status_upload_materi', 'Belum Upload')->count(),
            'rps_lengkap' => RPS::where('status_review_rps', 'Lengkap')->count(),
            'rps_belum' => RPS::where('status_review_rps', 'Belum Lengkap')->count(),
            'kuisioner_pengisi' => Kuisioner::where('status_kuisioner', 'Sedang Berjalan')->count(),
            'reminders_pending' => Reminder::where('status_pengiriman', 'pending')->count(),
        ];

        $periode = date('F Y');

        return view('gkm.dashboard.index', compact('user', 'stats', 'periode'));
    }
}
