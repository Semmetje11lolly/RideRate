<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Gate;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin');

        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|max:255'
        ]);

        $type = new Type();
        $type->name = $request->input('name');

        $type->save();

        return redirect()->route('admin.types')
            ->with('success', "Added new type {$type->name}.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        Gate::authorize('admin');

        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|max:255'
        ]);

        $oldName = $type->name;
        $type->name = $request->input('name');

        $type->save();

        return redirect()->route('admin.types')
            ->with('success', "Updated type {$oldName} to {$type->name}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        Gate::authorize('admin');

        $type->delete();

        return redirect()->route('admin.types')
            ->with('success', "Type {$type->name} has been deleted.");
    }
}
