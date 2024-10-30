<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniAdminController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.testimoni.index', compact('feedbacks'));
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
        if ($feedback->foto) {
            Storage::disk('public')->delete($feedback->foto);
        }
        if ($feedback) {
            $feedback->delete();
        }
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
