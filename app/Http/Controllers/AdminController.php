<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Ride;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function experiences()
    {
        $experiences = Experience::latest()->paginate(8);

        return view('admin.experiences', compact('experiences'));
    }

    public function rides()
    {
        $rides = Ride::latest()->paginate(8);

        return view('admin.rides', compact('rides'));
    }

    public function types()
    {
        $types = Type::orderBy('name', 'asc')->paginate(8);

        return view('admin.types', compact('types'));
    }

    public function users()
    {
        $users = User::latest()->paginate(8);

        return view('admin.users', compact('users'));
    }
}
