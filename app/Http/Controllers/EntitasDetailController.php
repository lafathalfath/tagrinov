<?php

namespace App\Http\Controllers;

use App\Models\EntitasDetail;
use Illuminate\Http\Request;

class EntitasDetailController extends Controller
{
    public function getAll() {
        $entitas_detail = EntitasDetail::get();
        if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $entitas_detail], 200);
    }

    public function getById($id) {
        $entitas_detail = EntitasDetail::find($id);
        if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        return response()->json(['status' => 'success', 'payload' => $entitas_detail], 200);
    }

    public function store(Request $request) {
        $entitas_detail = EntitasDetail::create($request->except('_token'));
        if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
        return response()->json(['status' => 'created', 'payload' => $entitas_detail], 201);
    }

    public function update(Request $request, $id) {
        $entitas_detail = EntitasDetail::find($id);
        if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if ($entitas_detail->update($request->except('_token'))) return response()->json(['status' => 'updated', 'payload' => $entitas_detail], 200);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }

    public function destroy($id) {
        $entitas_detail = EntitasDetail::find($id);
        if (!$entitas_detail) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        if ($entitas_detail->delete()) return response()->json(['status' => 'deleted'], 204);
        return response()->json(['status' => 'error', 'message' => 'internal server error'], 500);
    }
}
