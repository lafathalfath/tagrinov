<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benih;
use Illuminate\Support\Facades\Crypt;

class StokBenihController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil data benih dengan pencarian jika ada
        $benih = Benih::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%$search%");
            })
            ->get();
        $benih = Benih::paginate(10);
        return view('guest.stokbenih.index', compact('benih'));
    }

    public function detail($id)
    {
        try {
            // Dekripsi ID sebelum digunakan
            $id = Crypt::decryptString($id);

            // Cari benih berdasarkan ID
            $benih = Benih::findOrFail($id);

            return view('guest.stokbenih.detail', compact('benih'));
        } catch (\Exception $e) {
            // Jika dekripsi gagal atau ID tidak ditemukan, tampilkan halaman 404
            return abort(404);
        }
    }
}
