<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'court_id' => 'required|integer|exists:courts,id',
            'time_slot_id' => 'required|integer|exists:time_slots,id',
            'reservation_date' => 'required|string|date',
            'equipment' => 'nullable|array',
            'equipment.*' => 'integer|exists:equipments,id'
        ]);

        $equipmentIds = [];
        if (!empty($validated['equipment'])) {
            $equipmentIds = $validated['equipment'];
        }

        $reservationData = Arr::except($validated, ['equipment']);

        $reservation = DB::transaction(function () use ($reservationData, $equipmentIds) {
            $reservation = Reservation::create($reservationData);

            if (!empty($equipmentIds)) {
                $reservation->equipments()->attach($equipmentIds);
            }
            return $reservation;
        });

        $reservation->with('equipment');

        return response()->json([
            'message' => 'Reservation was successfully created',
            'data' => new ReservationResource($reservation)
        ], Response::HTTP_CREATED);
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
