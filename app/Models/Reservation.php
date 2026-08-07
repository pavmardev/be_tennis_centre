<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = ['user_id', 'court_id', 'time_slot_id', 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_reservation');
    }
}
