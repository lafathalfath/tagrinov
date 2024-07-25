<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function getAll() {
        $kunjungan = Kunjungan::get();
        if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kunjungan], 200);
    }

    public function getById($id) {
        $kunjungan = Kunjungan::find($id);
        if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kunjungan], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'kategori_kunjungan' => 'required|numeric', //FK
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email',
            'alamat' => 'required|numeric', //FK
            'hari_kunjungan' => 'required|numeric', //FK
            'waktu_kunjungan' => 'required|numeric', //FK
        ], [
            'ketegori_kunjungan.required' => 'kategori kunjungan tidak boleh kosong',
            'ketegori_kunjungan.numeric' => 'tipe data tidak sesuai',
            'nama.required' => 'nama harus diisi',
            'nama.string' => 'nama harus berupa string',
            'nama.max' => 'nama maksimal 255 karakter',
            'email.required' => 'email harus diisi',
            'email.string' => 'email tidak sesuai',
            'alamat.required' => 'alamat tidak boleh kosong',
            'alamat.numeric' => 'tipe data tidak sesuai',
            'hari_kunjungan.required' => 'hari kunjungan tidak boleh kosong',
            'hari_kunjungan.numeric' => 'tipe data tidak sesuai',
            'waktu_kunjungan.required' => 'waktu kunjungan tidak boleh kosong',
            'waktu_kunjungan.numeric' => 'tipe data tidak sesuai',
        ]);
        $kunjungan = Kunjungan::create($request->except('_token'));
        if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $kunjungan], 201);
    }

    public function update(Request $request, $id) {
        $kunjungan = Kunjungan::find($id);
        if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        
        $request->validate([
            'kategori_kunjungan' => 'required|numeric', //FK
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email',
            'alamat' => 'required|numeric', //FK
            'hari_kunjungan' => 'required|numeric', //FK
            'waktu_kunjungan' => 'required|numeric', //FK
        ], [
            'ketegori_kunjungan.required' => 'kategori kunjungan tidak boleh kosong',
            'ketegori_kunjungan.numeric' => 'tipe data tidak sesuai',
            'nama.required' => 'nama harus diisi',
            'nama.string' => 'nama harus berupa string',
            'nama.max' => 'nama maksimal 255 karakter',
            'email.required' => 'email harus diisi',
            'email.string' => 'email tidak sesuai',
            'alamat.required' => 'alamat tidak boleh kosong',
            'alamat.numeric' => 'tipe data tidak sesuai',
            'hari_kunjungan.required' => 'hari kunjungan tidak boleh kosong',
            'hari_kunjungan.numeric' => 'tipe data tidak sesuai',
            'waktu_kunjungan.required' => 'waktu kunjungan tidak boleh kosong',
            'waktu_kunjungan.numeric' => 'tipe data tidak sesuai',
        ]);
        if ($kunjungan->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $kunjungan], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $kunjungan = Kunjungan::find($id);
        if (!$kunjungan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        if ($kunjungan->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
