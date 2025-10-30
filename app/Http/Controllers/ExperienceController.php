<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Ride;
use Auth;
use Gate;
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

        $sort = in_array(strtolower($request->sort), ['asc', 'desc']) ? $request->sort : 'desc';
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

        $alreadyReviewedIds = auth()->user()
            ? auth()->user()->experiences()->pluck('ride_id')->toArray()
            : [];

        return view('experiences.create', compact('rides', 'alreadyReviewedIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ride_id' => [
                'required',
                'integer',
                'exists:rides,id',
                function ($attribute, $value, $fail) {
                    $userId = Auth::id();
                    $alreadyExists = Experience::where('user_id', $userId)
                        ->where('ride_id', $value)
                        ->exists();

                    if ($alreadyExists) {
                        $fail('You have already written an experience for this ride.');
                    }
                },
            ],
            'text' => 'required',
            'image_urls' => 'required|image|max:10240',
            'rating_theme' => 'required|integer|min:0|max:5',
            'rating_design' => 'required|integer|min:0|max:5',
            'rating_ridexp' => 'required|integer|min:0|max:5',
            'rating_guestxp' => 'required|integer|min:0|max:5',
            'rating_creativity' => 'required|integer|min:0|max:5'
        ]);

        $experience = new Experience();
        $experience->ride_id = $request->input('ride_id');
        $experience->text = $request->input('text');
        $experience->image_urls = $request->file('image_urls')->storePublicly('experience-images', 'public');
        $experience->rating_theme = $request->input('rating_theme');
        $experience->rating_design = $request->input('rating_design');
        $experience->rating_ridexp = $request->input('rating_ridexp');
        $experience->rating_guestxp = $request->input('rating_guestxp');
        $experience->rating_creativity = $request->input('rating_creativity');
        $experience->user_id = Auth::user()->id;
        $experience->public = 1;

        $experience->save();

        return redirect()->route('experiences.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        if (!$experience->public && Gate::denies('experiences-edit', $experience)) abort(404);

        return view('experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        Gate::authorize('experiences-edit', $experience);

        $rides = Ride::orderBy('name')->get();

        $alreadyReviewedIds = auth()->user()
            ? auth()->user()->experiences()->pluck('ride_id')->toArray()
            : [];

        return view('experiences.edit', compact('experience', 'rides', 'alreadyReviewedIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        Gate::authorize('experiences-edit', $experience);

        $request->validate([
            'text' => 'required|string',
            'image_urls' => 'nullable|image|max:10240',
            'rating_theme' => 'required|integer|min:0|max:5',
            'rating_design' => 'required|integer|min:0|max:5',
            'rating_ridexp' => 'required|integer|min:0|max:5',
            'rating_guestxp' => 'required|integer|min:0|max:5',
            'rating_creativity' => 'required|integer|min:0|max:5',
        ]);

        $experience->text = $request->input('text');
        $experience->rating_theme = $request->input('rating_theme');
        $experience->rating_design = $request->input('rating_design');
        $experience->rating_ridexp = $request->input('rating_ridexp');
        $experience->rating_guestxp = $request->input('rating_guestxp');
        $experience->rating_creativity = $request->input('rating_creativity');

        if ($request->hasFile('image_urls')) {
            $experience->image_urls = $request->file('image_urls')->storePublicly('experience-images', 'public');
        }

        $experience->save();

        return redirect()->route('experiences.show', $experience);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleVisibility(Experience $experience)
    {
        Gate::authorize('experiences-edit', $experience);

        $experience->public = !$experience->public;
        $experience->save();

        return response()->json([
            'public' => $experience->public,
            'message' => $experience->public ? 'Experience is now visible' : 'Experience is now hidden'
        ]);
    }
}
