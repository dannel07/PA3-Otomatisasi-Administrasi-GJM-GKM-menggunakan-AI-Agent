<?php

namespace App\Http\Controllers\GKM;

use App\Http\Controllers\Controller;
use App\Models\RPS;
use App\Models\Materi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\LogEmail;
use App\Mail\ReminderRPSMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MonitoringRPSController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil dosen dari tabel dosen dengan relasi matakuliah
        $dosenList = \App\Models\Dosen::with('matakuliah')
            ->where('status', 'aktif')
            ->paginate(10);

        return view('gkm.monitoring-rps.index', compact('user', 'dosenList'));
    }

    public function ceklistRPS()
    {
        $user = Auth::user();

        // Ambil dosen yang belum upload RPS
        $dosenList = Dosen::with('matakuliah')
            ->where('status', 'aktif')
            ->get();

        return view('gkm.monitoring-rps.ceklist', compact('user', 'dosenList'));
    }

    public function generateReminderMessage(Request $request)
    {
        $request->validate([
            'dosen_ids' => 'required|array',
            'dosen_ids.*' => 'exists:dosen,id',
        ]);

        $dosenIds = $request->dosen_ids;
        $dosenList = Dosen::whereIn('id', $dosenIds)->get();

        // Generate pesan reminder menggunakan template
        $templatePesan = $this->generateTemplateMessage($dosenList);

        return response()->json([
            'success' => true,
            'message' => $templatePesan,
            'dosen_count' => $dosenList->count(),
        ]);
    }

    private function generateTemplateMessage($dosenList)
    {
        $namaDosen = $dosenList->count() > 1 
            ? 'Bapak/Ibu Dosen' 
            : 'Bapak/Ibu ' . $dosenList->first()->nama_lengkap;

        $message = "Kepada Yth.\n";
        $message .= "{$namaDosen}\n\n";
        $message .= "Dengan hormat,\n\n";
        $message .= "Melalui surat elektronik ini, kami ingin mengingatkan Bapak/Ibu untuk segera mengunggah Rencana Pembelajaran Semester (RPS) ";
        $message .= "untuk mata kuliah yang diampu pada semester ini.\n\n";
        $message .= "Pengunggahan RPS sangat penting untuk:\n";
        $message .= "1. Memastikan kesiapan pembelajaran semester ini\n";
        $message .= "2. Memenuhi standar akreditasi program studi\n";
        $message .= "3. Memberikan panduan yang jelas kepada mahasiswa\n\n";
        $message .= "Mohon untuk dapat mengunggah RPS paling lambat 3 hari ke depan melalui sistem informasi akademik.\n\n";
        $message .= "Apabila terdapat kendala atau pertanyaan, silakan menghubungi kami.\n\n";
        $message .= "Terima kasih atas perhatian dan kerjasamanya.\n\n";
        $message .= "Hormat kami,\n";
        $message .= "Tim GKM TRPL";

        return $message;
    }

    public function sendReminder(Request $request)
    {
        $request->validate([
            'dosen_ids' => 'required|array',
            'dosen_ids.*' => 'exists:dosen,id',
            'message' => 'required|string',
            'subject' => 'required|string|max:255',
        ]);

        try {
            $dosenList = Dosen::whereIn('id', $request->dosen_ids)->get();
            $successCount = 0;
            $failedCount = 0;

            foreach ($dosenList as $dosen) {
                try {
                    // Kirim email sebenarnya
                    Mail::to($dosen->kontak_email)->send(
                        new ReminderRPSMail(
                            $request->subject,
                            $request->message,
                            $dosen->nama_lengkap
                        )
                    );

                    // Simpan log email jika berhasil
                    LogEmail::create([
                        'reminder_id' => null,
                        'penerima_email' => $dosen->kontak_email,
                        'subjek' => $request->subject,
                        'isi_email' => $request->message,
                        'status_pengiriman' => 'success',
                        'tanggal_pengiriman' => now()->toDateString(),
                        'percobaan_kirim' => 1,
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    // Simpan log email jika gagal
                    LogEmail::create([
                        'reminder_id' => null,
                        'penerima_email' => $dosen->kontak_email,
                        'subjek' => $request->subject,
                        'isi_email' => $request->message,
                        'status_pengiriman' => 'failed',
                        'pesan_error' => $e->getMessage(),
                        'tanggal_pengiriman' => now()->toDateString(),
                        'percobaan_kirim' => 1,
                    ]);

                    $failedCount++;
                }
            }

            if ($failedCount > 0) {
                return redirect()->route('gkm.monitoring-rps.index')
                    ->with('warning', "Reminder berhasil dikirim ke {$successCount} dosen, gagal ke {$failedCount} dosen");
            }

            return redirect()->route('gkm.monitoring-rps.index')
                ->with('success', "Reminder berhasil dikirim ke {$successCount} dosen");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengirim reminder: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function historyReminder($dosenId = null)
    {
        $user = Auth::user();

        // Ambil dosen untuk filter
        $dosenList = Dosen::where('status', 'aktif')->get();
        
        // Ambil log email
        $logEmailList = LogEmail::when($dosenId, function ($query) use ($dosenId) {
                // Cari dosen berdasarkan ID
                $dosen = Dosen::find($dosenId);
                if ($dosen) {
                    $query->where('penerima_email', $dosen->kontak_email);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('gkm.monitoring-rps.history', compact('user', 'logEmailList', 'dosenList', 'dosenId'));
    }
}
