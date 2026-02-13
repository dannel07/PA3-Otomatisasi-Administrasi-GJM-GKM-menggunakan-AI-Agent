<?php

namespace App\Http\Controllers\GJM;

use App\Http\Controllers\Controller;
use App\Models\LaporanGJM;
use Illuminate\Support\Facades\Auth;

class LaporanGJMController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('gjm.laporan-gjm.index', compact('user'));
    }

    public function laporanBulanan()
    {
        $user = Auth::user();
        $laporan = LaporanGJM::paginate(10);
        return view('gjm.laporan-gjm.index', compact('user', 'laporan'));
    }

    public function laporanTahunan()
    {
        $user = Auth::user();

        $laporan = LaporanGJM::where('periode_laporan', 'Tahunan')
            ->orderBy('tanggal_buat_laporan', 'desc')
            ->paginate(10);

        return view('gjm.laporan-gjm.laporan-tahunan', compact('user', 'laporan'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'periode_laporan' => 'required|in:Bulanan,Tahunan',
        ]);

        // Generate laporan (akan diintegrasikan dengan AI)
        // Untuk sekarang, ini adalah placeholder

        return redirect()->route('gjm.laporan.index')
            ->with('success', 'Laporan berhasil di-generate');
    }
}
