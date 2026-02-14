<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\LaporanGKM;
use App\Models\EvaluasiArtefak;
use App\Models\Kuisioner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('gkm.pelaporan.index', compact('user'));
    }

    public function laporanArtefak()
    {
        $user = Auth::user();
        $laporan = EvaluasiArtefak::paginate(10);

        return view('gkm.pelaporan.laporan-artefak', compact('user', 'dosen', 'laporan'));
    }

    public function laporanKuisioner()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $kuisioner = Kuisioner::with('jawaban')->get();

        return view('gkm.pelaporan.laporan-kuisioner', compact('user', 'dosen', 'kuisioner'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'tipe_laporan' => 'required|in:Artefak,Kuisioner',
            'periode' => 'required|string',
        ]);

        // Generate laporan (akan diintegrasikan dengan AI)
        // Untuk sekarang, ini adalah placeholder

        return redirect()->route('gkm.pelaporan.index')
            ->with('success', 'Laporan berhasil di-generate');
    }
}
