<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function benih () {
        return view('guest.permohonan.benih.index');
    }

    // public function kunjungan() {
    //     return view('guest.permohonan.kunjungan.index');
    // }
}
