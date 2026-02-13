<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MonitoringPerkuliahanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $reminders = Reminder::with('userPenerima')
            ->paginate(10);

        return view('gkm.monitoring-perkuliahan.index', compact('user', 'reminders'));
    }

    public function reminderPerwalian()
    {
        $user = Auth::user();

        $reminders = Reminder::where('tipe_reminder', 'Perwalian')
            ->with('userPenerima')
            ->paginate(10);

        return view('gkm.monitoring-perkuliahan.index', compact('user', 'reminders'));
    }

    public function reminderMateri()
    {
        $user = Auth::user();

        // Ambil dosen dari user login (jika role dosen)
        $dosen = $user;

        $reminders = Reminder::where('tipe_reminder', 'Materi')
            ->whereHas('userPenerima', function ($query) use ($dosen) {
                $query->where('prodi_id', $dosen->prodi_id);
            })
            ->with('userPenerima')
            ->paginate(10);

        return view(
            'gkm.monitoring-perkuliahan.reminder-materi',
            compact('user', 'dosen', 'reminders')
        );
    }

    public function reminderReviewSoal()
    {
        $user = Auth::user();
        $dosen = $user;

        $reminders = Reminder::where('tipe_reminder', 'Review Soal')
            ->whereHas('userPenerima', function ($query) use ($dosen) {
                $query->where('prodi_id', $dosen->prodi_id);
            })
            ->with('userPenerima')
            ->paginate(10);

        return view(
            'gkm.monitoring-perkuliahan.reminder-review-soal',
            compact('user', 'dosen', 'reminders')
        );
    }
}
