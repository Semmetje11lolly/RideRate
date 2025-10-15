<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rides = Ride::all();

        return view('home', compact('rides'));
    }
}
