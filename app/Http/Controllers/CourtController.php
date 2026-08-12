<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourtResource;
use App\Models\Court;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        try {
            $court->delete();
            return response()->json([
                'Court' . $court . 'was successfully deleted'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'Error' . $exception->getMessage()
            ]);
        }
    }

    public function randomCourts() {
        $randomRecords = Court::inRandomOrder()->take(5)->get();
        return CourtResource::collection($randomRecords);
    }

}
