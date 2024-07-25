<?php

namespace App\Http\Controllers;

use App\Models\JenisPengunjung;
use Illuminate\Http\Request;

class JenisPengunjungController extends Controller
{
    public function getAll() {
        $jenis_pengunjung = JenisPengunjung::get();
        if (!$jenis_pengunjung) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $jenis_pengunjung], 200);
    }

    public function getById($id) {
        $jenis_pengunjung = JenisPengunjung::find($id);
        if (!$jenis_pengunjung) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $jenis_pengunjung,
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
        $jenis_pengunjung = JenisPengunjung::create(['nama' => $request->nama]);
        if (!$jenis_pengunjung) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $jenis_pengunjung,
        ], 201);
    }

    public function update(Request $request, $id) {
        $jenis_pengunjung = JenisPengunjung::find($id);
        if (!$jenis_pengunjung) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        if ($jenis_pengunjung->update($request->nama)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $jenis_pengunjung,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $jenis_pengunjung = JenisPengunjung::find($id);
        if (!$jenis_pengunjung) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($jenis_pengunjung->kunjungan)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($jenis_pengunjung->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
