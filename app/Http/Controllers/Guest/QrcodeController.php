<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function qrcode()
    {
        $url = 'http://example.com/link'; 
        $qrCode = QrCode::size(350)->generate($url);

        return view('guest.tanaman.qrcode', compact('qrCode', 'url'));
    }
}
