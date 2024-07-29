<?php

namespace App\Http\Controllers;

use App\Models\WaktuKunjungan;
use Illuminate\Http\Request;

class WaktuKunjunganController extends Controller
{
    public function getAll() {
        $waktu_kunjungan = WaktuKunjungan::get();
        if (!$waktu_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $waktu_kunjungan], 200);
    }

    public function getById($id) {
        $waktu_kunjungan = WaktuKunjungan::find($id);
        if (!$waktu_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $waktu_kunjungan,
        ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'waktu' => 'required|time',
        ], [
            'waktu.required' => 'waktu tidak boleh kosong',
            'waktu.time' => 'tipe data tidak sesuai',
        ]);
        $waktu_kunjungan = WaktuKunjungan::create(['waktu' => $request->waktu]);
        if (!$waktu_kunjungan) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $waktu_kunjungan,
        ], 201);
    }

    public function update(Request $request, $id) {
        $waktu_kunjungan = WaktuKunjungan::find($id);
        if (!$waktu_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'waktu' => 'required|time',
        ], [
            'waktu.required' => 'waktu tidak boleh kosong',
            'waktu.time' => 'tipe data tidak sesuai',
        ]);
        if ($waktu_kunjungan->update($request->waktu)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $waktu_kunjungan,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $waktu_kunjungan = WaktuKunjungan::find($id);
        if (!$waktu_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($waktu_kunjungan->kunjungan)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($waktu_kunjungan->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
