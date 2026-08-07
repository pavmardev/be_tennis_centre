<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    protected $table = 'features';

    protected $fillable = ['description'];

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'membership_features');
    }

    public function courts(): BelongsToMany
    {
        return $this->belongsToMany(Court::class, 'court_features');
    }
}
