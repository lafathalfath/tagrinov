<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entitas;
use App\Models\Kunjungan;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $totalkunjungan = Kunjungan::where('status_setujui', true)->count();
        $totalkunjunganpending = Kunjungan::where('status_setujui', false)->count();
        $totalKoleksiTanaman = Entitas::where('kategori_id', 1)->count(); // Menggunakan kategori_id
        $totaltestimoni = Feedback::where('status', 'Disetujui')->count();
        $totaltestimonipending = Feedback::where('status', 'pending')->count();

        // Mendapatkan bulan saat ini
        $currentMonth = now()->month;

        // Mengambil jumlah kunjungan dari awal tahun hingga bulan ini
        $kunjunganPerBulan = Kunjungan::selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_kunjungan', now()->year)
            ->whereMonth('tanggal_kunjungan', '<=', $currentMonth) // Membatasi hingga bulan ini
            ->groupBy('bulan')
            ->get()
            ->pluck('jumlah', 'bulan');

        // Membuat array bulan dari Januari sampai bulan saat ini
        $bulanArray = [];
        for ($i = 1; $i <= $currentMonth; $i++) {
            $bulanArray[$i] = date('F', mktime(0, 0, 0, $i, 1)); // Mengambil nama bulan dalam bahasa Inggris
        }

        return view('admin.dashboard', compact(
            'totalkunjungan', 
            'totalkunjunganpending', 
            'totalKoleksiTanaman',
            'totaltestimoni',
            'totaltestimonipending', 
            'kunjunganPerBulan',
            'bulanArray'
         ));
    }
}
