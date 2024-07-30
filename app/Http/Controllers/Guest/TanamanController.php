<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Entitas;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index(Request $request) {
        $tanaman = Entitas::where('kategori_id', 1)->get();
        if ($request->kategori) {
            $tanaman = Entitas::where('kategori_id', $request->kategori)->get();
        }
        return view('guest.tanaman.tanaman', ['tanaman' => $tanaman]);
    }

    public function detail() { //$id
        $id = 1;
        $tanaman = Entitas::find($id);
        return view('guest.tanaman.detail', ['tanaman' => $tanaman]);
    }

}
