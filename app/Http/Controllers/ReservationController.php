<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['court', 'user', 'equipments', 'timeSlot'])->get();
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation->with(['court', 'user', 'equipments', 'timeSlot']);
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return response()->json([
                'User' . $reservation . 'was successfully deleted'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'Error' . $exception->getMessage()
            ]);
        }
    }
}
