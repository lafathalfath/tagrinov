<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function getAll() {
        $kota = Kota::get();
        if (!$kota) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kota], 200);
    }

    public function getById($id) {
        $kota = Kota::find($id);
        if (!$kota) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kota], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama kota harus diisi',
            'nama.string' => 'nama kota harus berupa string',
            'nama.max' => 'nama kota maksimal 255 karakter',
        ]);
        $kota = Kota::create($request->except('_token'));
        if (!$kota) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $kota], 201);
    }

    public function update(Request $request, $id) {
        $kota = Kota::find($id);
        if (!$kota) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama kota harus diisi',
            'nama.string' => 'nama kota harus berupa string',
            'nama.max' => 'nama kota maksimal 255 karakter',
        ]);
        if ($kota->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $kota], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $kota = Kota::find($id);
        if (!$kota) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        if (count($kota->kecamatan)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($kota->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
