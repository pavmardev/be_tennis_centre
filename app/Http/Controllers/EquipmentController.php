<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::all();
        return EquipmentResource::collection($equipment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'unicode' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $equipment = Equipment::create($validated);
        return response()->json(['Equipment' => $equipment], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'unicode' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $equipment->update($validated);
        return response()->json(['Equipment' => $equipment], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return response()->json('Equipment deleted', Response::HTTP_OK);
    }

    public function randomEquipment()
    {
        $randomRecords = Equipment::inRandomOrder()->take(5)->get();
        return EquipmentResource::collection($randomRecords);
    }
}
