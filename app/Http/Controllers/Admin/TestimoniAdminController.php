<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class TestimoniAdminController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        $pendingCount = Feedback::where('status', 'pending')->count(); // Hitung jumlah pending
        return view('admin.testimoni.index', compact('feedbacks', 'pendingCount'));
    }

    public function approve($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->update(['status' => 'Disetujui']);
        }
        return redirect()->back()->with('success', 'Testimoni telah disetujui.');
    }
    
    public function reject($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->update(['status' => 'Ditolak']);
        }
        return redirect()->back()->with('success', 'Testimoni telah ditolak.');
    }
    

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->delete();
        }
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
