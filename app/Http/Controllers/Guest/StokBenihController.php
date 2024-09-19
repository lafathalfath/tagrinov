<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StokBenihController extends Controller
{
    public function index() {
        return view('guest.stokbenih.index');
    }

    public function detail($id)
    {
        $id = Crypt::decryptString($id);
        // Fetch the seed details based on the name or ID
        // For simplicity, we'll just pass the name to the view
        // In a real application, you would fetch this data from a database

        // return view('detailbenih', ['id' => $id]);
    }
}
