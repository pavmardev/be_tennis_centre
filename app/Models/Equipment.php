<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{

    protected $table = 'equipments';

    protected $fillable = ['name', 'description', 'unicode', 'price'];

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'equipment_reservation');
    }
}
