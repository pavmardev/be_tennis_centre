<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembershipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'cost' => $this->cost,
            'duration' => $this->duration,
            'features' => $this->features->map(function ($feature) {
                return [
                    'description' => $feature->description,
                ];
            })
        ];
    }
}
