<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WelcomeText;

class HomeController extends Controller
{
    public function index()
    {
        $welcomeText = WelcomeText::first();
        return view('guest.beranda.index', compact('welcomeText'));
    }
}