<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Ajaran;
use App\Models\User;
use App\Models\Prodi;
use App\Models\TemplateLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $dosenList = Dosen::with('prodi')->orderBy('nama_lengkap')->paginate(10);
        return view('gkm.data-master.dosen', compact('user', 'dosenList'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn',
            'kontak_email' => 'required|email|unique:dosen,kontak_email',
            'gelar_akademik' => 'nullable|string|max:100',
            'jabatan_akademik' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,tidak_aktif,pensiun',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.unique' => 'NIDN sudah terdaftar',
            'kontak_email.required' => 'Email wajib diisi',
            'kontak_email.email' => 'Format email tidak valid',
            'kontak_email.unique' => 'Email sudah terdaftar',
            'status.required' => 'Status wajib dipilih',
        ]);

        try {
            DB::beginTransaction();

            // Generate username dari email (bagian sebelum @)
            $username = explode('@', $request->kontak_email)[0];
            
            // Pastikan username unik
            $baseUsername = $username;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            // Buat user terlebih dahulu
            $user = User::create([
                'name' => $request->nama_lengkap,
                'username' => $username,
                'email' => $request->kontak_email,
                'password' => Hash::make('password123'), // Default password
                'role' => 'dosen',
            ]);

            // Ambil prodi TRPL (atau prodi default)
            $prodi = Prodi::where('nama_prodi', 'LIKE', '%TRPL%')->first();
            if (!$prodi) {
                $prodi = Prodi::first(); // Fallback ke prodi pertama
            }

            // Buat data dosen
            Dosen::create([
                'user_id' => $user->id,
                'prodi_id' => $prodi ? $prodi->id : 1,
                'nama_lengkap' => $request->nama_lengkap,
                'nidn' => $request->nidn,
                'kontak_email' => $request->kontak_email,
                'gelar_akademik' => $request->gelar_akademik,
                'jabatan_akademik' => $request->jabatan_akademik,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('gkm.data-master.dosen')
                ->with('success', 'Dosen berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambahkan dosen: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateDosen(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn,' . $id,
            'kontak_email' => 'required|email|unique:dosen,kontak_email,' . $id,
            'gelar_akademik' => 'nullable|string|max:100',
            'jabatan_akademik' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,tidak_aktif,pensiun',
        ]);

        try {
            DB::beginTransaction();

            $dosen->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nidn' => $request->nidn,
                'kontak_email' => $request->kontak_email,
                'gelar_akademik' => $request->gelar_akademik,
                'jabatan_akademik' => $request->jabatan_akademik,
                'status' => $request->status,
            ]);

            // Update user juga
            if ($dosen->user) {
                $dosen->user->update([
                    'name' => $request->nama_lengkap,
                    'email' => $request->kontak_email,
                ]);
            }

            DB::commit();

            return redirect()->route('gkm.data-master.dosen')
                ->with('success', 'Data dosen berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data dosen: ' . $e->getMessage());
        }
    }

    public function destroyDosen($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            
            DB::beginTransaction();
            
            // Hapus user terkait
            if ($dosen->user) {
                $dosen->user->delete();
            }
            
            $dosen->delete();
            
            DB::commit();

            return redirect()->route('gkm.data-master.dosen')
                ->with('success', 'Dosen berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus dosen: ' . $e->getMessage());
        }
    }

    public function matakuliah()
    {
        $user = Auth::user();
        $matakuliahList = Matakuliah::with(['prodi', 'dosen'])->orderBy('kode_mk')->paginate(10);
        $dosenList = Dosen::where('status', 'aktif')->orderBy('nama_lengkap')->get();
        return view('gkm.data-master.matakuliah', compact('user', 'matakuliahList', 'dosenList'));
    }

    public function storeMatakuliah(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|unique:matakuliah,kode_mk|max:20',
            'nama_mk' => 'required|string|max:255',
            'dosen_ids' => 'nullable|array',
            'dosen_ids.*' => 'exists:dosen,id',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'jenis_mk' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi',
            'kode_mk.unique' => 'Kode mata kuliah sudah terdaftar',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi',
            'sks.required' => 'SKS wajib diisi',
            'sks.min' => 'SKS minimal 1',
            'sks.max' => 'SKS maksimal 6',
            'semester.required' => 'Semester wajib diisi',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 8',
            'status.required' => 'Status wajib dipilih',
        ]);

        try {
            DB::beginTransaction();

            // Ambil prodi TRPL
            $prodi = Prodi::where('nama_prodi', 'LIKE', '%TRPL%')->first();
            if (!$prodi) {
                $prodi = Prodi::first();
            }

            $matakuliah = Matakuliah::create([
                'prodi_id' => $prodi ? $prodi->id : 1,
                'kode_mk' => $request->kode_mk,
                'nama_mk' => $request->nama_mk,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'jenis_mk' => $request->jenis_mk,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            // Attach dosen ke matakuliah
            if ($request->dosen_ids) {
                $matakuliah->dosen()->attach($request->dosen_ids);
            }

            DB::commit();

            return redirect()->route('gkm.data-master.matakuliah')
                ->with('success', 'Mata kuliah berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambahkan mata kuliah: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateMatakuliah(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required|string|max:20|unique:matakuliah,kode_mk,' . $id,
            'nama_mk' => 'required|string|max:255',
            'dosen_ids' => 'nullable|array',
            'dosen_ids.*' => 'exists:dosen,id',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'jenis_mk' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        try {
            DB::beginTransaction();

            $matakuliah->update([
                'kode_mk' => $request->kode_mk,
                'nama_mk' => $request->nama_mk,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'jenis_mk' => $request->jenis_mk,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            // Sync dosen (hapus yang lama, tambah yang baru)
            if ($request->has('dosen_ids')) {
                $matakuliah->dosen()->sync($request->dosen_ids);
            } else {
                $matakuliah->dosen()->detach();
            }

            DB::commit();

            return redirect()->route('gkm.data-master.matakuliah')
                ->with('success', 'Mata kuliah berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui mata kuliah: ' . $e->getMessage());
        }
    }

    public function destroyMatakuliah($id)
    {
        try {
            $matakuliah = Matakuliah::findOrFail($id);
            $matakuliah->delete();

            return redirect()->route('gkm.data-master.matakuliah')
                ->with('success', 'Mata kuliah berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus mata kuliah: ' . $e->getMessage());
        }
    }

    public function templateLaporan()
    {
        $user = Auth::user();
        $templateList = TemplateLaporan::orderBy('created_at', 'desc')->paginate(10);
        return view('gkm.data-master.template', compact('user', 'templateList'));
    }

    public function storeTemplate(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240', // max 10MB
            'deskripsi' => 'nullable|string',
        ], [
            'nama_template.required' => 'Nama template wajib diisi',
            'file.required' => 'File wajib diupload',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, PPT, PPTX, XLS, atau XLSX',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            
            // Generate unique filename
            $fileName = time() . '_' . str_replace(' ', '_', $originalName);
            
            // Store file
            $filePath = $file->storeAs('templates', $fileName, 'public');

            TemplateLaporan::create([
                'nama_template' => $request->nama_template,
                'nama_file' => $originalName,
                'jenis_file' => strtoupper($extension),
                'file_path' => $filePath,
                'ukuran_file' => $fileSize,
                'deskripsi' => $request->deskripsi,
                'uploaded_by' => Auth::id(),
            ]);

            return redirect()->route('gkm.data-master.template')
                ->with('success', 'Template berhasil diupload');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupload template: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function downloadTemplate($id)
    {
        try {
            $template = TemplateLaporan::findOrFail($id);
            
            if (!Storage::disk('public')->exists($template->file_path)) {
                return redirect()->back()
                    ->with('error', 'File tidak ditemukan');
            }

            return Storage::disk('public')->download($template->file_path, $template->nama_file);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload template: ' . $e->getMessage());
        }
    }

    public function destroyTemplate($id)
    {
        try {
            $template = TemplateLaporan::findOrFail($id);
            
            // Hapus file dari storage
            if (Storage::disk('public')->exists($template->file_path)) {
                Storage::disk('public')->delete($template->file_path);
            }

            $template->delete();

            return redirect()->route('gkm.data-master.template')
                ->with('success', 'Template berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus template: ' . $e->getMessage());
        }
    }

    public function periodeAkademik()
    {
        $user = Auth::user();
        $periodeList = Ajaran::orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->paginate(10);
        return view('gkm.data-master.periode', compact('user', 'periodeList'));
    }

    public function storePeriode(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|integer|min:2020|max:2100',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tanggal_mulai',
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'semester.required' => 'Semester wajib dipilih',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_akhir.required' => 'Tanggal akhir wajib diisi',
            'tanggal_akhir.after' => 'Tanggal akhir harus setelah tanggal mulai',
        ]);

        try {
            Ajaran::create([
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester' => $request->semester,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
                'status' => 'non_aktif',
            ]);

            return redirect()->route('gkm.data-master.periode')
                ->with('success', 'Periode akademik berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan periode akademik: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updatePeriode(Request $request, $id)
    {
        $periode = Ajaran::findOrFail($id);

        $request->validate([
            'tahun_ajaran' => 'required|integer|min:2020|max:2100',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tanggal_mulai',
        ]);

        try {
            $periode->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester' => $request->semester,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            return redirect()->route('gkm.data-master.periode')
                ->with('success', 'Periode akademik berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui periode akademik: ' . $e->getMessage());
        }
    }

    public function activatePeriode($id)
    {
        try {
            DB::beginTransaction();

            // Nonaktifkan semua periode
            Ajaran::query()->update(['status' => 'non_aktif']);

            // Aktifkan periode yang dipilih
            $periode = Ajaran::findOrFail($id);
            $periode->update(['status' => 'aktif']);

            DB::commit();

            return redirect()->route('gkm.data-master.periode')
                ->with('success', 'Periode akademik berhasil diaktifkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal mengaktifkan periode akademik: ' . $e->getMessage());
        }
    }

    public function destroyPeriode($id)
    {
        try {
            $periode = Ajaran::findOrFail($id);
            
            if ($periode->status == 'aktif') {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus periode yang sedang aktif');
            }

            $periode->delete();

            return redirect()->route('gkm.data-master.periode')
                ->with('success', 'Periode akademik berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus periode akademik: ' . $e->getMessage());
        }
    }
}
