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
        $tanaman = Entitas::where('kategori_id', 1)->get();
        $jenis_kategori = Jenis::get();
        // if ($request->kategori) {
        //     $tanaman = Entitas::where('kategori_id', $request->kategori)->get();
        // }
        return view('guest.tanaman.index', [
            'jenis_kategori' => $jenis_kategori,
            'tanaman' => $tanaman,
        ]);
    }

    public function detail($id) { //$id
        $id = Crypt::decrypt($id);
        $tanaman = Entitas::find($id);
        if (!$tanaman) return abort(404);
        return view('guest.tanaman.detail', ['tanaman' => $tanaman]);
    }

    public function generateQrAll()
    {
        $filename = 'qr_tanaman.pdf';
        $storage_path = storage_path("/app/public/qr");
        
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $t) {
            $qrPath = 'qr_' . $t->id . '.png';
            $qrFullPath = storage_path('app/public/qr/' . $qrPath);
            $url = route('tanaman.detail', Crypt::encrypt($t->id));
            $qr = QrCode::size(300)->generate($url, $qrFullPath);
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
            $qrPath = 'qr_' . $t->id . '.png';
            $qrFullPath = storage_path('app/public/qr/' . $qrPath);
            $url = route('tanaman.detail', Crypt::encrypt($t->id));
            $qr = QrCode::size(300)->generate($url);
            $t->qr = $qr;
            $t->qrPath = $qrPath;
            $t->url = $url;
        }
        return view('pdf_loader.qr', ['tanaman' => $tanaman]);
    }
}
