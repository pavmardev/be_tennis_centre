<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Court extends Model
{
    protected $table = 'courts';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'surface', 'description', 'price'];

    protected $hidden = ['created_at', 'updated_at'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function features(): MorphToMany
    {
        return $this->morphToMany(Feature::class, 'featureable');    }
}
