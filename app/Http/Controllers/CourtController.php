<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourtResource;
use App\Models\Court;


use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mockery\Exception;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courts = Court::with('features')->get();

        return response()->json([
            'courts' => CourtResource::collection($courts),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'surface' => 'required|string|in:clay,grass,indoor',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'features' => 'required|array|exists:features,id',
        ]);

        $featureIds = Arr::pull($validated, 'features');
        $court = Court::create($validated);

        $features = Feature::findMany($featureIds);
        $court->features()->saveMany($features);

        return response()->json(['court' => new CourtResource($court)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Court $court)
    {
        return new CourtResource($court);
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
    public function destroy(Court $court)
    {
        $court->delete();
    }

    public function randomCourts() {
        $randomRecords = Court::inRandomOrder()->take(5)->get();
        return CourtResource::collection($randomRecords);
    }

}
