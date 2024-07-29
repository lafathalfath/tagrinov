<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function getAll() {
        $kategori = Kategori::get();
        if (!$kategori) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $kategori], 200);
    }

    public function getById($id) {
        $kategori = Kategori::find($id);
        if (!$kategori) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $kategori,
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
        $kategori = Kategori::create(['nama' => $request->nama]);
        if (!$kategori) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $kategori,
        ], 201);
    }

    public function update(Request $request, $id) {
        $kategori = Kategori::find($id);
        if (!$kategori) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        if ($kategori->update($request->nama)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $kategori,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $kategori = Kategori::find($id);
        if (!$kategori) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($kategori->entitas)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        if ($kategori->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
