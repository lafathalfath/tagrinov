<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WelcomeText;

class WelcomeTextController extends Controller
{
    public function edit()
    {
        $welcomeText = WelcomeText::first();
        return view('admin.main.welcome_edit', compact('welcomeText'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $welcomeText = WelcomeText::findOrFail($id);
        $welcomeText->update($request->only(['title1', 'title2', 'description']));

        return back()->with('success', 'Slide Berhasil Diperbarui!');
    }
}
