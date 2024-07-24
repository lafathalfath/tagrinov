<?php

namespace App\Http\Controllers;

use App\Models\KategoriKunjungan;
use Illuminate\Http\Request;

class KategoriKunjunganController extends Controller
{
    public function getAll() {
        $kategori_kunjungan = KategoriKunjungan::get();
        if (!$kategori_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $kategori_kunjungan], 200);
    }

    public function getById($id) {
        $kategori_kunjungan = KategoriKunjungan::find($id);
        if (!$kategori_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $kategori_kunjungan,
        ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        $kategori_kunjungan = KategoriKunjungan::create(['nama' => $request->nama]);
        if (!$kategori_kunjungan) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $kategori_kunjungan,
        ], 201);
    }

    public function update(Request $request, $id) {
        $kategori_kunjungan = KategoriKunjungan::find($id);
        if (!$kategori_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        if ($kategori_kunjungan->update($request->nama)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $kategori_kunjungan,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $kategori_kunjungan = KategoriKunjungan::find($id);
        if (!$kategori_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if ($kategori_kunjungan->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
