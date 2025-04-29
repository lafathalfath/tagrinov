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
    
        // Jika ada input search, lakukan pencarian di nama_lengkap, tanggal_kunjungan, asal_instansi
        if ($search) {
            $query->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('tanggal_kunjungan', 'like', "%$search%")
                  ->orWhere('asal_instansi', 'like', "%$search%");
        }
    
        // Ambil data kunjungan
        $kunjungan = $query->get();
    
        App::setLocale('id'); // Set bahasa ke Indonesia

        $kunjungan = Kunjungan::all()->each(function ($item) {
            $item->tanggal_kunjungan = Carbon::parse($item->tanggal_kunjungan)->translatedFormat('l, d F Y');
        });
    
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
                Rule::unique('kunjungan', 'tanggal_kunjungan') 
            ],
            'tujuan_kunjungan' => 'required|string',
            'url_foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'url_foto_selfie' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ], [
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
            return redirect()->back()->with('success', 'Permohonan kunjungan berhasil dikirim, Silahkan Tunggu informasi selajutnya akan dikirim melalui WhatsApps!');
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

    public function destroy($id) {
        $kunjungan = Kunjungan::find($id);
        // if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        // if ($kunjungan->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        // return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        if (!$kunjungan) {
            return back()->with('error', 'Data kunjungan tidak ditemukan.');
        }
        if ($kunjungan->url_foto_ktp) {
            Storage::disk('public')->delete($kunjungan->url_foto_ktp);
        }

        if ($kunjungan->url_foto_selfie) {
            Storage::disk('public')->delete($kunjungan->url_foto_selfie);
        }
        if ($kunjungan->delete()) {
            return back()->with('success', 'Data kunjungan berhasil dihapus.');
        }
        return back()->with('error', 'Gagal menghapus data kunjungan.');
    }

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

    public function approve($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_setujui = 'Disetujui';
        $kunjungan->save();
    
        return back()->with('success', 'Permohonan kunjungan telah disetujui dan telah ditampilkan pada Kalendar Events.');
    }
    
    public function reject($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_setujui = 'Ditolak';
        $kunjungan->save();
    
        return back()->with('success', 'Permohonan kunjungan telah ditolak.');
    }
    
    public function cancelApproval($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_setujui = 'Pending';
        $kunjungan->save();
    
        return back()->with('success', 'Persetujuan kunjungan ini telah dibatalkan.');
    }
    public function cancelRejection($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_setujui = 'pending';
        $kunjungan->save();
    
        return back()->with('success', 'Penolakan kunjungan ini telah dibatalkan.');
    }
    
    public function exportxlsx(Request $request) {
        $tanggal = Carbon::now()->format('dmY'); // Format: ddmmyyyy
        return Excel::download(new KunjunganExport, "Data-Kunjungan-{$tanggal}.xlsx");
    }
    
    public function exportPDF()
    {
        $tanggal = Carbon::now()->format('dmY'); // Format: ddmmyyyy
        $kunjungan = Kunjungan::all(); // Ambil semua data kunjungan
    
        $pdf = Pdf::loadView('admin.kunjungan.export-pdf', compact('kunjungan'))
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
    
        $pdf = Pdf::loadView('admin.kunjungan.undangan', compact('kunjungan', 'tanggalHariIni', 'noSurat'))
            ->setPaper('A4', 'portrait');
    
        return $pdf->download('Surat_Undangan_Kunjungan_' . $kunjungan->nama_lengkap . '.pdf');
    }
}
    
