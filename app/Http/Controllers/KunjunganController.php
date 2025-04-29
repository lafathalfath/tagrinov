<?php

namespace App\Http\Controllers;

use App\Models\JenisKelamin;
use App\Models\JenisPengunjung;
use App\Models\KategoriInformasi;
use App\Models\Kunjungan;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\PilihanPertanian;
use App\Models\Usia;
use App\Models\User;
use App\Mail\KunjunganDiterima;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Pipeline\Hub;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\KunjunganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class KunjunganController extends Controller
{
    public function getAll(Request $request) {
        $query = Kunjungan::query();
    
        // Ambil input pencarian
        $search = $request->input('search');
    
        // input search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('tanggal_kunjungan', 'like', "%$search%")
                  ->orWhere('asal_instansi', 'like', "%$search%")
                  ->orWhere('no_hp', 'like', "%$search%") 
                  ->orWhere('status_verifikasi', 'like', "%$search%")
                  ->orWhereHas('jenis_pengunjung', function ($q) use ($search) { 
                      $q->where('nama', 'like', "%$search%"); 
                  });
            });
        }
    
        // Ambil data kunjungan
        $kunjungan = $query->paginate(10)->appends(['search' => $search]);
    
        return view('admin.kunjungan.index', compact('kunjungan', 'search'));
    }
    

    public function getById($id) {
        $kunjungan = Kunjungan::find($id);
    
        if (!$kunjungan) {
            return back()->with('error', 'Data kunjungan tidak ditemukan.');
        }
    
        $kunjungan->tanggal_kunjungan = Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y');
        return view('admin.kunjungan.detail', compact('kunjungan'));
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'usia_id' => 'required|string',
            'jenis_kelamin_id' => 'required|string',
            'asal_instansi' => 'required|string|max:255',
            'pekerjaan_id' => 'required|string',
            'kategori_informasi_id' => 'required|string',
            'pilihan_pertanian_id' => 'nullable|string',
            'pendidikan_id' => 'required|string',
            'jenis_pengunjung_id' => 'required|string',
            'jumlah_orang' => 'nullable|integer|min:2',
            'tanggal_kunjungan' => [
                'required',
                'date',
            ],
            'tujuan_kunjungan' => 'required|string',
            'url_foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'url_foto_selfie' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'no_hp' => 'required|starts_with:08|digits_between:11,13',

            'url_foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'url_foto_ktp.image' => 'File yang diunggah harus berupa gambar.',
            'url_foto_ktp.mimes' => 'Foto KTP harus berformat jpeg, png, atau jpg.',
            'url_foto_ktp.max' => 'Ukuran foto KTP tidak boleh lebih dari 10MB.',

            'url_foto_selfie.required' => 'Foto selfie wajib diunggah.',
            'url_foto_selfie.image' => 'File yang diunggah harus berupa gambar.',
            'url_foto_selfie.mimes' => 'Foto selfie harus berformat jpeg, png, atau jpg.',
            'url_foto_selfie.max' => 'Ukuran foto selfie tidak boleh lebih dari 10MB.',

            'tanggal_kunjungan.unique' => 'Tanggal kunjungan ini sudah terdaftar, silakan pilih tanggal lain.'
        ]);

        // Jika validasi gagal, redirect kembali dengan input yang benar tetap terisi
        if (!$validatedData) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Inisialisasi variabel untuk menyimpan path foto
        $url_foto_ktp = null;
        $url_foto_selfie = null;

        // Menyimpan foto KTP
        if ($request->hasFile('url_foto_ktp')) {
            $url_foto_ktp = $request->file('url_foto_ktp')->store('kunjungan/fotoktp', 'public');
        }

        // Menyimpan foto selfie
        if ($request->hasFile('url_foto_selfie')) {
            $url_foto_selfie = $request->file('url_foto_selfie')->store('kunjungan/fotoselfie', 'public');
        }

        // Membuat data kunjungan
        $kunjungan = Kunjungan::create([
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'usia_id' => $request->usia_id,
            'jenis_kelamin_id' => $request->jenis_kelamin_id,
            'asal_instansi' => $request->asal_instansi,
            'pekerjaan_id' => $request->pekerjaan_id,
            'kategori_informasi_id' => $request->kategori_informasi_id,
            'pilihan_pertanian_id' => $request->pilihan_pertanian_id ?: null,
            'pendidikan_id' => $request->pendidikan_id,
            'jenis_pengunjung_id' => $request->jenis_pengunjung_id,
            'jumlah_orang' => $request->jumlah_orang ?: null,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'tujuan_kunjungan' => $request->tujuan_kunjungan,
            'url_foto_ktp' => $url_foto_ktp,
            'url_foto_selfie' => $url_foto_selfie,
        ]);

        
        // Periksa apakah data berhasil disimpan
        if ($kunjungan) {
            // Ambil semua email user
            $users = User::pluck('email');
    
            // Kirim email ke semua user
            foreach ($users as $email) {
                Mail::to($email)->send(new KunjunganDiterima($kunjungan));
            }
            return redirect()->back()->with('success', 'Permohonan kunjungan Anda telah berhasil dikirim. Mohon menunggu, informasi selanjutnya akan kami kirimkan melalui WhatsApps! Terimakasih.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim permohonan kunjungan.');
        }
    }

    // public function update(Request $request, $id) {
    //     $kunjungan = Kunjungan::find($id);
    //     if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        
    //     $request->validate([

    //     ], [
            
    //     ]);
    //     if ($kunjungan->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $kunjungan], 200);
    //     return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    // }

    public function destroy($id)
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return back()->with('error', 'Data kunjungan tidak ditemukan.');
        }

        // Jangan hapus file, karena data hanya disoft-delete
        if ($kunjungan->delete()) {
            return back()->with('success', 'Data permohonan kunjungan berhasil dipindahkan ke keranjang sampah.');
        }

        return back()->with('error', 'Gagal menghapus data kunjungan.');
    }

    public function forceDelete($id)
    {
        $kunjungan = Kunjungan::onlyTrashed()->find($id);
    
        if (!$kunjungan) {
            return back()->with('error', 'Data kunjungan tidak ditemukan untuk dihapus permanen.');
        }
    
        // Hapus file dari storage
        if ($kunjungan->url_foto_ktp) {
            Storage::disk('public')->delete($kunjungan->url_foto_ktp);
        }
    
        if ($kunjungan->url_foto_selfie) {
            Storage::disk('public')->delete($kunjungan->url_foto_selfie);
        }
    
        $kunjungan->forceDelete();
    
        return back()->with('success', 'Data kunjungan berhasil dihapus permanen.');
    }
    


    // public function destroy($id) {
    //     $kunjungan = Kunjungan::find($id);
    //     if (!$kunjungan) {
    //         return back()->with('error', 'Data kunjungan tidak ditemukan.');
    //     }
    //     if ($kunjungan->url_foto_ktp) {
    //         Storage::disk('public')->delete($kunjungan->url_foto_ktp);
    //     }

    //     if ($kunjungan->url_foto_selfie) {
    //         Storage::disk('public')->delete($kunjungan->url_foto_selfie);
    //     }
    //     if ($kunjungan->delete()) {
    //         return back()->with('success', 'Data kunjungan berhasil dihapus.');
    //     }
    //     return back()->with('error', 'Gagal menghapus data kunjungan.');
    // }

    public function index()
    {
        $usia = Usia::get();
        $jenis_kelamin = JenisKelamin::get();
        $pekerjaan = Pekerjaan::get();
        $kategori_informasi = KategoriInformasi::get();
        $pilihan_pertanian = PilihanPertanian::get();
        $pendidikan = Pendidikan::get();
        $jenis_pengunjung = JenisPengunjung::get();
        
        return view('guest.permohonan.kunjungan.index', [
            'usia' => $usia,
            'jenis_kelamin' => $jenis_kelamin,
            'pekerjaan' => $pekerjaan,
            'kategori_informasi' => $kategori_informasi,
            'pilihan_pertanian' => $pilihan_pertanian,
            'pendidikan' => $pendidikan,
            'jenis_pengunjung' => $jenis_pengunjung,
        ]);
    }

    public function verify($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_verifikasi = 'Terverifikasi';
        $kunjungan->verified_at = now();
        $kunjungan->verified_by = auth()->id();
        $kunjungan->save();
    
        return back()->with('success', 'Permohonan kunjungan berhasil diverifikasi!');
    }
    
    public function rejectVerification($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_verifikasi = 'Ditolak';
        $kunjungan->rejectverify_at = now();
        $kunjungan->rejectverify_by = auth()->id();
        $kunjungan->save();
    
        return back()->with('success', 'Permohonan kunjungan berhasil ditolak!');
    }
    
    public function cancelVerification($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
    
        // Cek apakah status_setujui adalah 'Disetujui'
        if ($kunjungan->status_setujui === 'Disetujui') {
            return back()->with('error', 'Verifikasi tidak bisa dibatalkan karena pemohon kunjungan ini telah disetujui oleh Tim Kerja.');
        }
    
        // Jika belum disetujui, maka bisa dibatalkan
        $kunjungan->status_verifikasi = 'Belum Diverifikasi';
        $kunjungan->save();
    
        return back()->with('success', 'Verifikasi kunjungan telah dibatalkan.');
    }
    
    public function cancelRejection($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_verifikasi = 'Belum Diverifikasi';
        $kunjungan->save();
    
        return back()->with('success', 'Penolakan verifikasi kunjungan telah dibatalkan.');
    }

        // Menampilkan daftar kunjungan yang sudah diverifikasi admin
        public function indextimkerja(Request $request)
        {
            $query = Kunjungan::where('status_verifikasi', 'Terverifikasi');
    
            $search = $request->input('search');
    
            // input search
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%")
                      ->orWhere('tanggal_kunjungan', 'like', "%$search%")
                      ->orWhere('asal_instansi', 'like', "%$search%")
                      ->orWhere('no_hp', 'like', "%$search%") 
                      ->orWhere('status_setujui', 'like', "%$search%")
                      ->orWhereHas('jenis_pengunjung', function ($q) use ($search) { 
                          $q->where('nama', 'like', "%$search%");
                      });
                });
            }
    
            $kunjungan = $query->paginate(10)->appends(['search' => $search]);
    
            return view('timkerja.kunjungan.index', compact('kunjungan', 'search'));
        }
    
        // Menampilkan halaman detail kunjungan
        public function detail($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            return view('timkerja.kunjungan.detail', compact('kunjungan'));
        }
    
        // Tim kerja
        // Menyetujui permohonan kunjungan
        public function approve($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            $kunjungan->status_setujui = 'Disetujui';
            $kunjungan->approved_at = now();
            $kunjungan->approved_by = auth()->id();
            $kunjungan->save();
    
            return back()->with('success', 'Permohonan kunjungan berhasil disetujui.');
        }
    
        public function reject($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            $kunjungan->status_setujui = 'Ditolak';
            $kunjungan->rejectapprove_at = now();
            $kunjungan->rejectapprove_by = auth()->id();
            $kunjungan->save();
    
            return back()->with('success', 'Permohonan kunjungan telah ditolak.');
        }

        public function cancelApproval($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            $kunjungan->status_setujui = 'pending';
            $kunjungan->save();

            return back()->with('success', 'Persetujuan kunjungan telah dibatalkan.');
        }

        public function cancelRejectionApproval($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            $kunjungan->status_setujui = 'pending';
            $kunjungan->save();

            return back()->with('success', 'Penolakan kunjungan telah dibatalkan.');
        }

        public function destroykunjungan($id)
        {
            $kunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->findOrFail($id);
            $kunjungan->delete();
    
            return back()->with('success', 'Permohonan kunjungan berhasil dihapus.');
        }
    
    public function exportxlsx(Request $request) {
        $tanggal = Carbon::now()->format('dmY'); // Format: ddmmyyyy
        return Excel::download(new KunjunganExport, "Data-Kunjungan-{$tanggal}.xlsx");
    }
    
    public function exportPDF()
    {
        $tanggal = Carbon::now()->format('dmY');
        $kunjungan = Kunjungan::all();
    
        $pdf = Pdf::loadView('export-pdf', compact('kunjungan'))
                ->setPaper('a4', 'landscape');
    
        return $pdf->download("Data-Kunjungan-{$tanggal}.pdf");
    }
    

    public function unduhUndangan($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        if ($kunjungan->status_setujui !== 'Disetujui') {
            return redirect()->back()->with('error', 'Undangan hanya bisa diunduh jika permohonan telah disetujui.');
        }
    
        $tanggalHariIni = Carbon::now()->translatedFormat('d F Y');

        // Format No Surat
        $noSurat = "B-2128/PK" . $kunjungan->id;
    
        $pdf = Pdf::loadView('timkerja.kunjungan.undangan', compact('kunjungan', 'tanggalHariIni', 'noSurat'))
            ->setPaper('A4', 'portrait');
    
        return $pdf->download('Surat_Undangan_Kunjungan_' . $kunjungan->nama_lengkap . '.pdf');
    }

// Tampilkan data yang dihapus
    public function trash()
    {
        $kunjunganTerhapus = Kunjungan::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.kunjungan.trash', compact('kunjunganTerhapus'));
    }

    // Restore data
    public function restore($id)
    {
        $kunjungan = Kunjungan::onlyTrashed()->findOrFail($id);
        $kunjungan->restore();

        return redirect()->route('kunjungan.trash')->with('success', 'Data berhasil dikembalikan.');
    }


}
    
