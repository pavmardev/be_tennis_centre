<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Court extends Model
{
    protected $table = 'courts';

    protected $fillable = ['name', 'surface', 'description', 'price'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'court_features');
    }
}
