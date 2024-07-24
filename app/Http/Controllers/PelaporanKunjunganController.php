<?php

namespace App\Http\Controllers;

use App\Models\PelaporanKunjungan;
use Illuminate\Http\Request;

class PelaporanKunjunganController extends Controller
{
    public function getAll() {
        $pelaporan_kunjungan = PelaporanKunjungan::get();
        if (!$pelaporan_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $pelaporan_kunjungan], 200);
    }

    public function getById($id) {
        $pelaporan_kunjungan = PelaporanKunjungan::find($id);
        if (!$pelaporan_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $pelaporan_kunjungan,
        ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required'
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'tipe data tidak sesuai',
            'email.max' => 'email terlalu panjang',
            'tanggal.required' => 'tanggal tidak boleh kosong',
            'tanggal.date' => 'tipe data tidak sesuai',
            'keterangan.required' => 'keterangan tidak boleh kosong',
        ]);
        $pelaporan_kunjungan = PelaporanKunjungan::create($request->except('_token'));
        if (!$pelaporan_kunjungan) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $pelaporan_kunjungan,
        ], 201);
    }

    public function update(Request $request, $id) {
        $pelaporan_kunjungan = PelaporanKunjungan::find($id);
        if (!$pelaporan_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required'
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'tipe data tidak sesuai',
            'email.max' => 'email terlalu panjang',
            'tanggal.required' => 'tanggal tidak boleh kosong',
            'tanggal.date' => 'tipe data tidak sesuai',
            'keterangan.required' => 'keterangan tidak boleh kosong',
        ]);
        if ($pelaporan_kunjungan->update($request->except('_token'))) {
            return response()->json([
                'status' => 'updated',
                'payload' => $pelaporan_kunjungan,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $pelaporan_kunjungan = PelaporanKunjungan::find($id);
        if (!$pelaporan_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if ($pelaporan_kunjungan->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
