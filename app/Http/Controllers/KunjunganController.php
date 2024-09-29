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
use Illuminate\Contracts\Pipeline\Hub;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KunjunganController extends Controller
{
    public function getAll() {
        $kunjungan = Kunjungan::get();
        // if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        // return response()->json(['status' => 'success', 'payload' => $kunjungan], 200);
        if ($kunjungan->isEmpty()) {
            return back()->with('error', 'Tidak ada data yang ditemukan.');
        }
        return view('admin.kunjungan.index', compact('kunjungan'));
    }

    public function getById($id) {
        $kunjungan = Kunjungan::find($id);
        // if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        // return response()->json(['status' => 'success', 'payload' => $kunjungan], 200);
        $kunjungan->tanggal_kunjungan = Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y');

        if (!$kunjungan) {
            return back()->with('error', 'Data kunjungan tidak ditemukan.');
        }
        return view('admin.kunjungan.show', compact('kunjungan'));
    }

    public function store(Request $request)
{
    // Validasi input dari pengguna
    $request->validate([
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
        'tanggal_kunjungan' => 'required|date',
        'tujuan_kunjungan' => 'required|string',
        'url_foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'url_foto_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

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


    // public function store(Request $request) 
    // {
    //     dd($request->all()); // Ini akan menampilkan semua data yang diterima dari form
    // }
    // {
    //     $request->validate([
    //         'nama_lengkap' => 'required|string|max:255',
    //         'no_hp' => 'required|string|max:15',
    //         'usia_id' => 'required|string',
    //         'jenis_kelamin_id' => 'required|string',
    //         'asal_instansi' => 'required|string|max:255',
    //         'pekerjaan_id' => 'required|string',
    //         'kategori_informasi_id' => 'required|string',
    //         'pilihan_pertanian_id' => 'nullable|string',
    //         'pendidikan_id' => 'required|string',
    //         'jenis_pengunjung_id' => 'required|string',
    //         'jumlah_orang' => 'nullable|integer|min:2',
    //         'tanggal_kunjungan' => 'required|date',
    //         'tujuan_kunjungan' => 'required|string',
    //         'url_foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'url_foto_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);
    
    //     $data = $request->except('_token');
    
    //     // Menyimpan foto KTP
    //     if ($request->hasFile('url_foto_ktp')) {
    //         $data['url_foto_ktp'] = $request->file('url_foto_ktp')->store('kunjungan/fotoktp');
    //     }
    
    //     // Menyimpan foto selfie
    //     if ($request->hasFile('url_foto_selfie')) {
    //         $data['url_foto_selfie'] = $request->file('url_foto_selfie')->store('kunjungan/fotoselfie');
    //     }
    
    //     $kunjungan = Kunjungan::create($data);
    
    //     if ($kunjungan) {
    //         return back()->with('success', 'Permohonan kunjungan berhasil dikirim!');
    //     } else {
    //         return back()->with('error', 'Gagal mengirim permohonan kunjungan.');
    //     }
    // }
    

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
}
    
