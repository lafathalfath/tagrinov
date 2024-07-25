<?php

namespace App\Http\Controllers;

use App\Models\HariKunjungan;
use Illuminate\Http\Request;

class HariKunjunganController extends Controller
{
    public function getAll() {
        $hari_kunjungan = HariKunjungan::get();
        if (!$hari_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $hari_kunjungan], 200);
    }

    public function getById($id) {
        $hari_kunjungan = HariKunjungan::find($id);
        if (!$hari_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $hari_kunjungan,
        ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'hari' => 'required|date',
        ], [
            'hari.required' => 'hari tidak boleh kosong',
            'hari.date' => 'tipe data tidak sesuai',
        ]);
        $hari_kunjungan = HariKunjungan::create(['hari' => $request->hari]);
        if (!$hari_kunjungan) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $hari_kunjungan,
        ], 201);
    }

    public function update(Request $request, $id) {
        $hari_kunjungan = HariKunjungan::find($id);
        if (!$hari_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'hari' => 'required|date',
        ], [
            'hari.required' => 'hari tidak boleh kosong',
            'hari.date' => 'tipe data tidak sesuai',
        ]);
        if ($hari_kunjungan->update($request->hari)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $hari_kunjungan,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $hari_kunjungan = HariKunjungan::find($id);
        if (!$hari_kunjungan) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($hari_kunjungan->kunjungan)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($hari_kunjungan->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
