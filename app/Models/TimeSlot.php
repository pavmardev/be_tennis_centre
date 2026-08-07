<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $table = 'time_slots';
    protected $primaryKey = 'id';
    protected $fillable = ['time_slot'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
