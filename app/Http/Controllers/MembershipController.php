<?php

namespace App\Http\Controllers;

use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MembershipResource::collection(Membership::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'duration' => 'nullable|integer',
            'features' => 'required|array',
            'features.*.id' => 'required|integer|exists:features,id',
        ]);
        $featuresObjects = Arr::pull($validated, 'features');
        $featureIds = array_column($featuresObjects, 'id');
        $membership = DB::transaction(function () use ($validated,$featuresObjects, $featureIds) {
            $membership = Membership::create($validated);
            $membership->features()->sync($featureIds);

            return $membership;
        });
        $membership->load('features');
        return new MembershipResource($membership);
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        $membership->load('features');
        return new MembershipResource($membership);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'duration' => 'nullable|integer',
            'features' => 'required|array',
            'features.*.id' => 'required|integer|exists:features,id',
        ]);

        $featuresObjects = Arr::pull($validated, 'features');
        $featureIds = array_column($featuresObjects, 'id');
        DB::transaction(function () use ($validated, $featureIds, $membership) {
            $membership->update($validated);
            $membership->features()->sync($featureIds);
        });
        $membership->load('features');

        return response()->json([
            'message' => 'Memberhsip was successfully updated',
            'court' => new MembershipResource($membership)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();
        return response()->json('Membership deleted', Response::HTTP_OK);
    }
}
