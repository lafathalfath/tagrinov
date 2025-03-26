<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Kunjungan;

class EventController extends Controller
{
    public function index()
    {
        $events = Kunjungan::with('jenis_pengunjung')->where('status_setujui', 'Disetujui')
            ->get(['nama_lengkap', 'tanggal_kunjungan', 'asal_instansi', 'jenis_pengunjung_id', 'jumlah_orang']);

        $event_data = [];
        foreach ($events as $event) {
            $event_data[] = [
                'title' => $event->nama_lengkap,
                'start' => $event->tanggal_kunjungan,
                'asal_instansi' => $event->asal_instansi,
                'jenis_pengunjung' => $event->jenis_pengunjung ? $event->jenis_pengunjung->nama : 'Tidak Diketahui',
                'jumlah_orang' => $event->jumlah_orang,
            ];
        }
        return view('guest.events.index', compact('event_data'));
    }
}
