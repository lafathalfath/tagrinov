<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function getAll(Request $request) {
        $search = $request->input('search');
        if ($search) {
            $jenis = Jenis::where('nama', 'like', '%' . $search . '%')->paginate(10);
        } else {
            $jenis = Jenis::paginate(10);
        }
        return view('admin.jenis.index', compact('jenis'));
        // if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        // return response()->json(['status' => 'success', 'payload' => $jenis], 200);
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
        // return response()->json([
        //     'status' => 'created',
        //     'payload' => $jenis,
        // ], 201);
        return back()->with('success', 'Jenis berhasil ditambahkan!');
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
        $jenis->update([
            'nama' => $request->nama
        ]);
        //     return response()->json([
        //         'status' => 'updated',
        //         'payload' => $jenis,
        //     ], 200);
        // }
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        return back()->with('success', 'Jenis berhasil diedit!');
    }

    public function destroy($id) {
        $jenis = Jenis::find($id);
        if (!$jenis) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if (count($jenis->entitas)) return response()->json(['status' => 'error', 'message' => 'cannot delete parent row'], 403);
        // if ($jenis->delete()) return response()->json(['status' => 'deleted'], 204);
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        $jenis->delete();
        return back()->with('success', 'Jenis berhasil dihapus!');
    }
}
