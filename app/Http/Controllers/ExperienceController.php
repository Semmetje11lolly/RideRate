<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Ride;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rides = Ride::orderBy('name')->get();
        $query = Experience::where('public', 1);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('text', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('ride')) {
            $query->where('ride_id', $request->ride);
        }

        $sort = in_array(strtolower($request->sort), ['asc', 'desc']) ? $request->sort : 'asc';
        $query->orderBy('created_at', $sort);

        $experiences = $query->paginate(8)->appends($request->query());

        return view('experiences.index', compact('experiences', 'rides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rides = Ride::orderBy('name')->get();

        return view('experiences.create', compact('rides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
