<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\JadwalReminder;
use App\Models\LogEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReminderAgentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jadwalList = JadwalReminder::paginate(10);
        return view('gkm.reminder-agent.index', compact('user', 'jadwalList'));
    }

    public function jadwal()
    {
        $user = Auth::user();
        $jadwalList = JadwalReminder::paginate(10);
        return view('gkm.reminder-agent.index', compact('user', 'jadwalList'));
    }

    public function logEmail()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $logEmailList = LogEmail::orderBy('waktu_pengiriman', 'desc')
            ->paginate(10);

        return view('gkm.reminder-agent.log-email', compact('user', 'dosen', 'logEmailList'));
    }

    public function storeJadwal(Request $request)
    {
        $validated = $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'tipe_reminder' => 'required|in:Perwalian,Upload Materi,Review Soal',
            'hari_pengiriman' => 'required|array',
            'jam_pengiriman' => 'required|date_format:H:i',
            'pesan_template' => 'required|string',
        ]);

        JadwalReminder::create([
            'nama_jadwal' => $validated['nama_jadwal'],
            'tipe_reminder' => $validated['tipe_reminder'],
            'hari_pengiriman' => json_encode($validated['hari_pengiriman']),
            'jam_pengiriman' => $validated['jam_pengiriman'],
            'pesan_template' => $validated['pesan_template'],
            'is_active' => true,
            'dibuat_oleh' => Auth::id(),
        ]);

        return redirect()->route('gkm.reminder-agent.jadwal')
            ->with('success', 'Jadwal reminder berhasil ditambahkan');
    }
}
