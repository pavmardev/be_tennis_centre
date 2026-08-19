<?php

namespace App\Http\Controllers;

use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        /*$validated = $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'duration' => 'nullable|integer',
        ]);
        $membership = Membership::create($validated);
        return new MembershipResource($membership);
        */
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
    public function update(Request $request, string $id)
    {
        //
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
