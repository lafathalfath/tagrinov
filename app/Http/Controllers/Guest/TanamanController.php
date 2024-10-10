<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Entitas;
use App\Models\Jenis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TanamanController extends Controller
{
    public function index(Request $request) {
        // $tanaman = Entitas::where('kategori_id', 1)->paginate(10);
        $search = $request->input('search');
        $jenisId = $request->input('jenis_id');
        $query = Entitas::where('kategori_id', 1);
        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }
        if ($jenisId) {
            $query->where('jenis_id', $jenisId);
        }
        $tanaman = $query->paginate(10)->appends([
            'search' => $search,
            'jenis_id' => $jenisId,
        ]);
        $jenis_kategori = Jenis::get();
        return view('guest.tanaman.index', [
            'jenis_kategori' => $jenis_kategori,
            'tanaman' => $tanaman,
        ]);
    }

    public function detail($id) { //$id
        $id = Crypt::decrypt($id);
        $tanaman = Entitas::find($id);
        if (!$tanaman) return abort(404);
        $url = route('tanaman.detail', Crypt::encrypt($tanaman->id));
        $qr = QrCode::format('svg')->size(250)->generate($url);
        return view('guest.tanaman.detail', [
            'tanaman' => $tanaman,
            'url' => $url,
            'qr' => $qr
        ]);
    }

    public function generateQrAll()
    {
        $filename = 'qr_tanaman.pdf';
        $storage_path = storage_path("/app/public/qr");
    
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $t) {
            $qrPath = 'qr_' . $t->id . '.svg'; 
            $qrFullPath = storage_path('app/public/qr/' . $qrPath);
            $url = route('tanaman.detail', Crypt::encrypt($t->id));
            
            QrCode::format('svg')->size(300)->generate($url, $qrFullPath);
            
            $t->qrPath = $qrPath;
            $t->url = $url;
        }
    
        $pdf = PDF::loadView('pdf_loader.qr', ['tanaman' => $tanaman]);
        if (!File::exists($storage_path)) {
            File::makeDirectory($storage_path, 0755, true, true);
        }
        File::put("$storage_path/$filename", $pdf->output());
    
        return response()->json(['status' => 'ok', 'file' => "/storage/qr/$filename"]);
    }

    public function viewQr() {
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $t) {
            $qrPath = 'qr_' . $t->id . '.svg';
            $qrFullPath = storage_path('app/public/qr/' . $qrPath);
            $url = route('tanaman.detail', Crypt::encrypt($t->id));
            
            $qr = QrCode::format('svg')->size(300)->generate($url);
            
            $t->qr = $qr;
            $t->qrPath = $qrPath;
            $t->url = $url;
        }
        return view('pdf_loader.qr', ['tanaman' => $tanaman]);
    }
}
