<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Ride;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RideController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $types = Type::orderBy('name')->get();

        $query = Ride::where('public', 1);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type_id', $request->type);
        }

        $rides = $query->get();

        return view('rides.index', compact('rides', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();

        return view('rides.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type_id' => 'required|integer',
            'description' => 'required',
            'image_url' => 'required|image|max:10240'
        ]);

        $ride = new Ride();
        $ride->name = $request->input('name');
        $ride->type_id = $request->input('type_id');
        $ride->description = $request->input('description');
        $ride->image_url = $request->file('image_url')->storePublicly('ride-images', 'public');
        $ride->public = 0;
        $ride->user_id = Auth::user()->id;

        // Start Dynamic slug generation
        $slug = Str::slug($request->input('name'));
        $originalSlug = $slug;
        $counter = 1;

        while (Ride::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $ride->slug = $slug;
        // End Dynamic slug generation

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
