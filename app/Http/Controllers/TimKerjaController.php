<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;

class TimKerjaController extends Controller
{
    public function dashboard()
    {
        $kunjunganDisetujui = Kunjungan::selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_kunjungan', date('Y'))
            ->where('status_setujui', 'Disetujui')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();
        
        $dataKunjunganLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataKunjunganLengkap[] = $kunjunganDisetujui[$i] ?? 0;
        }
        
        $kunjunganBelumDisetujui = Kunjungan::where('status_verifikasi', 'Terverifikasi')
            ->where('status_setujui', 'pending')
            ->latest()
            ->first();

        $totalKunjunganBelumDisetujui = Kunjungan::where('status_verifikasi', 'Terverifikasi')
            ->where('status_setujui', 'pending')
            ->count();
        
        return view('timkerja.dashboard', compact(
            'dataKunjunganLengkap', 
            'kunjunganBelumDisetujui',
            'totalKunjunganBelumDisetujui'
        ));
    
    }
}
