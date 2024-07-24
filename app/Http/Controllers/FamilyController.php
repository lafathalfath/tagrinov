<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function getAll() {
        $family = Family::get();
        if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $family], 200);
    }

    public function getById($id) {
        $family = Family::find($id);
        if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $family,
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
        $family = Family::create(['nama' => $request->nama]);
        if (!$family) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return response()->json([
            'status' => 'created',
            'payload' => $family,
        ], 201);
    }

    public function update(Request $request, $id) {
        $family = Family::find($id);
        if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang'
        ]);
        if ($family->update($request->nama)) {
            return response()->json([
                'status' => 'updated',
                'payload' => $family,
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }

    public function destroy($id) {
        $family = Family::find($id);
        if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if ($family->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
    }
}
