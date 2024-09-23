<?php

namespace App\Http\Controllers;

use App\Models\Entitas;
use App\Models\EntitasDetail;
use App\Models\Family;
use App\Models\Jenis;
use App\Models\Kategori;
use Illuminate\Http\Request;

class EntitasController extends Controller
{
    public function getAll(Request $request) {
        // $entitas = Entitas::get();
        // if (!$entitas) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        // return response()->json([
        //     'status' => 'success',
        //     'payload' => $entitas,
        // ], 200);
        $query = Entitas::query();

        // Pencarian berdasarkan nama entitas
        $search = $request->input('search');
        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }
    
        // Filter berdasarkan family_id, jenis_id, kategori_id
        if ($request->filled('family_id')) {
            $query->where('family_id', $request->family_id);
        }
    
        if ($request->filled('jenis_id')) {
            $query->where('jenis_id', $request->jenis_id);
        }
    
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Paginate data dan appends filter params
        $entitas = $query->paginate(10)->appends([
            'search' => $search,
            'family_id' => $request->family_id,
            'jenis_id' => $request->jenis_id,
            'kategori_id' => $request->kategori_id,
        ]);

        $family = Family::all();
        $jenis = Jenis::all();
        $kategori = Kategori::all();
    
        return view('admin.entitas.index', compact('entitas', 'family', 'jenis', 'kategori'));
    }

    public function getById($id) {
        $entitas = Entitas::find($id);
        if (!$entitas) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json([
            'status' => 'success',
            'payload' => $entitas,
        ], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255|unique:entitas',
            'nama_latin' => 'required|string|max:255|unique:entitas',
            'nama_daerah' => 'required|string|max:255|unique:entitas',
            'family_id' => 'required|numeric',
            'jenis_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama_latin.required' => 'Nama latin tidak boleh kosong',
            'nama_daerah.required' => 'Nama daerah tidak boleh kosong',
            'family_id.required' => 'Family tidak boleh kosong',
            'jenis_id.required' => 'Jenis tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama_latin.string' => 'tipe data tidak sesuai',
            'nama_daerah.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang',
            'nama_latin.max' => 'nama latin terlalu panjang',
            'nama_daerah.max' => 'nama daerah terlalu panjang',
            'nama.unique' => 'nama sudah ada',
            'nama_latin.unique' => 'nama latin sudah ada',
            'nama_daerah.unique' => 'nama daerah sudah ada',
            'family_id.numeric' => 'tipe data tidak sesuai',
            'jenis_id.numeric' => 'tipe data tidak sesuai',
            'kategori_id.numeric' => 'tipe data tidak sesuai',
        ]);
        $entitas = Entitas::create($request->except('_token'));
        $entitas_detail = EntitasDetail::create(['entitas_id' => $entitas->id]);
        // if (!$entitas && !$entitas_detail) return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        // return response()->json([
        //     'status' => 'created',
        //     'payload' => $entitas,
        // ], 201);
        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $entitas = Entitas::find($id);
        if (!$entitas) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        $request->validate([
            'nama' => 'required|string|max:255|unique:entitas',
            'nama_latin' => 'required|string|max:255|unique:entitas',
            'nama_daerah' => 'required|string|max:255|unique:entitas',
            'family_id' => 'required|numeric',
            'jenis_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama_latin.required' => 'Nama latin tidak boleh kosong',
            'nama_daerah.required' => 'Nama daerah tidak boleh kosong',
            'family_id.required' => 'Family tidak boleh kosong',
            'jenis_id.required' => 'Jenis tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'tipe data tidak sesuai',
            'nama_latin.string' => 'tipe data tidak sesuai',
            'nama_daerah.string' => 'tipe data tidak sesuai',
            'nama.max' => 'nama terlalu panjang',
            'nama_latin.max' => 'nama latin terlalu panjang',
            'nama_daerah.max' => 'nama daerah terlalu panjang',
            'nama.unique' => 'nama sudah ada',
            'nama_latin.unique' => 'nama latin sudah ada',
            'nama_daerah.unique' => 'nama daerah sudah ada',
            'family_id.numeric' => 'tipe data tidak sesuai',
            'jenis_id.numeric' => 'tipe data tidak sesuai',
            'kategori_id.numeric' => 'tipe data tidak sesuai',
        ]);
        // if ($entitas->update($request->except('_token'))) {
        //     return response()->json([
        //         'status' => 'success',
        //         'payload' => $entitas,
        //     ], 200);
        // }
        // // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        $entitas->update($request->except('_token'));
        return back()->with('success', 'Data updated successfully');
    }

    public function destroy($id) {
        $entitas = Entitas::find($id);
        if (!$entitas) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        // if ($entitas->delete()) {
        //     return response()->json(['status' => 'deleted'], 204);
        // }
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        $entitas->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
