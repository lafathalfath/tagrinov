<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailBenihController extends Controller
{
    public function show($name)
    {
        // Fetch the seed details based on the name or ID
        // For simplicity, we'll just pass the name to the view
        // In a real application, you would fetch this data from a database

        return view('detailbenih', ['name' => $name]);
    }
}
