<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function getAll() {
        $jenis = Jenis::get();
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $jenis], 200);
    }

    public function getById($id) {
        $jenis = Jenis::find($id);
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $jenis,
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
        $jenis = Jenis::create(['nama' => $request->nama]);
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $jenis,
        ], 201);
    }

    public function update(Request $request, $id) {
        $jenis = Jenis::find($id);
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        if ($jenis->update($request->nama)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $jenis,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $jenis = Jenis::find($id);
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($jenis->entitas)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($jenis->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
