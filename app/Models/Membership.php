<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Membership extends Model
{
    protected $table = 'memberships';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'cost', 'duration'];

    protected $hidden = ['created_at', 'updated_at'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function features(): MorphToMany
    {
        return $this->morphToMany(Feature::class, 'featureable');
    }
}
