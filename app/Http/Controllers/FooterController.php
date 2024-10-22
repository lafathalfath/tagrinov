<?php
namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function edit()
    {
        $footer = FooterSetting::first();
        return view('admin.main.footer', compact('footer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'map_link' => 'nullable|string',
            'phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'website_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
        ]);

        $footer = FooterSetting::first();
        $footer->update($request->all());

        return redirect()->back()->with('success', 'Footer berhasil diperbarui.');
    }
}
