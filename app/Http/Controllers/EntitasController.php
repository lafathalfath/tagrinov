<?php

namespace App\Http\Controllers;

use App\Models\Entitas;
use App\Models\EntitasDetail;
use App\Models\Family;
use App\Models\Jenis;
use App\Models\Kategori;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
            'url_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama_latin.required' => 'Nama latin tidak boleh kosong',
            'nama_daerah.required' => 'Nama daerah tidak boleh kosong',
            'family_id.required' => 'Family tidak boleh kosong',
            'jenis_id.required' => 'Jenis tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'Tipe data tidak sesuai',
            'nama_latin.string' => 'Tipe data tidak sesuai',
            'nama_daerah.string' => 'Tipe data tidak sesuai',
            'nama.max' => 'Nama terlalu panjang',
            'nama_latin.max' => 'Nama latin terlalu panjang',
            'nama_daerah.max' => 'Nama daerah terlalu panjang',
            'nama.unique' => 'Nama sudah ada',
            'nama_latin.unique' => 'Nama latin sudah ada',
            'nama_daerah.unique' => 'Nama daerah sudah ada',
            'family_id.numeric' => 'Tipe data tidak sesuai',
            'jenis_id.numeric' => 'Tipe data tidak sesuai',
            'kategori_id.numeric' => 'Tipe data tidak sesuai',
            'url_gambar.image' => 'File harus berupa gambar',
            'url_gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'url_gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    
        $data = $request->except('_token');

        // Simpan data entitas terlebih dahulu
        $entitas = Entitas::create($data);
    
        // Handle gambar jika diunggah
        if ($request->hasFile('url_gambar')) {
            $this->handleImageUpload($request, $entitas->id);
        }
    
        // Buat detail entitas
        EntitasDetail::create(['entitas_id' => $entitas->id]);
    
        return back()->with('success', 'Entitas berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $entitas = Entitas::find($id);
        if (!$entitas) {
            return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        }
    
        $request->validate([
            'nama' => 'required|string|max:255|unique:entitas,nama,' . $id,
            'nama_latin' => 'required|string|max:255|unique:entitas,nama_latin,' . $id,
            'nama_daerah' => 'required|string|max:255|unique:entitas,nama_daerah,' . $id,
            'family_id' => 'required|numeric',
            'jenis_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
            'url_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama_latin.required' => 'Nama latin tidak boleh kosong',
            'nama_daerah.required' => 'Nama daerah tidak boleh kosong',
            'family_id.required' => 'Family tidak boleh kosong',
            'jenis_id.required' => 'Jenis tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'Tipe data tidak sesuai',
            'nama_latin.string' => 'Tipe data tidak sesuai',
            'nama_daerah.string' => 'Tipe data tidak sesuai',
            'nama.max' => 'Nama terlalu panjang',
            'nama_latin.max' => 'Nama latin terlalu panjang',
            'nama_daerah.max' => 'Nama daerah terlalu panjang',
            'nama.unique' => 'Nama sudah ada',
            'nama_latin.unique' => 'Nama latin sudah ada',
            'nama_daerah.unique' => 'Nama daerah sudah ada',
            'family_id.numeric' => 'Tipe data tidak sesuai',
            'jenis_id.numeric' => 'Tipe data tidak sesuai',
            'kategori_id.numeric' => 'Tipe data tidak sesuai',
            'url_gambar.image' => 'File harus berupa gambar',
            'url_gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'url_gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);
    
    // Jika ada file gambar baru, hapus yang lama dan unggah yang baru
    if ($request->hasFile('url_gambar')) {
        // Hapus gambar lama jika ada
        $oldImagePath = storage_path('app/public' . str_replace('/storage', '', $entitas->url_gambar));
        if ($entitas->url_gambar && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        // Unggah gambar baru
        $this->handleImageUpload($request, $id);
    }

    // Update entitas
    $entitas->update($request->except(['_token', 'url_gambar']));

    return back()->with('success', 'Data berhasil diperbarui!');
    }
    

    public function destroy($id) {
        $entitas = Entitas::find($id);
        if (!$entitas) return response()->json(['status' => 'error', 'message' => "couldn't find any data"], 404);
        // if ($entitas->delete()) {
        //     return response()->json(['status' => 'deleted'], 204);
        // }
        // return response()->json(['status' => 'error', 'message' => "internal server error"], 500);
        if ($entitas->url_gambar && file_exists(public_path($entitas->url_gambar))) {
            unlink(public_path($entitas->url_gambar));
        }
        $entitas->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    private function handleImageUpload($request, $id) {
        $image = $request->file('url_gambar');
        $filename = "gambar_{$id}." . $image->getClientOriginalExtension(); // Nama file format gambar_(id)
        $path = storage_path('app/public/entitas');
    
        // Pindahkan gambar ke folder 'storage/app/public/entitas'
        $image->move($path, $filename);
    
        // Simpan URL gambar ke database
        Entitas::where('id', $id)->update([
            'url_gambar' => "/storage/entitas/$filename"
        ]);
    }

    public function generateQrCode($id)
    {
        $entitas = Entitas::find($id);
    
        // Cek apakah entitas ditemukan
        if (!$entitas) {
            return response()->json(['status' => 'error', 'message' => "Data tidak ditemukan"], 404);
        }
    
        // Generate URL untuk halaman detail entitas
        $url = route('tanaman.detail', Crypt::encrypt($entitas->id));
    
        // Buat QR code dalam format SVG
        $qrCodeSvg = QrCode::format('svg')->size(150)->generate($url);
    
        // Kembalikan QR code SVG
        return response($qrCodeSvg)->header('Content-Type', 'image/svg+xml');
    }
}
