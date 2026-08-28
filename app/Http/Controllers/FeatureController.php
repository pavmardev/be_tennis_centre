<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::all();
        return response()->json(['features' => $features], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);
        $feature = Feature::create($validated);
        return response()->json(['message' => 'Feature was successfully stored' ,'feature' => $feature], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return response()->json(['feature' => $feature], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);
        $feature->update($validated);
        return response()->json(['message' => 'Feature was successfully updated' ,'feature' => $feature], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(['message' => 'Feature was successfully deleted' ,'feature' => $feature], Response::HTTP_OK);
    }
}
