<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Ride;
use App\Models\Type;
use Illuminate\Http\Request;

class RideController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = Ride::where('public', 1)
            ->get();

        return view('rides.index', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('rides.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $ride = new Ride();
        $ride->name = $request->input('name');
        $ride->type_id = $request->input('type_id');
        $ride->description = $request->input('description');
        $ride->image_url = $request->file('image_url')->storePublicly('ride-images', 'public');
        $ride->public = 0;

        $ride->save();

        return redirect()->route('rides.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ride $ride)
    {
        return view('rides.show', compact('ride'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
