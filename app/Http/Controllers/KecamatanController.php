<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function getAll() {
        $kecamatan = Kecamatan::get();
        if (!$kecamatan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kecamatan], 200);
    }

    public function getById($id) {
        $kecamatan = Kecamatan::find($id);
        if (!$kecamatan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $kecamatan], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama kecamatan harus diisi',
            'nama.string' => 'nama kecamatan harus berupa string',
            'nama.max' => 'nama kecamatan maksimal 255 karakter',
        ]);
        $kecamatan = Kecamatan::create($request->except('_token'));
        if (!$kecamatan) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $kecamatan], 201);
    }

    public function update(Request $request, $id) {
        $kecamatan = Kecamatan::find($id);
        if (!$kecamatan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama kecamatan harus diisi',
            'nama.string' => 'nama kecamatan harus berupa string',
            'nama.max' => 'nama kecamatan maksimal 255 karakter',
        ]);
        if ($kecamatan->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $kecamatan], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $kecamatan = Kecamatan::find($id);
        if (!$kecamatan) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        if (count($kecamatan->alamat)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($kecamatan->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
