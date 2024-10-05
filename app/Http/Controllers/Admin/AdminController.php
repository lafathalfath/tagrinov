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

        // Hitung kunjungan per bulan
        $monthlyVisits = Kunjungan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->where('status_setujui', true)
                        ->groupBy('month')
                        ->pluck('total', 'month')
                        ->toArray();

        // Siapkan data bulan
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $monthlyVisits[$i] ?? 0; // Jika tidak ada data di bulan tersebut, isi dengan 0
        }

        return view('admin.dashboard', compact(
            'totalkunjungan', 
            'totalkunjunganpending', 
            'totalKoleksiTanaman',
            'totaltestimoni',
            'totaltestimonipending', 
            'months',
         ));
    }
}
