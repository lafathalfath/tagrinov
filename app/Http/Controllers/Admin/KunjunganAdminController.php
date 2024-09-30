<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganAdminController extends Controller
{
    // Menampilkan daftar kunjungan
    public function index()
    {
        $kunjungan = Kunjungan::all(); // Mengambil semua data kunjungan
        return view('admin.kunjungan.index', compact('kunjungan'));
    }

    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'namaLengkap' => 'required|string|max:255',
        'noHp' => 'required|string',
        'usia' => 'required',
        'jenisKelamin' => 'required',
        'asalInstansi' => 'required|string',
        'pekerjaan' => 'required|string',
        'kategoriInformasi' => 'required|string',
        'pendidikanTerakhir' => 'required|string',
        'jenisPengunjung' => 'required|string',
        'jumlahOrang' => 'nullable|integer|min:2',
        'tanggalKunjungan' => 'required|date',
        'tujuanKunjungan' => 'required|string',
        'fotoKTP' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'fotoSelfie' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Proses upload foto KTP dan selfie
    if ($request->hasFile('fotoKTP')) {
        $ktpPath = $request->file('fotoKTP')->store('ktp', 'public');
        $validatedData['fotoKTP'] = $ktpPath;
    }

    if ($request->hasFile('fotoSelfie')) {
        $selfiePath = $request->file('fotoSelfie')->store('selfie', 'public');
        $validatedData['fotoSelfie'] = $selfiePath;
    }

    // Simpan data kunjungan
    Kunjungan::create($validatedData);

    // Redirect ke halaman yang diinginkan dengan pesan sukses
    return back()->with('success', 'Data kunjungan berhasil disimpan.');
}


    // Menampilkan detail kunjungan
    public function show($id)
    {
        $kunjungan = Kunjungan::findOrFail($id); // Mengambil data kunjungan berdasarkan ID
        return view('admin.kunjungan.show', compact('kunjungan'));
    }

    // Menghapus kunjungan
    public function destroy($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->delete();

        return back()->with('success', 'Data kunjungan berhasil dihapus.');
    }
};
