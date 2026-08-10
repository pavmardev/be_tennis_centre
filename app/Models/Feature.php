<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'features';

    protected $primaryKey = 'id';

    protected $fillable = ['description'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    public function featureable(): MorphTo
    {
        return $this->morphTo();
    }

    /*public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'membership_features');
    }

    public function courts(): BelongsToMany
    {
        return $this->belongsToMany(Court::class, 'court_features');
    }*/
}
