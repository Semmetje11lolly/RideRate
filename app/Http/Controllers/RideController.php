<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Auth;
use Gate;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Ride;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RideController extends BaseController
{
//    public function __construct()
//    {
//        $this->middleware('auth')->only(['create', 'store']);
//    }

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

        $sort = in_array(strtolower($request->sort), ['asc', 'desc']) ? $request->sort : 'asc';
        $query->orderBy('name', $sort);

        $rides = $query->paginate(8)->appends($request->query());

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
            'type_id' => 'required|integer|exists:types,id',
            'description' => 'required',
            'image_url' => 'required|image|max:10240',
            'stat_speed' => 'nullable|integer',
            'stat_length' => 'nullable|integer',
            'stat_height' => 'nullable|integer',
            'stat_duration' => 'nullable|integer',
            'stat_capacity' => 'nullable|integer'
        ]);

        $ride = new Ride();
        $ride->name = $request->input('name');
        $ride->type_id = $request->input('type_id');
        $ride->description = $request->input('description');
        $ride->image_url = $request->file('image_url')->storePublicly('ride-images', 'public');
        if ($request->filled('stat_speed')) $ride->stat_speed = $request->input('stat_speed');
        if ($request->filled('stat_length')) $ride->stat_length = $request->input('stat_length');
        if ($request->filled('stat_height')) $ride->stat_height = $request->input('stat_height');
        if ($request->filled('stat_duration')) $ride->stat_duration = $request->input('stat_duration');
        if ($request->filled('stat_capacity')) $ride->stat_capacity = $request->input('stat_capacity');
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
        if (!$ride->public && Gate::denies('admin')) abort(404);

        $experiences = Experience::where('ride_id', $ride->id)->get();

        return view('rides.show', compact('ride', 'experiences'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ride $ride)
    {
        Gate::authorize('admin');

        $types = Type::orderBy('name')->get();

        return view('rides.edit', compact('ride', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ride $ride)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|max:255',
            'type_id' => 'required|integer|exists:types,id',
            'description' => 'required',
            'image_url' => 'nullable|image|max:10240',
            'stat_speed' => 'nullable|integer',
            'stat_length' => 'nullable|integer',
            'stat_height' => 'nullable|integer',
            'stat_duration' => 'nullable|integer',
            'stat_capacity' => 'nullable|integer'
        ]);

        $ride->name = $request->input('name');
        $ride->type_id = $request->input('type_id');
        $ride->description = $request->input('description');

        if ($request->filled('stat_speed')) $ride->stat_speed = $request->input('stat_speed');
        if ($request->filled('stat_length')) $ride->stat_length = $request->input('stat_length');
        if ($request->filled('stat_height')) $ride->stat_height = $request->input('stat_height');
        if ($request->filled('stat_duration')) $ride->stat_duration = $request->input('stat_duration');
        if ($request->filled('stat_capacity')) $ride->stat_capacity = $request->input('stat_capacity');

        if ($request->hasFile('image_url')) {
            $ride->image_url = $request->file('image_url')->storePublicly('ride-images', 'public');
        }

        if ($ride->isDirty('name')) {
            $slug = Str::slug($ride->name);
            $originalSlug = $slug;
            $counter = 1;

            while (Ride::where('slug', $slug)->where('id', '!=', $ride->id)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }

            $ride->slug = $slug;
        }

        $ride->save();

        return redirect()->route('rides.show', $ride);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleVisibility(Ride $ride)
    {
        Gate::authorize('admin');

        $ride->public = !$ride->public;
        $ride->save();

        return response()->json([
            'public' => $ride->public,
            'message' => $ride->public ? 'Ride is now visible' : 'Ride is now hidden'
        ]);
    }
}
