<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function getAll(Request $request) {
        $search = $request->input('search');
        if ($search) {
            $family = Family::where('nama', 'like', '%' . $search . '%')->paginate(10);
        } else {
            $family = Family::paginate(10);
        }
        return view('admin.family.index', compact('family'));
        // $family = Family::get();
        // if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        // return response()->json(['status' => 'success', 'payload' => $family], 200);
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
        // return response()->json([
        //     'status' => 'created',
        //     'payload' => $family,
        // ], 201);
        return back()->with('success', 'Family berhasil ditambahkan!');
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
        $family->update([
            'nama' => $request->nama
        ]);
            // return response()->json([
            //     'status' => 'updated',
            //     'payload' => $family,
            // ], 200);
        // }
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return back()->with('success', 'Family berhasil diedit!');
    }

    public function destroy($id) {
        $family = Family::find($id);
        if (!$family) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($family->entitas)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        // if ($family->delete()) return response()->json(['status' => 'deleted'], 204);
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        $family->delete();
        return back()->with('success', 'Family berhasil dihapus.');
    }
}
