<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function getAll() {
        $provinsi = Provinsi::get();
        if (!$provinsi) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $provinsi], 200);
    }

    public function getById($id) {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $provinsi], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama provinsi harus diisi',
            'nama.string' => 'nama provinsi harus berupa string',
            'nama.max' => 'nama provinsi maksimal 255 karakter',
        ]);
        $provinsi = Provinsi::create($request->except('_token'));
        if (!$provinsi) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $provinsi], 201);
    }

    public function update(Request $request, $id) {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama provinsi harus diisi',
            'nama.string' => 'nama provinsi harus berupa string',
            'nama.max' => 'nama provinsi maksimal 255 karakter',
        ]);
        if ($provinsi->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $provinsi], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        if (count($provinsi->kota)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($provinsi->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
