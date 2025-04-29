<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Entitas;
use App\Models\Kunjungan;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $totalkunjungan = Kunjungan::where('status_setujui', 'Disetujui')->count();
        $totalkunjunganpending = Kunjungan::where('status_setujui', 'pending')->count();
        $totalKoleksi = Entitas::count();
        $totaltestimoni = Feedback::where('status', 'Disetujui')->count();
        $totaltestimonipending = Feedback::where('status', 'pending')->count();

        // Mengambil data kunjungan per bulan
        $kunjunganPerBulan = Kunjungan::selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_kunjungan', date('Y')) // Filter tahun sekarang
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')->toArray();

        // Lengkapi bulan yang kosong dengan nilai 0
        $kunjunganPerBulanLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $kunjunganPerBulanLengkap[$i] = $kunjunganPerBulan[$i] ?? 0;
        }

        // Mengambil data jenis tanaman
        $jenis = Jenis::all();
        $jenisTanamanData = [];
                
        foreach ($jenis as $j) {
        // Menghitung jumlah entitas yang terkait dengan jenis ini
        $jenisTanamanData[$j->nama] = $j->entitas->count();
        }

        return view('admin.dashboard', compact(
            'totalkunjungan', 
            'totalkunjunganpending', 
            'totalKoleksi',
            'totaltestimoni',
            'totaltestimonipending',
            'kunjunganPerBulanLengkap' ,
            'jenisTanamanData'
         ));
    }
}
