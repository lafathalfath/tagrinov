<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benih;
use App\Models\Jenis;
use App\Models\Entitas;
use App\Models\Kunjungan;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $totalkunjungan = Kunjungan::where('status_verifikasi', 'Terverifikasi')->count();
        $totalkunjunganpending = Kunjungan::where('status_verifikasi', 'Belum Diverifikasi')->count();
        $totalKoleksi = Entitas::count();
        $totalstokbenih = Benih::count();
        $totaltestimoni = Feedback::where('status', 'Disetujui')->count();
        $totaltestimonipending = Feedback::where('status', 'pending')->count();

        // Mengambil data kunjungan per bulan
        $kunjunganPerBulan = Kunjungan::selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_kunjungan', date('Y')) // Filter tahun sekarang
            ->where('status_verifikasi', 'Terverifikasi')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')->toArray();

        // Lengkapi bulan yang kosong dengan nilai 0
        $kunjunganPerBulanLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $kunjunganPerBulanLengkap[] = $kunjunganPerBulan[$i] ?? 0;
        }

        $kunjunganBaru = null;
        if ($totalkunjunganpending > 0) {
            $kunjunganBaru = Kunjungan::where('status_verifikasi', 'Belum Diverifikasi')
                ->latest('created_at')
                ->first(); // ambil data terakhir yang masuk
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
            'totalstokbenih',
            'totaltestimoni',
            'totaltestimonipending',
            'kunjunganPerBulanLengkap' ,
            'jenisTanamanData',
            'kunjunganBaru' ,
         ));
    }
}
