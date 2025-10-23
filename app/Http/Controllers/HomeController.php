<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rides = Ride::where('public', 1)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('home', compact('rides'));
    }
}
