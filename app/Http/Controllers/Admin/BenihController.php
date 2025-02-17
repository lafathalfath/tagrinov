<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benih;
use Illuminate\Support\Facades\Storage;     

class BenihController extends Controller
{
    public function getAll(Request $request)
    {
        $search = $request->input('search');
    
        $benih = Benih::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%$search%");
            })
            ->get();

        $benih = Benih::paginate(10);
    
        return view('admin.benih.index', compact('benih'));
    }

    public function getById($id)
    {
        $benih = Benih::findOrFail($id);
        return view('admin.benih.detail', compact('benih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_gambar' => 'required|array|min:1|max:3', // Wajib minimal 1, maksimal 3 gambar
            'url_gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Per gambar max 2MB
        ]);
    
        $gambarPaths = [];
    
        if ($request->hasFile('url_gambar')) {
            foreach ($request->file('url_gambar') as $gambar) {
                if ($gambar) {
                    $path = $gambar->store('benih', 'public'); // Simpan di storage/app/public/benih
                    $gambarPaths[] = $path;
                }
            }
        }
    
        Benih::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'netto' => $request->netto,
            'lokasi' => $request->lokasi,
            'url_gambar' => json_encode($gambarPaths), // Simpan dalam bentuk JSON
        ]);
    
        return back()->with('success', 'Benih berhasil ditambahkan!');
    }
    

    public function update(Request $request, $id)
    {
        $benih = Benih::findOrFail($id);
    
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'netto' => 'required|numeric|min:0',
            'url_gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Jika ada gambar yang akan dihapus
        if ($request->has('hapus_gambar')) {
            $gambarLama = json_decode($benih->url_gambar, true);
            foreach ($request->hapus_gambar as $gambar) {
                if (($key = array_search($gambar, $gambarLama)) !== false) {
                    unset($gambarLama[$key]);
                    Storage::delete('public/' . $gambar); // Hapus dari storage
                }
            }
            $benih->url_gambar = json_encode(array_values($gambarLama));
        }
    
        // Jika ada gambar baru diunggah
        if ($request->hasFile('url_gambar')) {
            $gambarBaru = [];
            foreach ($request->file('url_gambar') as $file) {
                $path = $file->store('benih', 'public'); // Simpan ke storage/app/public/benih
                $gambarBaru[] = $path;
            }
    
            // Gabungkan dengan gambar lama yang tidak dihapus
            $gambarLama = json_decode($benih->url_gambar, true) ?? [];
            $benih->url_gambar = json_encode(array_merge($gambarLama, $gambarBaru));
        }
    
        // Update data lainnya
        $benih->update([
            'nama' => $validatedData['nama'],
            'deskripsi' => $validatedData['deskripsi'],
            'stok' => $validatedData['stok'],
            'harga' => $validatedData['harga'],
            'netto' => $validatedData['netto'],
            'lokasi' => $validatedData['lokasi'],
            'url_gambar' => $benih->url_gambar, // Pastikan ini string JSON
        ]);
    
        return back()->with('success', 'Benih berhasil diperbarui!');
    }
    
    

    public function destroy($id)
    {
        Benih::findOrFail($id)->delete();

        return back()->with('success', 'Benih berhasil dihapus.');
    }
}
