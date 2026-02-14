<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class DataMasterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('gkm.data-master.index', compact('user'));
    }

    public function dosenPengajar()
    {
        $user = Auth::user();
        $dosenList = Dosen::paginate(10);
        return view('gkm.data-master.dosen', compact('user', 'dosenList'));
    }

    public function matakuliah()
    {
        $user = Auth::user();
        $matakuliahList = Matakuliah::paginate(10);
        return view('gkm.data-master.matakuliah', compact('user', 'matakuliahList'));
    }

    public function templateLaporan()
    {
        $user = Auth::user();
        return view('gkm.data-master.template', compact('user'));
    }
}
