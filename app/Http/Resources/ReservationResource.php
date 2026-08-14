<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->user->name,
            'court' => $this->court->name,
            'surface' => $this->court->surface,
            'reservation_time' => $this->timeSlot->time_slot,
            'reservation_date' => $this->reservation_date,
            'equipment' => $this->equipments->map(function ($item) {
                return ['name' => $item->name];
            })
        ];
    }
}
