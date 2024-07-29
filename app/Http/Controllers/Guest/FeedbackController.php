<?php

namespace App\Http\Guest\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('kunjungan', [
            'feedbacks' => $feedbacks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'pesan' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('feedback_photos', 'public');
        }

        Feedback::create($validated);

        return redirect()->back();
    }
}
