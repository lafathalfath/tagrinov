<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index()
    {
        // Menampilkan hanya feedback yang disetujui
        $feedbacks = Feedback::where('status', 'Disetujui')->get();
        return view('guest.testimoni.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'pesan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('feedback', 'public');
        }

        Feedback::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'rating' => $request->rating,
            'pesan' => $request->pesan,
            'foto' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Ulasanmu telah dikirim.');
    }
}

