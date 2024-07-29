<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function getAll() {
        $alamat = Alamat::get();
        if (!$alamat) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $alamat], 200);
    }

    public function getById($id) {
        $alamat = Alamat::find($id);
        if (!$alamat) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        return response()->json(['status' => 'success', 'payload' => $alamat], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama alamat harus diisi',
            'nama.string' => 'nama alamat harus berupa string',
            'nama.max' => 'nama alamat maksimal 255 karakter',
        ]);
        $alamat = Alamat::create($request->except('_token'));
        if (!$alamat) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $alamat], 201);
    }

    public function update(Request $request, $id) {
        $alamat = Alamat::find($id);
        if (!$alamat) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        $request->validate([
            'nama' => 'required|string|max:255'
        ], [
            'nama.required' => 'nama alamat harus diisi',
            'nama.string' => 'nama alamat harus berupa string',
            'nama.max' => 'nama alamat maksimal 255 karakter',
        ]);
        if ($alamat->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $alamat], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $alamat = Alamat::find($id);
        if (!$alamat) return response()->json(['status' => 'error', 'message' => 'cannot found any data'], 404);
        if (count($alamat->kunjungan)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($alamat->delete()) return response()->json(['status' => 'deleted', 'message' => 'data deleted successfully'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
