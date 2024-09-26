<?php

namespace App\Http\Controllers;

use App\Models\Entitas;
use App\Models\EntitasDetail;
use Illuminate\Http\Request;

class EntitasDetailController extends Controller
{
    public function getById($id) {
        // Cari data entitas berdasarkan id
        $entitas = Entitas::find($id); 
    
        // Ambil entitas detail berdasarkan entitas_id atau buat instance baru
        $entitasDetail = EntitasDetail::where('entitas_id', $id)->first();
    
        if (!$entitasDetail) {
            $entitasDetail = new EntitasDetail();
            $entitasDetail->entitas_id = $id; // Set id dari entitas
        }
    
        // Return view ke path yang sesuai
        return view('admin.entitas.detail', compact('entitas', 'entitasDetail'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'deskripsi' => 'nullable|string',
            'varietas' => 'nullable|string',
            'potensi_hasil' => 'nullable|string',
            'keunggulan' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'agroekosistem' => 'nullable|string',
            'kandungan' => 'nullable|string',
            'syarat_tumbuh' => 'nullable|string',
        ]);
    
        // Cari entitas detail berdasarkan entitas_id
        $entitasDetail = EntitasDetail::where('entitas_id', $id)->firstOrFail();

        $entitasDetail->update($request->except('_token'));

        return back()->with('success', 'Data berhasil diperbarui');
    }
    
    
    // public function getAll() {
    //     $entitas_detail = EntitasDetail::get();
    //     if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
    //     return response()->json(['status' => 'success', 'payload' => $entitas_detail], 200);
    // }

    // public function getById($id) {
    //     $entitas_detail = EntitasDetail::find($id);
    //     if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
    //     return response()->json(['status' => 'success', 'payload' => $entitas_detail], 200);
    // }

    // public function update(Request $request, $id) {
    //     $entitas_detail = EntitasDetail::find($id);
    //     if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
    //     if ($entitas_detail->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $entitas_detail], 200);
    //     return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    // }

    // public function destroy($id) {
    //     $entitas_detail = EntitasDetail::find($id);
    //     if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
    //     if ($entitas_detail->delete()) return response()->json(['status' => 'deleted'], 204);
    //     return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    // }
}
