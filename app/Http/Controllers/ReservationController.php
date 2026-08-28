<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Models\User;
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
        $this->authorize('viewAny', Reservation::class);
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
            'reservation_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'equipment' => 'nullable|array',
            'equipment.*' => 'integer|exists:equipments,id'
        ]);

        $equipmentIds = $validated['equipment'] ?? [];
        $reservationData = Arr::except($validated, ['equipment']);

        try {
            $reservation = DB::transaction(function () use ($reservationData, $equipmentIds) {

                TimeSlot::where('id', $reservationData['time_slot_id'])->lockForUpdate()->first();

                $isAlreadyBooked = Reservation::where('court_id', $reservationData['court_id'])
                    ->where('reservation_date', $reservationData['reservation_date'])
                    ->where('time_slot_id', $reservationData['time_slot_id'])
                    ->exists();

                if ($isAlreadyBooked) {
                    throw new \Exception('Vybraný kurt je v tomto termíne už rezervovaný.');
                }

                $reservation = Reservation::create($reservationData);

                if (!empty($equipmentIds)) {
                    $reservation->equipments()->attach($equipmentIds);
                }

                return $reservation;
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_CONFLICT); // 409 Conflict
        }
        $reservation->load(['equipments', 'court', 'timeSlot']);

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
        $this->authorize('view', $reservation);
        $reservation->with(['court', 'user', 'equipments', 'timeSlot']);
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);

        $reservation->delete();
        return response()->json([
            'message' => 'Reservation was successfully deleted'
        ], Response::HTTP_OK);
    }

    public function reservationsOfUser(User $user)
    {
        $this->authorize('view', $user);
        $reservations = $user->reservations()->with(['court', 'timeSlot'])->get();
        return ReservationResource::collection($reservations);
    }
}
