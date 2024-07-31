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
        return view('guest.tanaman.tanaman', [
            'jenis_kategori' => $jenis_kategori,
            'tanaman' => $tanaman,
        ]);
    }

    public function detail($id) { //$id
        $id = Crypt::decryptString($id);
        $tanaman = Entitas::find($id);
        return view('guest.tanaman.detail', ['tanaman' => $tanaman]);
    }

    public function generateQrAll111() {
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $key=>$t) {
            $qr = QrCode::format('svg')->size(300)->generate(route('tanaman.detail', Crypt::encryptString($t->id)));
            $qr = str_replace('<?xml version="1.0" encoding="UTF-8"?>'."\n", '', strval($qr));
            $t->qr = strval($qr);
            // $t->qr = "<div>lkmcvzczv</div>";
        }
        $filename = time().'.pdf';
        $storage_path = storage_path("/app/public/qr");

        $public_path = "/storage/qr";
        $pdf = Pdf::loadView('pdf_loader.qr', ['tanaman' => $tanaman]);
        if (!File::exists($storage_path)) File::makeDirectory($storage_path, 0755, true, true);
        File::put("$storage_path/$filename", $pdf->output());
        // return redirect("$public_path/$filename");
        return 'ok';
        // return $pdf->download($filename);
        // return back()->with('success', 'QR Code berhasil di generate');
    }

    public function generateQrAll()
    {
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $t) {
            $qrPath = 'qr_' . $t->id . '.png';
            $qrFullPath = storage_path('app/public/qr/' . $qrPath);
            $url = route('tanaman.detail', Crypt::encryptString($t->id));
            QrCode::size(300)->generate($url, $qrFullPath);
            $t->qrPath = $qrPath;
            $t->url = $url;
        }

        $filename = time().'.pdf';
        $storage_path = storage_path("/app/public/qr");

        $pdf = PDF::loadView('pdf_loader.qr', ['tanaman' => $tanaman]);
        if (!File::exists($storage_path)) {
            File::makeDirectory($storage_path, 0755, true, true);
        }
        File::put("$storage_path/$filename", $pdf->output());

        return response()->json(['status' => 'ok', 'file' => "/storage/qr/$filename"]);
    }

    public function viewQr() {
        
        $tanaman = Entitas::where('kategori_id', 1)->get();
        foreach ($tanaman as $key=>$t) {
            $qr = QrCode::format('svg')->size(300)->generate(route('tanaman.detail', Crypt::encryptString($t->id)));
            $t->qr = $qr;
        }
        return view('pdf_loader/qr', ['tanaman' => $tanaman]);
    }
}
