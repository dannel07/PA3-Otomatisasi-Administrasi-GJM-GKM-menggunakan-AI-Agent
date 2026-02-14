<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\RPS;
use App\Models\Materi;
use App\Models\User;
use App\Models\LogEmail;
use Illuminate\Support\Facades\Auth;

class MonitoringRPSController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil dosen dari tabel users (role = dosen)
        $dosenList = User::where('role', 'dosen')
            ->paginate(10);

        return view('gkm.monitoring-rps.index', compact('user', 'dosenList'));
    }

    public function ceklistRPS($dosenId = null)
    {
        $user = Auth::user();

        $rpsList = RPS::when($dosenId, function ($query) use ($dosenId) {
                $query->where('user_id', $dosenId);
            })
            ->paginate(10);

        return view('gkm.monitoring-rps.index', compact('user', 'rpsList'));
    }

    public function historyReminder($dosenId = null)
    {
        $user = Auth::user();

        $logEmail = LogEmail::when($dosenId, function ($query) use ($dosenId) {
                $query->where('user_penerima_id', $dosenId);
            })
            ->paginate(10);

        return view('gkm.monitoring-rps.index', compact('user', 'logEmail'));
    }
}
