<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function create() {
        return view('guest.testimoni.create');
    }
}
